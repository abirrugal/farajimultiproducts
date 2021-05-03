<?php

namespace App\Http\Controllers\backend\admin\customers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Customers_Controller extends Controller
{
    public function customers(){
        $data['customers'] = User::select('name','email','phone_number','role_as')->paginate(10);
        return view('backend.customers.index',$data);
    }
}
