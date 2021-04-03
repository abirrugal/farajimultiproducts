@extends('frontend.layouts.master') @section('main')

<div class="my-5">
<div class="container-fluid">
    <div class="m-3">
    @if (session('success'))

    <div class="alert alert-success">
        {{session('success')}}
    </div>
        
    @endif
    </div>
    <div class="row">


        <div class="col-md-8  p-1 py-sm-2 pl-sm-3 pr-sm-2 mt-3"> 


            <ul class="list-group mb-3">

                <li class="list-group-item d-flex justify-content-between  lh-condensed pt-3">

         
              
                    <h2 class="cart-heading">Shopping Cart</h2>
                    <div class="text-title d-md-flex align-items-end mr-3 d-none">Price</div>

                 </li>

                 @empty(session('cart'))
                <li class="list-group-item lh-condensed pt-3 text-center">              
                    
                    <div class="cart-title">Your Cart Is Empty.</div>                 
                                   

                 </li>
                 @endempty
                

           

                @if(session('cart'))
                

                    {{-- small screen --}}
                 
                    <li class="d-md-none list-group-item  bg-light ">

                        <span class=" pt-1 h5">Subtotal: {{' '}}</span>
                        <strong class="h5 font-weight-bold pt-1">৳ {{number_format($totalPrice, 2) }}</strong>
    
                    </li>
 @if($totalProducts)
                    <li class="d-md-none list-group-item px-1 py-2 sticky-top border-none">

                        <a href="{{route('checkout')}}"> <button class="btn btn-lg btn-block btn-success "> Proceed to checkout ({{$totalProducts}} items) </button></a>
     
                     </li>
 @endif

                @foreach(session('cart') as $key => $product)



                <li class="list-group-item lh-condensed pt-3">

                    <div class="row"> {{-- This is --}} {{--
                        <div class="col-12 ">

                            <div class="row "> --}}

                                <div class="col-4 col-sm-3 pt-2 pt-sm-1">
                                    <img class="img-fluid " height="250px " src="{{$product['image']}}" alt="" />

                                </div>

                                <div class="col-8 col-sm-6">

                                    {{--<p class="text-description">Quantity : {{$product['quantity']}}</p> --}}
                                    <div class=" cart-title"> {{$product['title']}}</div>
                                    <strong class="  d-sm-none justify-content-end ">Price : {{$product['price']}}</strong>
                                    <div class=""> In Stock</div>

                                    <div class="mb-2"> Quantity:</div> 
                                    
                                    <form action="{{route('change.qty', $key)}}" class="d-flex">
                                    
                                            @if($product['quantity'] === 1) 

                                            <button type="submit" value="down" onclick="return confirm('Reduce the product quantity less then 1 will remove the product ! Do you want to remove ?')" name="change_to" class="btn btn-danger">x</button>

                                            @else 

                                            <button type="submit" value="down" name="change_to" class="btn btn-danger">
                                                - 
                                        </button>
                                        @endif



                                        <input type="number" value="{{$product['quantity']}}"  disabled>

                                        <button type="submit" value="up" name="change_to" class="btn btn-success">
                                          +

                                        </button>

                                    </form>

<hr>
<form action="{{route('cart.destroy')}}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{$key}}">
    <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
</form>

                                </div>

                                <div class="col-sm-3">
                                    <strong class=" d-none  d-sm-flex justify-content-end mt-1">Price : ৳ {{$product['price']}}</strong>

                                </div>


                                {{-- </div>

                        </div> --}}

                    </div>

                </li>
     

                 
                
    
                @endforeach


                <li class="list-group-item lh-condensed pt-3 px-1 text-center d-none d-sm-flex justify-content-end">
                    <div class="">
                    <span class="pt-1 h5">Subtotal ( {{$totalProducts}} items ): &nbsp;</span>
                    <strong class="h5 font-weight-bold pt-1 mr-3">  ৳ {{number_format($totalPrice, 2) }}</strong>
                    </div>
                </li>
  
@endif



            </ul>
            @if(session('cart'))
            <a href="{{route('cart.clear')}}"><div class="btn btn-danger float-right">Clear all</div></a>
            @endif
        </div>



        <div class="col-md-4 pl-md-2 px-0 px-sm-2"> {{-- This is main division it divided into two section, This is 2nd --}}

            <ul class="list-group mt-4 ">
                {{--
                <li class="list-group-item active">

                    Checkout

                </li> --}}
                <li class="list-group-item justify-content-between bg-light d-none d-md-flex">

                    <div class="text-success ">
                        <h5 class="my-0">Promo code</h5>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success ">-৳0</span>

                </li>
                {{-- small screen --}}

                {{-- <li class="d-sm-none list-group-item  bg-light text-center ">

                    <div class=" pt-1 h5">Subtotal ( {{$totalProducts}} items ) </div>
                    <strong class="h5 font-weight-bold pt-1">৳ {{number_format($totalPrice, 2) }}</strong>

                </li> --}}

                {{-- Medium screen --}}

                <li class="d-none d-md-block d-lg-none list-group-item text-center bg-light w-100">

                    <div class="h5 pt-1 px-0">Subtotal( {{$totalProducts}} items ) </div>
                    <strong class="h5 font-weight-bold pt-1 mx-2 ">৳ {{number_format($totalPrice, 2) }}</strong>

                </li>

                {{-- Large screen --}}
                <li class="d-none d-lg-flex list-group-item justify-content-between bg-light flex-wrap">

                    <div class="h5 pt-1">Subtotal ( {{$totalProducts}} items ) </div>
                    <strong class="h5 font-weight-bold pt-1">৳ {{number_format($totalPrice, 2) }}</strong>

                </li>


@if($totalProducts)
                <li class="list-group-item d-none d-md-block">

                   <a href="{{route('checkout')}}"> <button class="btn btn-lg btn-block btn-success"> Proceed to checkout </button></a>

                </li>
@endif



            </ul>
            <form class="card p-2 d-none d-md-block">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>


        </div>

    </div>

</div>
</div>

@endsection


@section('before_body')


@endsection
