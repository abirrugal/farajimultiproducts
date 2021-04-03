<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

//List of the all products to the index/home page

    public function productsIndex(){
        $data['products'] = Product::select('id','title','slug','price','sale_price')->where('active', 1)->latest()->paginate(10);
        return view('frontend\home', $data);
    }


//Goto Create New Product's form

    function productCreate(){

    }


//Store Product Info

    function productStore(){

    }

//Show individual Product

    public function productShow($slug){
     $product = Product::where([['slug', '=', $slug],['active','=', 1]])->first();
    
     if($product === null){
         return redirect()->route('frontend.home');
     }

     return view('frontend.products.show', ['product'=> $product]);

    }

//Goto Edit Form page

    public function productEdit(){

    }

//Update Product

    public function productUpdate(){

    }

//Destroy Product
    public function productDestroy(){

    }


}
