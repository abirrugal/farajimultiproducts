
                   {{-- Sidebar Required files  --}}
    <link rel="stylesheet" href="{{asset('css/style.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css?v=').time()}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css?v=').time()}}">


{{-- Navbar  --}}
  
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 py-3" href="{{route('frontend.product.index')}}">E-Ecommerce</a>

  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <input class="form-control form-control-dark w-100 mx-3" type="text" placeholder="Search" aria-label="Search">


  <ul class="navbar-nav px-3">

    <li class="nav-item text-nowrap text-white">

      @php
          
$data=[];
$data['cart'] = session('cart')? session('cart'):[];
$totalProducts = array_sum(array_column($data['cart'],'quantity'));
      @endphp
     
     <a href="{{route('cart.index')}}" class="text-white"><i class="fas fa-cart-plus"></i> <span id="total_cart_items">{{$totalProducts}}</span></a>
      
      </li>
  </ul>


  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>

  
</nav>


  
  {{-- Sidebar  --}}

  <aside class="sidebar ">
    <div class="toggle">
      <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>
    </div>
    <div class="side-inner">

      <div class="profile">
        <img src="images/person_4.jpg" alt="Image" class="img-fluid">
        <h3 class="name">Craig David</h3>
        <span class="country">Web Designer</span>
      </div>

      
      <div class="nav-menu">
        <ul>
          <li class="accordion">
            <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsible">
              <span class="icon-home mr-3"></span>Categories
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
              <div>
                <ul>
                  @foreach ($categories as $category)
                  <li><a href="{{$category->slug}}">{{$category->name}}</a></li>
       
                  @endforeach
                  
                  
                </ul>
              </div>
            </div>
          </li>
          <li class="accordion">
            <a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsible">
              <span class="icon-search2 mr-3"></span>Explore
            </a>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne">
              <div>
                <ul>
                  <li><a href="#">Interior</a></li>
                  <li><a href="#">Food</a></li>
                  <li><a href="#">Travel</a></li>
                </ul>
              </div>
            </div>

          </li>
          <li><a href="#"><span class="icon-notifications mr-3"></span>Notifications</a></li>
          <li><a href="#"><span class="icon-location-arrow mr-3"></span>Direct</a></li>
          <li><a href="#"><span class="icon-pie-chart mr-3"></span>Stats</a></li>
          <li><a href="#"><span class="icon-sign-out mr-3"></span>Sign out</a></li>
        </ul>
      </div>
    </div>
    
  </aside>

  




