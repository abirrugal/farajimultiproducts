
@extends('frontend.layouts.master') @section('main')



<div class="container-fluid">
    <div class="row">

        <div class="col-lg-2 d-lg-block border-end mt-3">

            
                <div class="p-3 pb-2 fw-bolder border-bottom">Brand</div>

                

               <a href="{{route('frontend.product.sub_list',$sub_category->parent_category->slug)}}" class="text-decoration-none text-dark fw-bold btn-sm mx-0 px-0 mb-3"><i class="fas fa-chevron-left"></i> {{$sub_category->parent_category->name}}</a> 

                @foreach ($child_categories as $child_category)


                <div class="px-3 py-2"><a class="text-decoration-none text-dark h6 mb-3" href="{{route('frontend.product.products_list_child',$child_category->slug)}}"> {{$child_category->name}} </a></div>


                @endforeach

            

        </div>


        <div class="col-lg-10 mt-3">

            <div class="album py-1 bg-light">
                <div class="container-fluid-md">

                    <div class="card category_title text-center mb-3"> <span class="mb-2"> {{$sub_category->name}} </span>
                        <div class="border-bottom mb-3"></div>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">



                            @if($products)
    
      @foreach ($products as $product) 

      <div class="col">
          <div class=" shadow-sm h-100 mb-3">
              <div class="d-flex ">
                  <div class="w-75">
                      <a href="{{route('frontend.product.show',$product['slug'])}}"> <img class=" img-fluid rounded product_img" src=" {{asset('allfiles/products_image').'/'.$product['image']}}" alt="{{$product['slug']}}"> </a>

                  </div>
              </div>

              <div class="card-body">
                  <p class="card-text text-start"> <a class=" text-decoration-none h6" href="{{route('frontend.product.show',$product['slug'])}}"> {{$product['title']}}  </a> </p>

                  <p class="price-title-home text-start mb-3">

                      @if($product['sale_price'] !== null && $product['sale_price'] > 0) Price (BDT) :<strike> {{$product['price']}}</strike> <br> BDT {{number_format($product['price'],2) }} @else Price (BDT) : {{number_format($product['price'],2)}}
                      @endif
                  </p>
                  <div class="d-flex flex-row cart_div">

                      <form class="d-inline" data-route="{{route('cart.store')}}" id="add_cart" method="POST">
                          @csrf

                          <input type="hidden" name="product_id" class="product_id_show" value="{{$product['id']}}">

                          <button class="btn btn-sm  btn-outline-secondary mt-2  d-block " type="submit">Add to cart</button>
                      </form>

                      <form action="{{route('buy_now', $product['id'])}}" class="card ms-3" method="POST">
                        @csrf
                      <button class="btn btn-sm  btn-outline-secondary mt-2 ms-1 " type="submit">Buy now</button>
                    
                
                   </form>
                  </div>
              </div>
          </div>
      </div>
      
      @endforeach
      @endif
  </div>
  <hr>

</div>  
</div>



  @if($products)  
{!!$products->render()!!}
@endif
                        </div>
                    </div>                  
                </div>
            </div>


  



@endsection

