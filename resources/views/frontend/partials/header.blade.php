

<header class=" bg-dark text-white pt-lg-1 pt-1 px-3 pb-lg-0">
  <div class="container-fluid">

  <div class="row">

{{-- Title and menu-bar for sm to md screen  --}}
<div class="col-8 col-sm-6 d-flex align-items-start d-lg-none mt-4" id="menu_sm">

<svg xmlns="http://www.w3.org/2000/svg" width="32" height="30" fill="currentColor" class="bi bi-list" viewBox="3 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg>

  <a href="{{route('frontend.product.index')}}" class=" mb-lg-0 text-white text-decoration-none h6 brand">
    Electro      
  </a>


</div>
{{--End Title and menubar for sm to md screen  --}}


{{-- Login and Cart for Sm to Md  --}}
<div class="col-4 col-sm-6 d-flex justify-content-end d-lg-none mb-3 ">

  <div class="d-flex  align-items-center">

  @guest
  
<a href="{{route('login')}}"><button type="button" class="btn btn-outline-light me-3 hidden">Login</button></a>
@endguest

@auth
<a href="{{route('login')}}"><button type="button" class="btn btn-outline-light me-3 hidden">Profile</button></a>
   
@endauth

<div class="d-flex justify-content-center flex-column">

  @php

  $data=[];
  $data['cart'] = session('cart')? session('cart'):[];
  $totalProducts = array_sum(array_column($data['cart'],'quantity'));
    @endphp
 <span>
 <a href="{{route('cart.index')}}" class="text-white" style="text-decoration: none;">
  <button type="button" class="btn text-white mb-0 pb-0 "> <span id="total_cart_items">{{$totalProducts}}</span>
 </button>
</a>
 </span>
 <span>
{{-- <i class="fas fa-cart-plus h4 pt-0 mt-0 mb-4 position-reletive"></i> --}}
<svg xmlns="http://www.w3.org/2000/svg" width="39" height="26" fill="currentColor" class="bi bi-cart mt-0 pt-0 mb-4 " viewBox="1 1 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
 </span>
</div> 




</div>

  
</div>


{{-- End Sign in and Cart for Sm to Md  --}}


    <div class=" d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start ">
      
{{-- Side title for lg  --}}
      <a href="{{route('frontend.product.index')}}" class="d-none d-lg-flex align-items-center  mb-2 mb-lg-0 text-white text-decoration-none h5">
        E-Ecommerce      
      </a>


{{-- Menu visible in Large view port  --}}

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-lg-0 ms-md-3 d-none d-lg-flex">

        
        <li><a href="#" class="nav-link px-2 text-white">Services</a></li>
        <li><a href="#" class="nav-link px-2 text-white">About</a></li>
        <li><a href="#" class="nav-link px-2 text-white">Support</a></li>
     
      </ul>

{{-- End Menu Lg  --}}


{{-- Searchbar  --}}
      <form class="col-12 col-lg-4 col-xl-6  mb-3 mb-lg-0 me-lg-4">

        <div class="input-group">

          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">All</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
          </ul>


          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon2">
          <span class="input-group-text bg-warning " id="basic-addon2">


            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-search p-1 " viewBox="0 0 16 17">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>

          </span>
        </div>

      </form>
{{-- End Searchbar  --}}

{{-- Menu visible in Sm view port  --}}

<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-lg-0 ms-md-3 d-flex d-lg-none">

        
  <li><a href="#" class="nav-link px-2 text-white">Services</a></li>
  <li><a href="#" class="nav-link px-2 text-white">About</a></li>
  <li><a href="#" class="nav-link px-2 text-white">Support</a></li>

</ul>
{{-- End Menu Sm    --}}


@guest
      <div class="text-end d-none d-lg-flex">
    <a href="{{route('login')}}"><button type="button" class="btn btn-outline-light ms-2 me-3">Login</button></a>
       <a href="{{route('register')}}"><button type="button" class="btn btn-warning">Sign-up</button></a>
      </div>

@endguest

      @auth
      <div class="text-end d-none d-lg-flex">
        <a href="#"><button type="button" class="btn btn-outline-light me-3">Profile</button></a>
        <form action="{{route('logout')}}" method="POST" class="d-inline">
          @csrf
        <button type="submit"  class="btn btn-warning">Logout</button>
        </form>
      </div> 
      @endauth

      <div class="text-end d-flex flex-column align-items-center ms-3 d-none d-lg-flex">


        @php
      
        $data=[];
        $data['cart'] = session('cart')? session('cart'):[];
        $totalProducts = array_sum(array_column($data['cart'],'quantity'));
          @endphp
       
        
        <button type="button" class="btn text-white mb-0 pb-0 "> 
          <a href="{{route('cart.index')}}" class="text-white m-0 p-0" style="text-decoration: none;"> 

          <span id="total_cart_itemsrrrr">{{$totalProducts}}</span>
        </a>
       </button>
      
       <a href="{{route('cart.index')}}" class="text-white m-0 p-0" style="text-decoration: none;"> 

      <svg xmlns="http://www.w3.org/2000/svg" width="39" height="26" fill="currentColor" class="bi bi-cart mt-0 pt-0 mb-4" viewBox="1 1 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
    </a>


      </div> 



    </div>
  </div>
</header>




{{-- <header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="{{route('frontend.product.index')}}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        E-Ecommerce
      </a>

      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        <input type="search" class="form-control form-control-dark" placeholder="Search...">
      </form>

    @guest
      <div class="text-end">
        <button type="button" class="btn btn-outline-light me-2">Login</button>
        <button type="button" class="btn btn-warning">Sign-up</button>
      </div>
   @endguest

   @auth
      <div class="text-end">
        <button type="button" class="btn btn-outline-light me-2">Profile</button>
        <button type="button" class="btn btn-warning">Logout</button>
      </div>
    @endauth

      <div class="text-end">

        @php
      
        $data=[];
        $data['cart'] = session('cart')? session('cart'):[];
        $totalProducts = array_sum(array_column($data['cart'],'quantity'));
          @endphp
       
       <a href="{{route('cart.index')}}" class="text-white" style="text-decoration: none;"> <button type="button" class="btn btn-outline-light me-2"><i class="fas fa-cart-plus"></i> <span id="total_cart_items">{{$totalProducts}}</span>
       </button></a>

      </div>

       
      

    </div>
  </div>
</header> --}}







{{-- Navbar  --}}
{{--   
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 py-3" href="{{route('frontend.product.index')}}">E-Ecommerce</a>


   <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
  <input class="form-control form-control-light w-100" type="text" placeholder="Search" aria-label="Search">
      </form>


  <ul class="navbar-nav px-3 d-flex flex-row mx-2 justify-content-center align-items-center ">

  


      @guest

      <li class="nav-item text-nowrap mx-2">
        <a class="nav-link text-white  " href="#">  <button type="button" class="btn btn-warning">Sign-up</button>  </a>
      </li>

      <li class="nav-item text-nowrap mx-2">
         <a class="nav-link text-white  " href="#"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
      </li>
  
  
  @endguest


  @auth



  

    <li class="nav-item text-nowrap mx-2">
      <a class="nav-link text-white  " href="#">{{auth()->user()->name}}</a>
    </li>
    <li class="nav-item text-nowrap mx-2">
      <a class="nav-link text-white  " href="#">Sign out</a>
    </li>

   

@endauth

<li class="nav-item text-nowrap text-white mx-2 ">

  @php
      
$data=[];
$data['cart'] = session('cart')? session('cart'):[];
$totalProducts = array_sum(array_column($data['cart'],'quantity'));
  @endphp
 
 <a href="{{route('cart.index')}}" class="text-white" style="text-decoration: none;"><i class="fas fa-cart-plus"></i> <span id="total_cart_items">{{$totalProducts}}</span></a>
  
  </li>


  </ul>

</nav> --}}

  


