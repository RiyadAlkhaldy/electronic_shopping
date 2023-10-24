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

    public static function booted()
    {
        static::addGlobalScope('store', function (Builder $builder) {
            $user = Auth::user();
            if ($user && $user->store_id) {
                $builder->where('store_id', $user->store_id) ;
            }
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
        return "";
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

}
