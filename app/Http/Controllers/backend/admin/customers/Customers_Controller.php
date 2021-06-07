<?php

namespace App\Http\Controllers\backend\admin\customers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Customers_Controller extends Controller
{
    public function customers(){
        $data['customers'] = User::select('name','email','phone_number','role_as','id')->paginate(10);
        return view('backend.customers.index',$data);
    }

    public function changeRole(Request $request){
        

    $user = User::find($request->user_id);
        if($request->role === 'user'){
            $user->role_as = 'user';
            $user->save();
            session()->flash('type','success');
            session()->flash('message','User role changed success');
            return redirect()->back();
        }
        if($request->role === 'admin'){
            $user->role_as = 'admin';
            $user->save();
            session()->flash('type','success');
            session()->flash('message','User role changed success');
            return redirect()->back();
        }
    }
}
