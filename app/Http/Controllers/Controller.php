<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public  function successMessage($message){
        session()->flash('type', 'success');
        session()->flash('message', $message);
    }

    public function errorMessage($message){
        session()->flash('type', 'danger');
        session()->flash('message', $message);
    }

    public function jsonSuccess($message ='' , $data=[]){

        return json_encode(
            [
                'status'=>'success', 
                'message'=>$message, 
                'data'=>$data 
            ]); 
    }

    public function totalCartQuantityCount(){
        $data['cart'] = session('cart')? session('cart'):[];
        $totalProducts = array_sum(array_column($data['cart'],'quantity'));
        return $totalProducts;

    }

    public function totalCartPriceCount(){
        $data['cart'] = session('cart')? session('cart'):[];
        $totalPrice = array_sum(array_column($data['cart'],'total_price'));
        return $totalPrice;

    }

}
