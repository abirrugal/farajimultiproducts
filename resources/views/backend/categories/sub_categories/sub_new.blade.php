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
    <a class="nav-link " href="{{route('admin.subcategories')}}">Sub-Category List</a>
  </li>

  <li class="nav-item">
    <a class="nav-link active" href="{{route('admin.subcategory.new')}}">Add SubCategory</a>
  </li>
  
  </ul>



<h3 class="my-3">Add New Sub-Category</h3>

<form action="{{route("admin.subcategories")}}" method="post">
@csrf

  <div class="form-group">
    <label for="sub-category">Sub-Category Name</label>

    <input type="text" class="form-control" name="sub_category" id="sub_category" value="{{old('sub_category')}}">
  </div>

  <div class="form-group">
    <label for="category">Select The Category That Your Sub-Category Belongs To</label>
    <select name="category_id" class="form-control">
@foreach ($categories as $category)
<option value="{{$category->id}}">{{$category->name}}</option>
@endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary btn-block">Add Category</button>
</form>

<p class=" mt-3"> <a href="{{route('admin.categories')}}" >Go back to categories</a>  </p>


@endsection