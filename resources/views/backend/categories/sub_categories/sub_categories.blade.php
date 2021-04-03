@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<ul class="nav nav-tabs my-4">
 
      <li class="nav-item">
        <a class="nav-link active" href="{{route('admin.subcategories')}}">Category List</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.subcategory.new')}}">Add SubCategory</a>
      </li>
  
  </ul>
    
<div class="well">
    <h3 class="mb-3">SubCategory List</h3>
    <p>
    <a class="btn btn-success" href="{{route('admin.subcategory.new')}}">Add SubCategory</a>
    
    </p>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th>Id</th>
    <th>Sub_category</th>
    <th>Slug</th>
    <th>Action</th>
    </tr>
    </thead>
    
    <tbody>
    

    @foreach($subcategories as $category)


    <tr>
    <td>{{$category->id}}</td>
    <td>{{$category->name}}</td>
    <td>{{$category->slug}}</td>
    <td>
        <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-info text-white mr-3">Details</a>
        <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-warning mr-3">Edit</a>
      <form class="d-inline" action="{{route('admin.category.delete', $category->id)}}" method="POST">
      @csrf
      @method('Delete')
      <button type="submit" class="btn btn-danger">Delete</button>

      </form>
   
    </td>
    </tr>

    @endforeach
    
    </tbody>
    
    </table>
    <div class="d-flex justify-content-center align-items-center mb-4 bg-secondary pt-3">
      {{$subcategories->links()}}
      </div>
      </div>
    </div>

@endsection