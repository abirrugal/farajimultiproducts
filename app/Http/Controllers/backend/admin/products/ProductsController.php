<?php
namespace App\Http\Controllers\backend\admin\products;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Cloudinary;
class ProductsController extends Controller
{

//Products List
    public function products(){

        $data['allproducts'] = Product::select('id','title','image','description','in_stock','price','sale_price')->where('active', 1)->latest()->paginate(10);

        return view('backend.products.products',$data);

    }

//Goto New product form

    public function productsNew(){
        return view('backend.products.new');

    }
//Store Products
    public function productsStore(Request $request){

        $validator = Validator::make($request->all(), [

            'title' => 'required|min:2',
            'description' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'price' => 'required|numeric',
            'stock_status' => 'required',
            'category'  => 'required',
            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if( $request->hasFile('image')){
            if($request->file('image')->isValid()){

                $image = $request->file('image');
                // $file_name = Str::random(12);
                // $file_extension = $image->getClientOriginalExtension();
                // $img_name = $file_name . '.' . $file_extension;
                // $image->storeAs('products_image', $img_name);

                $resizedImage = cloudinary()->upload($request->file('image')->getRealPath(), [
                    'folder' => 'products',
                 
        ])->getSecurePath();    

            }
        }

        if($request->child_category!==null && $request->child_category!==""){
            
            $category_id = $request->child_category;
            
        }else{         
            $category_id = ($request->sub_category)? $request->sub_category : $request->category;
        }

try {
    Product::create([

        'category_id' => $category_id,
        'title'       => $request->title,
        'description'   => $request->description,
        'image'         => $resizedImage,
        'in_stock'  =>$request->stock_status,
        'price'         =>$request->price,
        'sale_price'    =>$request->sprice,
        'active' => $request->product_status

    ]);
} catch (Exception $e) {
    
    $this->errorMessage($e->getMessage());
    return redirect()->back()->withInput();
}

   $this->successMessage("Product successfully created");
   return redirect()->back();
    }

//Show Product
    public function productsShow($id){

        $product = Product::findOrFail($id);
        return view('backend.products.show',['product' => $product]);

    }

//Edit Products
    public function productsEdit($id){
        $data['product'] = Product::find($id);

        return view('backend.products.edit')->with($data);
    }

//Update Products

    public function productsUpdate(Request $request, $id){
        $validator = Validator::make($request->all(), [

            'title' => 'required|min:2',
            'description' => 'required',
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'price' => 'required|numeric',
            'stock_status' => 'required',
            'category'  => 'required',           
            
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product = Product::find($id);


        if( $request->hasFile('image')){
            if($request->file('image')->isValid()){

                $image = $request->file('image');

            //     $file_name = Str::random(12);
            //     $file_extension = $image->getClientOriginalExtension();
            //     $img_name = $file_name . '.' . $file_extension;

            //     $image->storeAs('products_image', $img_name);

            //    unlink(public_path().'/allfiles/products_image/'.$product->image);

            $url = $product->image;
            preg_match("/products\/(?:v\d+\/)?([^\.]+)/", $url, $matches);
            Cloudinary::destroy($matches[0]);
            $resizedImage = cloudinary()->upload($request->file('image')->getRealPath(), [
                'folder' => 'products',
            
    ])->getSecurePath();  

               $product->image = $resizedImage;
               $product->save();
               
            }
        }

        if($request->child_category!==null && $request->child_category!==""){
            $category_id = $request->child_category;
            $product->category_id = $category_id;
            $product->save();
            
        }else{

            $category_id = ($request->sub_category)? $request->sub_category : $request->category;
            $product->category_id = $category_id;
            $product->save();
        }
try {
    Product::find($id)->update([

        
        'title'       => $request->title,
        'description'   => $request->description,
        'in_stock'  =>$request->stock_status,
        'price'         =>$request->price,
        'sale_price'    =>$request->sprice,
        'active' => $request->product_status

    ]);
} catch (Exception $e) {
    
    $this->errorMessage($e->getMessage());
    return redirect()->back()->withInput();
}

   $this->successMessage("Product successfully updated");
   return redirect()->back();
        
    }

//Delete Products

    public function productsDelete($id){

        $product = Product::find($id);
        $url = $product->image;
        preg_match("/products\/(?:v\d+\/)?([^\.]+)/", $url, $matches);
        Cloudinary::destroy($matches[0]);

        $product->delete();

        // if($product->image){
        //     unlink(public_path().'/allfiles/products_image/'.$product->image);   
        // }

        session()->flash('type','success');
        session()->flash('message','Product successfully deleted');
        return redirect()->back();
    }
}