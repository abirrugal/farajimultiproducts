<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

//Order must created by one customer
public function customer(){
    return $this->belongsTo(User::class);
}

//Order must handle by one processor

public function processor(){
    return $this->hasOne(User::class, 'processed_by'); 
    }

//One order can have many orderProducts,

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    
}
