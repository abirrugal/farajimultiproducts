
@extends('frontend.layouts.master')


@section('main') 

@include('frontend.partials.heading')


  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
    
        @foreach ($products as $product)
              
        <div class="col-md-4 col-lg-3">
          <div class="card mb-4 shadow-sm">

            <a href="{{route('frontend.product.show',$product->slug)}}" class="w-100"> <img class="img-thumbnail rounded w-100" src="{{$product->getFirstMediaUrl()}}" alt="{{$product->slug}}"/> </a>

            <div class="card-body">

              <p class="card-text"> <a href="{{route('frontend.product.show',$product->slug)}}">{{$product->title}}</a> </p>
          
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">

                 <form data-route="{{route('cart.store')}}" id="add_cart" method="POST" >
                  @csrf
                  
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  <button class="btn  btn-outline-primary" type="submit">Add to cart</button>                  
                  </form>
                 
                  {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                </div>


                
                <div class="text-muted home-price">
                  @if($product->sale_price !== null &&  $product->sale_price > 0)
              BDT <strike>{{$product->price}}</strike> <br> BDT {{$product->sale_price}}
                  @else
                  BDT {{$product->price}}
                 @endif
                </div>
                
           
               
              </div>
            </div>
          </div>
        </div>

        
        @endforeach

      </div>
      <div class="d-flex justify-content-center align-items-center border  border-primary pt-3 bg-secondary">
      {{$products->links()}}
      </div>
    </div>
  </div>
  @endsection

@section('before_body')

@endsection