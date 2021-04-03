<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePage(){
        $data['products'] = Product::select('id','title','slug','price','sale_price')->where('active', 1)->latest()->paginate(10);
        return view('frontend\home', $data);
    }
}
