<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

//Order Product's must have at least one order.We can access and know about a product under which order. 

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

//Order Product's must have at least one product mean's customer must order for atleast one product, We need to know product's details so we make this reletion.
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}












