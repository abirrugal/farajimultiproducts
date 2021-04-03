<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
      return  $this->belongsTo(__CLASS__);
    }

    //If we think Category as Parent category then parent's can have many child.


    public function child_category(){
      return  $this->hasMany(__CLASS__);
    }

    //One Category can have many products.

    public function products(){
        return $this->hasMany(Product::class);
    }


    
}
