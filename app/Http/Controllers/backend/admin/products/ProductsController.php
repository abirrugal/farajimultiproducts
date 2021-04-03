<?php

namespace App\Http\Controllers\backend\admin\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(){
        return view('backend.products.products');

    }
}
