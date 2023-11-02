<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['name','slug','description','store_id','category_id','image',
                            'price','compare_price','options','rating','featured','status'];

   protected $hidden = [
    'image',
    'created_at','updated_at','deleted_at',
    ];
    protected $appends = [
        'image_url', 'sale_percent'
    ];

    /**
     * Get the route key for the model.
     */
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }


    public static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', $user->store_id) ;
            }
        });
        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
        static::updating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id',
        );
    }

    public function scopeActive(Builder $Builder )
    {
        $Builder->where('status','active');
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image)
        return "https://via.placeholder.com/600x600.png/0077ff?text=aut";
        if(Str::startsWith($this->image, ['https://','http://']))
            return $this->image;

        return   asset('storage/'.$this->image);
    }

    public function getSalePercentAttribute()
    {
        if(!$this->compare_price)
        return 0;
        return round( 100 - (100 * $this->price / $this->compare_price) , 1 ) ;
        // return number_format( 100 - (100 * $this->price / $this->compare_price) , 1 ) ;
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $options = array_merge([
            'store_id' => null,
            'category_id' => null,
            'tag_id' => null,
            'status' => 'active',
        ], $filters);
        $builder->when($options['store_id'],function($query ,$value){
            $query->where('store_id', $value);
        });
        $builder->when($options['category_id'], function ($query,$value) {
            $query->where('category_id', $value );
        });

        $builder->when($options['tag_id'],function($query,$value) {

            $query->whereExists(function($query) use ($value){
                $query->select(1)
                ->from('product_tag')
                ->whereRaw('product_id = product.id')
                ->where('tag_id',$value);
            });
            // $query->whereRaw('id IN (SELECT product_id FROM product_tag WHERE tag_id = ?)',[$value]);
            // $query->whereRaw('EXISTS (SELECT 1 FROM product_tag WHERE tag_id = ? AND product_id = product.id)',[$value]);

            // $query->whereHas('tags', function($builder) use ($value){
            //     $builder->where('tag_id', $value);
            // });
        });

        $builder->when($options['status'], function ($query ,$value) {
            $query->where('status', $value );
        });


    }

}
