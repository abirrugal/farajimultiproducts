@extends('frontend.layouts.master') @section('main')

<div class="my-4">
    <div class="container-fluid">
        <div class="m-3">
            @if (session('success'))

            <div class="alert alert-success">
                {{session('success')}}
            </div>

            @endif
        </div>
        <div class="row">


            <div class="col-md-8  p-1 py-sm-2 ps-sm-3 pe-sm-2 mt-3">


                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between  lh-condensed pt-3">



                        <h2 class="cart-heading">Shopping Cart</h2>
                        <div class="text-title d-md-flex align-items-end me-3 d-none">Price (BDT)</div>

                    </li>

                    @empty(session('cart'))
                    <li class="list-group-item lh-condensed pt-3 text-center">

                        <div class="cart-title">Your Cart Is Empty.</div>


                    </li>
                    @endempty @if(session('cart')) {{-- small screen --}}

                    <li class="d-md-none list-group-item  bg-light ">

                        <span class=" pt-1 h5">Subtotal: (<span id="sm-right-quantity"> {{$totalProducts}} </span>items)</span>
                        <strong class="h5 font-weight-bold pt-1"> BDT&nbsp;<span id="sm_total_price">{{number_format($totalPrice, 2) }} </span></strong>

                    </li>
                    @if($totalProducts)
                    <li class="d-md-none list-group-item px-1 py-2 sticky-top border-none">

                        <a href="{{route('checkout')}}"> <button class="btn btn-lg w-100 btn-success "> Proceed to checkout ({{$totalProducts}} items) </button></a>

                    </li>
                    @endif @foreach(session('cart') as $key => $product)



                    <li class="list-group-item lh-condensed pt-3">

                        <div class="row"> {{-- This is --}} {{--
                            <div class="col-12 ">

                                <div class="row "> --}} 

                                    <div class="col-4 col-sm-3 pt-2 pt-sm-1">
                                        <img class="img-fluid " height="250px " src="{{$product['image']}}" alt="" />

                                    </div>

                                    <div class="col-8 col-sm-6">

                                   
                                        <div class=" cart-title"> {{$product['title']}}</div>
                                        <strong class="  d-sm-none justify-content-end " >Price (BDT) :  <span id="sm_single_price"> {{number_format($product['price'], 2)}} </span></strong>
                                        <div class=""> In Stock</div>

                                        <div class="mb-2"> Quantity:</div>

                                        <div class="d-flex justify-content-start align-items-center quantity_div">


              
                                            <input type="hidden" value="{{$key}}" name="id" class="btn btn-danger w-auto pass_key_down">
                                            <input type="hidden" value="down" name="change_to" class="change_down">
      
                                                <button class="btn btn-danger minus_btn" data-route="{{route('change.qty')}}">-</button> 
                                                                               
                                        <div class="card-text border px-3 mx-2 d-flex align-items-center display_quantity" >{{$product['quantity']}}</div>



                                            
                                                                                  
                                            <input type="hidden" value="{{$key}}" name="id" class="btn btn-danger w-auto pass_key_up">
                                            <input type="hidden" value="up" name="change_to" class="change_up">
      
                                             <button class="btn btn-success plus_btn" data-route="{{route('change.qty')}}">+</button> 
                                                                                                                       

                                            </div>

            

                                        <hr>
                                        <form action="{{route('cart.destroy')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$key}}">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                        </form>

                                    </div>

                                    <div class="col-sm-3">
                                        <strong class=" d-none  d-sm-flex justify-content-end mt-1" >Price (BDT) :  <span id="lg_single_price">{{number_format($product['price'], 2)}}</span></strong>

                                    </div>


                                    {{-- </div>

                            </div> --}}

                        </div>

                    </li>





                    @endforeach


                    <li class="list-group-item lh-condensed pt-3 px-1 text-center d-none d-sm-flex justify-content-end">
                        <div class="">
                            <span class="pt-1 h5">Subtotal  ( <span id="lg-down-quantity"> {{$totalProducts}} </span> items) : &nbsp;</span>
                            <strong class="h5 font-weight-bold pt-1 me-3">BDT&nbsp;<span id="lg-down-subtotal">{{number_format($totalPrice, 2) }} </span> </strong>
                        </div>
                    </li>

                    @endif



                </ul>
                @if(session('cart'))
                <a href="{{route('cart.clear')}}">
                    <div class="btn btn-danger float-end">Clear all</div>
                </a>
                @endif
            </div>



            <div class="col-md-4 ps-md-2 px-0 px-sm-2"> {{-- This is main division it divided into two section, This is 2nd --}}

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
                        <span class="text-success ">-0</span>

                    </li>
                    {{-- small screen --}} {{--
                    <li class="d-sm-none list-group-item  bg-light text-center ">

                        <div class=" pt-1 h5">Subtotal ( {{$totalProducts}} items ) </div>
                        <strong class="h5 font-weight-bold pt-1"> {{number_format($totalPrice, 2) }}</strong>

                    </li> --}} 
                    
                    {{-- Medium screen --}}

                    <li class="d-none d-md-block d-lg-none list-group-item text-center bg-light w-100">

                        <div class="h5 pt-1 px-0">Subtotal( <span id="md-right-quantity"> {{$totalProducts}} </span> items ) </div>
                        <strong class="h5 font-weight-bold pt-1 mx-2 ">BDT&nbsp;<span id="md-right-subtotal">{{number_format($totalPrice, 2) }} </span></strong>

                    </li>

                    {{-- Large screen --}}
                    <li class="d-none d-lg-flex list-group-item justify-content-between bg-light flex-wrap">

                        <div class="h5 pt-1">Subtotal ( <span id="lg-right-quantity"> {{$totalProducts}} </span> items ) </div>
                        <strong class="h5 font-weight-bold pt-1 ">BDT&nbsp;<span id="lg-right-subtotal">{{number_format($totalPrice, 2) }} </span> </strong>

                    </li>


                    @if($totalProducts)
                    <li class="list-group-item d-none d-md-block">

                        <a href="{{route('checkout')}}"> <button class="btn btn-lg w-100 btn-success"> Proceed to checkout </button></a>

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