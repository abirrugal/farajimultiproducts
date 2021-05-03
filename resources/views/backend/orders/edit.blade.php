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
      <a class="nav-link" href="{{route('admin.categories')}}">Categories List</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="#">Edit Category</a>
    </li>
  
  </ul>



<h3 class="my-3">Edit {{$category->name}}</h3>

<form action="{{route("admin.category.update", $category->id)}}" method="post">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="category">Category Name</label>
    <input type="text" class="form-control my-3" name="category" id="category" value="{{$category->name}}">
  </div>

  {{-- <div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control">
    <option value="1">Active</option>
    <option value="0">Deactive</option>
    </select>
  </div> --}}

  <button type="submit" class="btn btn-primary btn-block">Edit Category</button>
</form>

<p class=" mt-3"> <a href="{{route('admin.categories')}}" >Go back to categories</a>  </p>


@endsection