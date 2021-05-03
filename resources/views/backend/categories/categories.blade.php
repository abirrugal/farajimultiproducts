@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

 
  @section('title')
    Categories List
  @endsection
    
  <ul class="nav nav-tabs my-4">

      <li class="nav-item ">
        <a class="nav-link active" href="#">Category List</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.category.new')}}">Add Category</a>
      </li>
  
  </ul>
    
<div class="well">
    <h3 class="my-4">Category List</h3>
    <p>
    <a class="btn btn-success" href="{{route('admin.category.new')}}">Add Category</a>
    
    </p>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th class="h5 p-3">Id</th>
    <th class="h5 p-3">Category Name</th>
    <th class="h5 p-3">Slug</th>
    <th class="h5 p-3">Action</th>
    </tr>
    </thead>
    
    <tbody>
    
    
    @foreach($allcategories as $category)
    <tr>
    <td class="h6">{{$category->id}}</td>
    <td class="h5">{{$category->name}}</td>
    <td class="h6">{{$category->slug}}</td>

    <td class="d-flex justify-content-center align-items-center">
        <a  href="{{route('admin.category.show', $category->id)}}" class="mt-2 btn btn-info text-white me-3">Details</a>
        <a  href="{{route('admin.category.edit', $category->id)}}" class="mt-2 btn btn-warning me-3">Edit</a>
      <form class="d-inline "  action="{{route('admin.category.delete', $category->id)}}" method="POST">
      @csrf
      @method('Delete')
      <button type="submit" class="btn btn-danger mt-2">Delete</button>

      </form>

    
    </td>
    </tr>
    @endforeach
    
    
    </tbody>
    
    </table>
    <div class="d-flex justify-content-center align-items-center mb-4 bg-secondary pt-3">
    {{$allcategories->links()}}
    </div>
    </div>
    </div>

@endsection