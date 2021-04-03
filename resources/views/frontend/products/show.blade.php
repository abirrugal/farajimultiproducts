@extends('frontend.layouts.master')

@section('main')
    
<div class="container-md">
<div class="card mb-3 mt-4 p-4 border" style="max-width: 100%;">
    <div class="row no-gutters justify-content-center">
        
      <div class="col-md-5 ">

        <img class="img-thumbnail rounded w-100" src="{{$product->getFirstMediaUrl()}}" alt="{{$product->slug}}">


      </div>

      <div class="col-md-5 ">
        <div class="card-body ml-3">
          <h5 class="card-title basic-title">{{$product->title}}</h5>
{{-- Check If The Sale price is available or not if is it show it otherwise show price --}}
          @if($product->sale_price !== null &&  $product->sale_price > 0)
          <p class="card-text price-title"> BDT <strike>{{$product->price}}</strike> <br> BDT {{$product->sale_price}}</p>
          @else
          <p class="card-text price-title"> BDT {{$product->price}}</p>
          @endif

          <div class="font-weight-bold">Description</div>
          <p class="card-text description">{{$product->description}}</p>
          <hr>


          <form action="{{route('cart.store')}}" method="POST">
            @csrf
            
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button type="submit" class="btn  btn-outline-primary">Add to Cart</button>
            
            </form>

          
        </div>
      </div>


    </div>
  </div>
  </div>

  @endsection