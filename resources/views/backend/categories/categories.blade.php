@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<ul class="nav nav-tabs my-4">
 
      <li class="nav-item">
        <a class="nav-link active" href="#">Categories List</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.category.new')}}">Add Category</a>
      </li>
  
  </ul>
    
<div class="well">
    <h3 class="mb-3">Category List</h3>
    <p>
    <a class="btn btn-success" href="{{route('admin.category.new')}}">Add Category</a>
    
    </p>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th>Id</th>
    <th>Category</th>
    <th>Slug</th>
    <th>Action</th>
    </tr>
    </thead>
    
    <tbody>
    
    
    @foreach($allcategories as $category)
    <tr>
    <td>{{$category->id}}</td>
    <td>{{$category->name}}</td>
    <td>{{$category->slug}}</td>

    <td>
        <a  href="{{route('admin.category.show', $category->id)}}" class="mt-2 btn btn-info text-white mr-3">Details</a>
        <a  href="{{route('admin.category.edit', $category->id)}}" class="mt-2 btn btn-warning mr-3">Edit</a>
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