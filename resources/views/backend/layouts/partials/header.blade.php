 @php
     use Illuminate\Http\Request;
 @endphp

 <!-- Sidebar -->

 <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">

      <a href="{{route('admin.dashboard')}}" class="list-group-item list-group-item-action py-2 ripple {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}"  aria-current="true">
        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
      </a>


      <a href="{{route('admin.orders')}}" class="list-group-item list-group-item-action py-2 ripple {{ (request()->segment(2) == 'orders') ? 'active' : '' }}"><i
        class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>

     

          <a href="{{route("admin.products")}}" class="list-group-item list-group-item-action py-2 ripple {{ (request()->segment(2) == 'products') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus-fill me-3" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
            </svg>Products
  
          </a>
        

     
        <a href="{{route('admin.customers')}}" class="list-group-item list-group-item-action py-2 ripple {{ (request()->segment(2) == 'customers') ? 'active' : '' }}">        
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill me-3" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
          </svg>
          <span>Customers</span></a>





      <li class="nav-item dropdown list-unstyled">
        <a href="" class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center text-black {{ (request()->segment(1) == 'categories'||'subcategories') ? 'active' : '' }}"
          id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-chart-pie fa-fw me-3"></i><span class="me-3">Categories</span> <i class="fas fa-chevron-down ms-auto"></i>

        </a>
        <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="navbarDropdownMenuLink">
          <li class="border-top p-3"><a class="dropdown-item {{ (request()->segment(1) == 'categories') ? 'active' : '' }}" href="{{route("admin.categories")}}">Categories</a></li>
          <li class="border-top p-3"><a class="dropdown-item {{ (request()->segment(1) =='subcategories') ? 'active' : '' }}" href="{{route("admin.subcategories")}}">Sub-Categories</a></li>
          <li class="border-top p-3"><a class="dropdown-item {{ (request()->segment(1) =='childcategories') ? 'active' : '' }}" href="{{route("admin.childcategories")}}">Child-Categories</a></li>
        </ul>
      </li>


    </div>
  </div>
</nav>
<!-- Sidebar -->




<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
      aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="#">

<div class="h5">Electro</div>
    </a>
    <!-- Search form -->
    <form class="d-none d-md-flex input-group w-auto my-auto">
      <input autocomplete="off" type="search" class="form-control rounded"
        placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
      <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
    </form>

    <!-- Right links -->
    <ul class="navbar-nav ms-auto d-flex flex-row">
      <li class="nav-item me-4">

        <a href="{{route('frontend.product.index')}}"><button class="btn btn-secondary">Goto Clint View</button></a>
      </li>
      <!-- Notification dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
          role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">Some news</a></li>
          <li><a class="dropdown-item" href="#">Another news</a></li>
          <li>
            <a class="dropdown-item" href="#">Something else</a>
          </li>
        </ul>
      </li>

      
   
      <!-- Icon -->
      <li class="nav-item me-3 me-lg-0">
        <a class="nav-link" href="#">
          <i class="fab fa-github"></i>
        </a>
      </li>

    

      <!-- Avatar -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
          id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22"
            alt="" loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">My profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li>
            <form class="dropdown-item" action="{{route('logout')}}" method="POST">
              @csrf
            <button type="submit" class="btn btn-secondary mt-2 w-100">Logout</button> 
            </form>
        </li>
        </ul>
      </li>
    </ul>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->