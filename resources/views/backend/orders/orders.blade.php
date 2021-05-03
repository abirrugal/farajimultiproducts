@extends('backend.layouts.admin_layouts')


@section('title')
Customer's Orders.
@endsection

@section('main')
<div class="well">
    <h3 class="my-4">Orders List</h3>
  
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th class="h5 p-3">Id</th>
    <th class="h5 p-3">Customer's Name</th>
    <th class="h5 p-3">Customer's Phone No</th>
    <th class="h5 p-3">Customer's City</th>
    <th class="h5 p-3">Action</th>
    </tr>
    </thead>
    
    <tbody>
    
    
    @foreach($orders as $order)
    <tr>
    <td class="h6">{{$order->id}}</td>
    <td class="h5">{{$order->customer_name}}</td>
    <td class="h6">{{$order->customer_phone_number}}</td>
    <td class="h6">{{$order->city}}</td>

    <td class="d-flex justify-content-center align-items-center">
        <a  href="{{route('admin.order.show', $order->id)}}" class="mt-2 btn btn-info text-white me-3">Details</a>
      <form class="d-inline "  action="{{route('admin.order.delete', $order->id)}}" method="POST">
      @csrf
      @method('Delete')
      <button type="submit" class="btn btn-danger mt-2">Delete</button>

      </form>

    
    </td>
    </tr>
    @endforeach
    
    
    </tbody>
    
    </table>
    <div class="d-flex justify-content-center align-items-center mb-4 bg-secondary pt-3">
    {{$orders->links()}}
    </div>
    </div>
    </div>



@endsection