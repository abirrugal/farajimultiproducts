<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;


class Product extends Model implements HasMedia
{
    
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::creating(function($product){

            $product->slug = Str::slug($product->title);
        });
  
    }

    public function category(){
        return $this->hasOne(Category::class);
    }
}
