
@extends('frontend.layouts.master')


@section('main') 


<main>


@include('frontend.partials.slider')

 

  <div class="album pb-5 pt-5 pt-lg-0 bg-light">
    <div class="container-fluid">
      @php 
    $count = 0;
      @endphp

       
      {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3"> --}}
      <div class="product-container">

        
        
@foreach ($categories as $category)
       @php 
        if($count == 10) break; $count++;
        @endphp

        <div class="colj">
          <div class="card shadow-sm d-flex justify-content-center">

            <p class="card-text "> <a class=" text-decoration-none menu_title d-flex justify-content-center align-items-center p-2 pt-3" href="{{route('frontend.product.sub_list',$category->slug)}}"> {{$category->name}}  </a> </p>


            <div class="d-flex justify-content-center align-items-center">
        <div class="w-sm">
            <a href="{{route('frontend.product.sub_list',$category->slug)}}"> <img class=" img-fluid rounded product_img" src=" {{asset('allfiles/category_image').'/'.$category->banner}}" alt="{{$category->slug}}"> </a>

        </div>
          </div>

            <div class="card-body">

            
              <div class="d-flex justify-content-between align-items-center">
                <div class="">
               
                 <a href="{{route('frontend.product.sub_list',$category->slug)}}"><button type="button" class=" btn btn-sm btn-outline-secondary">Shop now</button></a> 
            
                </div>

                {{-- <button type="button" class="d-sm-none btn btn-sm btn-outline-secondary">Buy now</button> --}}

              </div>
            </div>
          </div>
        </div>

      @endforeach

      </div>

    </div>
  </div>

</main>



  @endsection

@section('before_body')




@endsection