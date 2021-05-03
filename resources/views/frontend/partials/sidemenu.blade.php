
<div id="mySidenav" class="side_menu">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

<div class="p-3 bg-white" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-5 fw-semibold">Collapsible</span>
    </a>
    <ul class="list-unstyled ps-0">

 @foreach($categories as $category)


 
      <li class="mb-1">
        @if($category->child_category->count()>0)

      
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#{{$category->slug}}" aria-expanded="false">
          {{$category->name}}
        </button>
      
        @else
        <button class="btn btn_no_toggle align-items-center rounded collapsed">
          {{$category->name}}
        </button>
        @endif

  

        <div class="collapse" id="{{$category->slug}}">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">

            @foreach($category->child_category as $subcategory)

            <li><a href="{{route('frontend.product.products_list',$subcategory->slug)}}" class="link-dark rounded">{{$subcategory->name}}</a></li>
           
            @endforeach

          </ul>
        </div>
      </li>
 @endforeach
      {{-- <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Orders
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">New</a></li>
            <li><a href="#" class="link-dark rounded">Processed</a></li>
            <li><a href="#" class="link-dark rounded">Shipped</a></li>
            <li><a href="#" class="link-dark rounded">Returned</a></li>
          </ul>
        </div>
      </li> --}}
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Account
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">New...</a></li>
            <li><a href="#" class="link-dark rounded">Profile</a></li>
            <li><a href="#" class="link-dark rounded">Settings</a></li>
            <li><a href="#" class="link-dark rounded">Sign out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>