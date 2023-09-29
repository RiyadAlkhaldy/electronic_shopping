<?php

namespace App\Models;

use App\Rules\Filter;
// use Illuminate\Contracts\Database\Query\Builder;
// use Illuminate\Contracts\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Category extends Model
{
    use HasFactory,SoftDeletes;



    public $fillable = ['parent_id','name','slug','description','image','status',
                        // 'store_id',
                    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id')->withDefault();
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
    



    // public static function rrr( ){
    //     $this->delete();
    // }
        public static function rules($id = 0){
            // dd($id);
        return [
            'name'=>['required',
            'string',
            'min:3',
            'max:100',
            Rule::unique('categories','name')->ignore($id),
            // "unique:categories,name,$id",
            // function($attribute,$value,$fails){
            //     if(strtolower($value)=== "laravel")
            //     return $fails("this name is forbidden");
            // }

            // new Filter(['laravel','html','php']),

            'filter:laravel,html,php',
        ],
            'parent_id'=>[
                'nullable','integer','exists:categories,id'
            ],
            // 'image'=>'max:1048000|dimensions:max_width=1000,max_height=1000',
            'image'=>'max:104800000|dimensions:max_width=10000,max_height=10000',
            'status'=>'in:active,inactive',
            // 'description'=>'unique:categories,description'


        ];
    }

    public function scopeFilter(Builder $builder,$request)
    {
        if($name = $request->input('name')){
            $builder->where('categories.name','LIKE',"%{$name}%");
        }
        if($status = $request->input('status')){
            $builder->where('categories.status', $status);
        }
    }
}
