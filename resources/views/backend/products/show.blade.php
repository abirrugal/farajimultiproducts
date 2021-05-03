@extends('backend.layouts.admin_layouts')

@section('title')

<div class="d-flex flex-column card justify-content-center align-items-center">
    <div class="" style="width: 18rem;">
    <img height="auto" src="{{asset('allfiles/products_image').'/'.$product->image}}" class="card-img-top w-100 img-fluid " alt="...">
    </div>
    <div class="card-body">
      <h5 class="card-title">{{$product->title}}'s Details</h5>
    </div>
  </div>
    
@endsection

@section('main')

<div class="card">
    <div class="card-body h5">
     <span class="font-weight-bold"> Product's Id</span> : {{$product->id}}
    </div>
    <div class="card-body h5">
      <span class="font-weight-bold">  Stock Status</span> : {{ $product->in_stock ===1? 'In Stock' : 'Out Of Stock'}}
    </div>
    <div class="card-body h5">
      <span class="font-weight-bold">  Product's Price</span> : BDT {{number_format($product->price,2)}}
    </div>
    <div class="card-body h5">
      <span class="font-weight-bold">  Discounted Price</span>(<span class="text-muted btn-sm">Price after discount</span>) : {{$product->sale_price === null? 'Discount unavailable' : $product->sale_price}}
    </div>
    <div class="card-body h5">
     <span class="font-weight-bold">   Active Or Inactive </span>: {{$product->active === 1? 'Active':'Inactive'}}
    </div>
    
    <div class="card-body h5">
      <span class="font-weight-bold">  Product Created Date</span> : {{$product->created_at}}
    </div>
    <div class="card-body h5">
     <span class="font-weight-bold">   Product Updated Date</span> : {{$product->updated_at}}
    </div>

    <div class="card-body ">
      <div class="font-weight-bold mb-3">   Description :</div>  {!!$product->description!!}
     </div>
  
  </div>
@endsection