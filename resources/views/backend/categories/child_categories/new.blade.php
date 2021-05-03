@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')
    
    


@if($errors->any())

@foreach($errors->all() as $error)
 <div class="alert alert-danger m-4">
 {{$error}}
 </div>
@endforeach
@endif


<ul class="nav nav-tabs my-4">
  
  <li class="nav-item">
    <a class="nav-link " href="{{route('admin.childcategories')}}">Child-Category List</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active" href="{{route('admin.childcategory.new')}}">Add Child-Category</a>
  </li>
  
  </ul>



<h3 class="my-3">Add New Child-Category</h3>

<form action="{{route("admin.childcategories")}}" method="post" enctype="multipart/form-data">
@csrf

  <div class="form-group">
    <label for="sub-category" class="h6">Child-Category Name</label>

    <input type="text" class="form-control mb-3" name="child_category" id="child_category" value="{{old('child_category')}}">
  </div>

  <div class="mb-3">
    <label for="child_img" class="form-label text-black h6">Banner image for category</label>
    <input type="file" name="child_img"  class="form-control" id="child_img" aria-describedby="PriceHelp">
    <div id="emailHelp" class="form-text">Upload Banner image..</div>

  </div>

  <div class="form-group">
    <label for="category" class="h6">Select The Sub-Category That Your Child-Category Belongs To</label>
    <select name="subcategory_id" class="form-control mb-3">
@foreach ($subCategories as $sub_category)
<option  value="{{$sub_category->id}}">{{$sub_category->name}}</option>
@endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary btn-block mt-3">Add child-Category</button>
</form>

<p class=" mt-3"> <a href="{{route('admin.childcategories')}}" >Go back to child-categories</a>  </p>


@endsection