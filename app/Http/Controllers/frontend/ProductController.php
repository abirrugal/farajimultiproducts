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
      if(auth()->user()){
        $data['orders'] = auth()->user()->orders;

      }

        $data['features'] = Product::whereNotNull('sale_price')->get()->take(8);
        $data['categories'] = Category::with('products')->where('category_id',null)->whereNull('subcategory_id')->get();
        return view('index',$data);
    }


  //All products from Category and/or Sub-category and/or Child-category (Go this page When click to Main Category)

  public function productSub_list($slug){
    
    $data['category'] = Category::where('slug', $slug)->first();


    $child = [];

    if($data['category']->products->count()>0){
      foreach($data['category']->products as $product){
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


    foreach ($data['category']->child_category as $subcategories) {

      if($subcategories->products->count()>0){

        foreach ($subcategories->products as $product){

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
    foreach ($subcategories->child as $childcat) {

      if($childcat->products->count()>0){
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
  
    }

    
    $data['products'] = $this->paginate($child,12,'',['path' => Paginator::resolveCurrentPath()]);

    
    return view('frontend.products.list',$data);

   }

//Products list of sub-category

public function productList($slug){

 $data['sub_category'] = Category::where('slug', $slug)->first();

 $child = [];


 if($data['sub_category']->products->count()>0){

  foreach($data['sub_category']->products as $product){

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


 foreach ($data['sub_category']->child as $childcat) {


if($childcat->products->count()>0){

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
$data['products'] = $this->paginate($child,12,'',['path' => Paginator::resolveCurrentPath()]);

 $data['child_categories'] =  $data['sub_category']->child()->paginate(10);
 return view('frontend.products.product_list',$data);
}
//List of Child-Category

public function productListChild($slug){

  $child = [];

  $data['child_category'] = Category::where('slug', $slug)->first();

  if($data['child_category']->products->count()>0){

    foreach ($data['child_category']->products as $product){

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

  $data['products'] = $this->paginate($child,12,'',['path' => Paginator::resolveCurrentPath()]);

  return view('frontend.products.products_list_from_child',$data);
 }


//Show Individual Product Info

public function productShow($slug){
  $data['product'] = Product::where('slug', $slug)->first();

 //  dd($data['product']);
  return view('frontend.products.show',$data);
 }

 //Featured Products

 public function featuredProducts(){


 }


//Custom Pagination

 public function paginate($items, $perPage = 5, $page = null, array $options = [])
 {
     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
     $items = $items instanceof Collection ? $items : Collection::make($items);
     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
 }
}
