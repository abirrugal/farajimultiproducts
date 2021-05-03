<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

protected static function boot()
{
  parent::boot();
  static::creating(function($category){

    $category->slug = Str::slug($category->name);
  });
}
   

    //If we think Category as Child category then Child belongsTo only one parent

    public function parent_category(){
      return  $this->belongsTo(self::class, 'category_id');
    }

    //If we think Category as Parent category then parent's can have many child.


    public function child_category(){
      return  $this->hasMany(self::class, 'category_id','id');
    }



    public function subcat(){
      return $this->belongsTo(self::class, 'subcategory_id');
    }

    public function child(){
      return $this->hasMany(self::class, 'subcategory_id','id');
    }

    //One Category can have many products.

    public function products(){
        return $this->hasMany(Product::class);
    }


    
}
