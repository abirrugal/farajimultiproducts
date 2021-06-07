<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
// use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class ProductController extends Controller
{



//List of Categories to the home page

    public function productsIndex(){

        // $data['products'] = Product::where('brand','Xiomi')->get();
        $data['categories'] = Category::with('products')->where('category_id',null)->whereNull('subcategory_id')->get();
        return view('frontend\home',$data);
    }


  //List of products list

  public function productSub_list($slug){
    
    $data['category'] = Category::where('slug', $slug)->first();


    $child = [];


    foreach ($data['category']->child_category as $subcategories) {

    foreach ($subcategories->child as $childcat) {
      foreach ($childcat->products as $product){

        array_push($child, [
          'title'=>$product->title,
          'image'=>$product->image,
          'price'=>$product->price,
          'sale_price' => $product->sale_price,
          'id' =>$product->id,          
          'slug' =>$product->slug,
      
          ]);
         
      }
      
      
    }
  
    }


    
    $data['products'] = $this->paginate($child,10,'',['path' => Paginator::resolveCurrentPath()]);

    
    return view('frontend.products.list',$data);

   }

//Product show

public function productList($slug){

 $data['sub_category'] = Category::where('slug', $slug)->first();

 $child = [];

 foreach ($data['sub_category']->child as $childcat) {
  foreach ($childcat->products as $product){

    array_push($child, [
      'title'=>$product->title,
      'image'=>$product->image,
      'price'=>$product->price,
      'sale_price' => $product->sale_price,
      'id' =>$product->id,          
      'slug' =>$product->slug,
  
      ]);
     
  }
  
  
}

$data['products'] = $this->paginate($child,10,'',['path' => Paginator::resolveCurrentPath()]);

 $data['child_categories'] =  $data['sub_category']->child()->paginate(10);
 return view('frontend.products.product_list',$data);
}

public function productListChild($slug){

  $data['sub_category'] = Category::where('slug', $slug)->first();
  $data['child_categories'] =  $data['sub_category']->paginate(10);
  return view('frontend.products.product_list',$data);
 }


public function productShow($slug){
  $data['product'] = Product::where('slug', $slug)->first();

 //  dd($data['product']);
  return view('frontend.products.show',$data);
 }

 public function paginate($items, $perPage = 5, $page = null, array $options = [])
 {
     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
     $items = $items instanceof Collection ? $items : Collection::make($items);
     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
 }
}
