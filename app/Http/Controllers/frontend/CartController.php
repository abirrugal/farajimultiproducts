<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{


    public function cartCount(Request $request){
        
        
        if($request->ajax()){
  // session()->flush();
        $data=[];
        $data['cart'] = session('cart')? session('cart'):[];
        $totalProducts = 0;
        $totalProducts = array_sum(array_column($data['cart'],'quantity'));
        
        return response()->json(['status'=>'success', 'totalProducts'=>$totalProducts ]);

        }
            }

  

    // =========================
    // =    List of Cart       =
    // =========================

    public function cartIndex(){
        
// session()->flush();
$data=[];
$data['cart'] = session('cart')? session('cart'):[];
$data['totalPrice'] = array_sum(array_column($data['cart'],'total_price'));
$data['totalProducts'] = array_sum(array_column($data['cart'],'quantity'));


// session()->put('cart', $data['total']);

// dd(session('cart'));

        return view('frontend.cart.index', $data);
    }


    // =========================
    // =   Add cart to list   =
    // =========================

    public function cartStore(Request $request){
   
    try{

        $this->validate($request, [
            'product_id' => 'required|numeric',
        ]);

    }catch(ValidationException $e){
       
        return redirect()->back();
    }

    $product = Product::findOrFail($request->product_id);
    $price=($product->sale_price !== null && $product->sale_price >0) ? $product->sale_price : $product->price;
    $image = $product->getFirstMediaUrl();




//First we get session data and put it to $cart variable [get cart products]

$cart = session()->get('cart');
       
//If $cart is empty mean there is no product in cart then we will add requested product. [Add new product if cart empty]

if(!$cart) {
    

    $cart[$product->id] = [
        'title' => $product->title,
        'quantity' => 1,
        'image'   => $image,
        'price' => $price, 
        'total_price' => $price  
        
    ];

    

    session(['cart' => $cart]);

//Here we return user to cart index page, We use return keyword So it will stop here and not go secound if statement.[return to cart list]

    // return redirect()->back()->with('success','Item added to cart');

    return response()->json(['status'=>'success', 'message'=>'Items added to the cart']);

}


//If cart's have a same item which we added before we need to increment quantity of that product, 
//So we check if the product already in cart if is it then increment it by 1.

    if(isset($cart[$product->id])) {

        $cart[$product->id]['quantity']++;

        $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $cart[$product->id]['price'];



        session(['cart' => $cart]);

        
       return response()->json(['status'=>'success', 'message'=>'Items added to the cart']);

   
//Here we return user to cart index page, We use return keyword So it will stop here and not go secound if statement.[return to cart list]

        // return redirect()->back()->with('success', $product->title. 'Item added to cart');
    }

//If cart is not empty and cart has duplicate product we well add a new product. [mean there is a single product and also duplicate product]

    $cart[$product->id ] = [
        'title' => $product->title,
        'quantity' => 1,
        'image'   => $image,
        'price' => $price,  
        'total_price' => $price,  
    ];

    session(['cart' => $cart]);
    

     return response()->json(['status'=>'success', 'message'=>'Items added to the cart']);


//Here we return user to cart index page, We use return keyword So it will stop here and not go secound if statement.[return to cart list]     
    // return redirect()->back()->with('success', $product->title. ' added to cart');

}

    // =========================
    // =Change items quantity =
    // =========================

    public function changeQty(Request $request, Product $product){
        $cart = session()->get('cart');

      if ($request->change_to === 'down') {
          if(isset($cart[$product->id])) {
            if($cart[$product->id]['quantity'] > 1){

                $cart[$product->id]['quantity']--;
                $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $cart[$product->id]['price'];

                session(['cart' => $cart]);

                return redirect()->back();
            }else{

                unset($cart[request()->product_id]);
                session()->put('cart', $cart);
                
                Session::save();      
               
               return redirect()->back()->with('success', 'Item removed success');
                 
                return redirect()->back();
            }
          }else {
              return back();
          }
          
      }else{

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_price'] = $cart[$product->id]['quantity'] * $cart[$product->id]['price'];

            session(['cart' => $cart]);
            return redirect()->back();

        }else{
            return back();
        }

      }
    }


    // =========================
    // =Destroy item from cart =
    // =========================
    
    function cartDestroy(Request $request){

        $cart = session('cart') ?  session('cart') : [];
        
        unset($cart[request()->product_id]);
        session()->put('cart', $cart);
        
        Session::save();


       
       return redirect()->back()->with('success', 'Item removed success');
    }



       // =========================
       // =    Clear all cart     =
       // =========================

        public function cartClear(){

            session()->put('cart',[]);
            $this->successMessage('All carts are cleared');
            return redirect()->back();
        }

       // =========================
       // =    Checkout Page      =
       // =========================

    public function checkout(){
        $data=[];
        $data['cart'] = session('cart')? session('cart'):[];
        $data['totalPrice'] = array_sum(array_column($data['cart'],'total_price'));
        $data['totalProducts'] = array_sum(array_column($data['cart'],'quantity'));

        return view('frontend.cart.checkout', $data);
    }

       // =========================
       // =    Order logic        =
       // =========================

    public function orderProcess(Request $request){

$cart = session('cart')? session('cart'):[];
$total = array_sum(array_column($cart,'total_price'));

if($total){

    $validate = Validator::make($request->all(), [

        'name' => 'required',
        'phone' => 'required|numeric|min:11',
        'address' => 'required',
        'postal_code'   => 'required|numeric',
        'city' => 'required'
    ]);

    if($validate->fails()){
        return redirect()->back()->withErrors($validate)->withInput();
    }

$order =  Order::create([ 
        'user_id' => Auth::user()->id,
        'customer_name' => $request->name,
        'customer_phone_number' => $request->phone,
        'address' => $request->address,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
        'total_amount' => $total,
        'paid_amount' => $total,
        'payment_details' => 'Cash on Delivery'


    ]);

    foreach ($cart as $product_id => $product){

        $order->orderProducts()->create([
            'product_id' => $product_id,
            'quantity'   => $product['quantity'],
            'price'      => $product['total_price'],
        ]);
    }

    session()->forget('cart', 'total');
    $this->successMessage('Order Created');
    return redirect()->route('frontend.product.index');

}
$this->errorMessage('Your cart is empty. Please add some product to your cart first.');
return redirect()->back();
       
    }


    }

