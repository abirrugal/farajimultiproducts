<?php
namespace App\Http\Controllers\backend\admin\orders;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class OrdersController extends Controller
{
    public function orders(){

        $data['orders'] = Order::select('customer_name', 'customer_phone_number', 'city', 'id')->with('orderProducts')->paginate(10);
   
        return view('backend.orders.orders', $data);
    }


//Show Orders

public function orderShow($id){
    $order = Order::with('orderProducts','customer')->findOrFail($id);
    
    return view('backend.orders.show',['order'=>$order]);
}


//Delete Order

public function orderDelete(Request $request , $id){

$order = Order::find($id);

$order->delete();

session()->flash('type','success');
session()->flash('message','Order deleted success');
return redirect()->back();

}

}
