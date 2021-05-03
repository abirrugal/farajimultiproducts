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


            <div class="col-md-8  p-1 py-sm-2 ps-sm-3 pe-sm-2 ">


              <div class=" mb-3  p-2 " style="max-width: 100%;">
                <div class="row no-gutters justify-content-center">
        
                    <div class="col-md-5 ">
        
                        <img class=" w-100" src="{{asset('allfiles/products_image').'/'.$product->image}}" alt="{{$product->slug}}">
        
        
                    </div>

        
                    <div class="col-md-5" >
                        <div class="scroll_products">

                        <div class="card-body ml-3">
                            <h5 class="card-title basic-title">{!!$product->title!!}</h5>
                            <hr>
                            {{-- Check If The Sale price is available or not if is it show it otherwise show price --}} @if($product->sale_price !== null && $product->sale_price > 0)
                            <p class="card-text price-title"> BDT <strike>{{number_format($product->price,2)}}</strike> <br> BDT {{number_format($product->sale_price,2)}}</p>
                            @else
                            <p class="card-text price-title"> BDT {!! number_format($product->price,2)!!}</p>
                            @endif


                            <div class=" d-lg-none">
                                @if($product->in_stock===1)
    
                                <div class="h5 mt-4 text-success mb-3 ">In Stock</div>
                                @else
                                <div class="h5 mt-4 text-danger mb-3 ">Out Of Stock</div>
    
                                @endif
                                </div>


                            <div class="d-flex d-md-none align-items-center flex-row mb-3">
                                <form data-route="{{route('cart.store')}}" id="add_cart" method="POST">
                                    @csrf
                
                                    <input type="hidden" name="product_id" class="product_id_show" value="{{$product->id}}">
                                    <input disabled type="hidden" name="quantity_show" class="quantity_count_show w-50"  value="1">
                
                
                                    <button class="btn  add_to_cart w-100" type="submit">Add to cart</button>
                                </form>
        
        
                                <form action="{{route('buy_now', $product->id)}}" class="card ms-3" method="POST">
                                    @csrf
                                  <button class="btn btn-lg  buy_now " type="submit">Buy now</button>
                                
                            
                               </form>
            
            </div>


        
                            <div class="font-weight-bold h6">Description</div>
                            <p class="card-text description">{!!$product->description!!}</p>

                        


                        </div>
                    </div>


     


                </div>
        
        
                </div>
            </div>


            </div>



            <div class="col-md-4 ps-md-2 px-0 px-sm-2"> {{-- This is main division it divided into two section, This is 2nd --}}


              <ul class="list-group mt-4 ">
                {{--
                <li class="list-group-item active">

                    Checkout

                </li> --}}


        <li class="list-group-item">

            <div class="d-none d-lg-flex">
                @if($product->in_stock===1)

                <div class="h5 mt-3 text-success mb-3">In Stock lg</div>
                @else
                <div class="h5 mt-3 text-danger mb-3">Out Of Stock lg</div>

                @endif
                </div>

            <div class="mb-2 "> Quantity:</div>


         <div class="d-flex justify-content-start flex-row align-items-center quantity_div mb-4 mb-lg-2 ">


            <div>                                       
                     
                        <button class="btn btn-danger minus_btn_show">-</button> 
            </div>

                <button class="card-text border px-3 mx-2 d-flex align-items-center display_quantity_show w-auto" >1</button>
                {{-- <input type="number" class="display_quantity_show w-50" disabled value="1"> --}}


                <div>
                

                     <button class="btn btn-success plus_btn_show">+</button> 
                                                                                               
                </div>
            </div>

        </li>




                <li class="list-group-item justify-content-between bg-light d-none d-md-flex">

                    <div class="text-success ">
                        <h5 class="my-0">Promo code</h5>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success ">-0</span>

                </li>
         
                
      

                {{-- Large screen --}}
                <li class="d-none d-lg-flex list-group-item justify-content-between bg-light flex-wrap">

                    <strong class="h5 font-weight-bold pt-1 ">Price BDT&nbsp;<span id="lg-right-subtotal">{{number_format($product->price,2) }} </span> </strong>

                </li>


                <li class="list-group-item d-none d-md-block cart_div">

                  <form data-route="{{route('cart.store')}}" id="add_cart" method="POST">
                    @csrf

                    <input type="hidden" name="product_id" class="product_id_show" value="{{$product->id}}">
                    <input disabled type="hidden" name="quantity_show" class="quantity_count_show w-50"  value="1">


                    <button class="btn  add_to_cart w-100" type="submit">Add to cart</button>
                </form>

                <form class="card d-none d-md-block mt-3" action="{{route('buy_now', $product->id)}}" method="POST">
                      @csrf
                  <button class="btn  buy_now w-100" type="submit">Buy now</button>
                
            
               </form>
                
                </li>
                

            

            </ul>
          



            </div>

        </div>

    </div>
</div>

@endsection 
@section('before_body')


@endsection