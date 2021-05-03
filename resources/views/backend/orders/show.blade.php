@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<div class="my-4">
@section('title')
{{$order->customer_name}}'s Order Details.
@endsection

<div class="row">

<div class="col-md-6">
  <h5 class="card-title text-center py-3 border">Customer's Details</h5>

  <ul class="list-group">

    
    <div class="list-group-item d-flex flex-column">
      <div class="title fw-bold">Name : </div>
      <div class="ps-2 ">{{ $order->customer_name}} </div>
     </div>

    <div class="list-group-item d-flex flex-column">
      <div class="title fw-bold">Phone no : </div>
      <div class="ps-2 "> {{ $order->customer_phone_number}} </div>
     </div>
    <div class="list-group-item d-flex flex-column">
      <div class="title fw-bold"> Address : </div>
      <div class="ps-2 "> {{ $order->address}} </div>
     </div>
    <div class="list-group-item d-flex flex-column">
      <div class="title fw-bold"> City : </div>
      <div class="ps-2 "> {{$order->city}} </div>
     </div>
    <div class="list-group-item d-flex flex-column">
      <div class="title fw-bold"> Postal code : </div>
      <div class="ps-2 "> {{$order->postal_code}} </div>
     </div>

  </ul>
  </div>



  <div class="col-md-6">
    <h5 class="card-title text-center py-3 border">Order's Details</h5>

    <ul class="list-group">
  
      <div class="list-group-item d-flex">
         <div class="title fw-bold"> Order's Id : </div>
         <div class="ps-2 "> {{$order->id}} </div>
       </div>
      
      
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold">Total amount (BDT) : </div>
        <div class="ps-2 ">{{number_format($order->total_amount,2)}} </div>
       </div>
  
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold"> Discount amount (BDT) : </div>
        <div class="ps-2 ">{{number_format($order->discount_amount,2)}}</div>
       </div>
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold">Paid amount (BDT) : </div>
        <div class="ps-2 "> {{number_format($order->paid_amount,2)}} </div>
       </div>
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold">Payment Status : </div>
        <div class="ps-2 "> {{$order->payment_status}} </div>
       </div>
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold">Operational Status : </div>
        <div class="ps-2 "> {{$order->operational_status}} </div>
       </div>
      <div class="list-group-item d-flex flex-column">
        <div class="title fw-bold">Proccessed By : </div>
        <div class="ps-2 "> {{$order->processed_by}} </div>
       </div>
      
       
  
    </ul>
    </div>


    <div class="card">
      <h4 class="card-title text-center py-3 border">Order Product's Details</h4>

      <table class="table">
        <thead>
          <tr class="h5">
            <th scope="col">Products</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            
          </tr>
        </thead>
      
        <tbody>
      @foreach ($order->orderProducts as $orderProduct)

          <tr>
            
            <td class="h6">{{$orderProduct->product->title}}</td>
            <td class="h6">{{$orderProduct->quantity}}</td>
            <td class="h6">{{number_format($orderProduct->price,2)}}</td>
            
          </tr>
     
      
      {{-- <div class="d-flex justify-content-center border">
      <div class="card-body h5">
        <span class="font-weight-bold">Product's Name</span> : {{$orderProduct->product->title}}  
       </div>
       <div class="card-body h5">
        <span class="font-weight-bold">Quantity</span> : {{$orderProduct->quantity}}
       </div>
       <div class="card-body h5">
        <span class="font-weight-bold">Price (BDT)</span> : {{number_format($orderProduct->price,2)}}
       </div>
      
       </div> --}}
      
       @endforeach
      
      </tbody>
    </table>
      
       <div class="card-body h5 d-flex justify-content-center me-4">
        <span class="font-weight-bold ">Total Amount (BDT) :&nbsp; </span> <span class="me-3">{{number_format($order->total_amount,2)}}</span>
      </div>
      
        </div>





  </div>
  </div>



{{-- <div class="card">
  <h4 class="card-title text-center py-3 border">Customer's Details</h4>

 
   
    <div class="card-body h5 my-0">
      <span class="font-weight-bold">  Total Amount (BDT)</span> : {{number_format($order->total_amount,2)}}
    </div>
    <div class="card-body h5 my-0">
      <span class="font-weight-bold">  Discount Amount  (BDT) /span> : {{number_format($order->discount_amount,2)}}
    </div>
    <div class="card-body h5 my-0">
      <span class="font-weight-bold">  Paid Amount (BDT)</span> : {{number_format($order->paid_amount,2)}}
    </div>
    <div class="card-body h5 my-0">
     <span class="font-weight-bold">Payment Status</span> : {{$order->payment_status}}
    </div>
    <div class="card-body h5 my-0">
     <span class="font-weight-bold">Operational Status</span> : {{$order->operational_status}}
    </div>
    
    <div class="card-body h5 my-0">
     <span class="font-weight-bold">Proccessed By</span> : {{$order->processed_by}}
    </div>
    
  
  </div>
<hr>
  <div class="card">
<h4 class="card-title text-center py-3 border">Order Product's Details</h4>

@foreach ($order->orderProducts as $orderProduct)

<div class="d-flex justify-content-center border">
<div class="card-body h5">
  <span class="font-weight-bold">Product's Name</span> : {{$orderProduct->product->title}}  
 </div>
 <div class="card-body h5">
  <span class="font-weight-bold">Quantity</span> : {{$orderProduct->quantity}}
 </div>
 <div class="card-body h5">
  <span class="font-weight-bold">Price (BDT)</span> : {{number_format($orderProduct->price,2)}}
 </div>

 </div>

 @endforeach


 <div class="card-body h5 d-flex justify-content-center me-4">
  <span class="font-weight-bold ">Total Amount (BDT) :&nbsp; </span> <span class="me-3">{{number_format($order->total_amount,2)}}</span>
</div>

  </div>

</div> --}}

@endsection