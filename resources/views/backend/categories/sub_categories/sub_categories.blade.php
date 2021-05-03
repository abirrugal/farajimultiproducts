@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<ul class="nav nav-tabs my-4">
 
      <li class="nav-item">
        <a class="nav-link active" href="{{route('admin.subcategories')}}">Sub-Category List</a>
      </li>

      <li class="nav-item">
        <a class="nav-link " href="{{route('admin.subcategory.new')}}">Add Sub-Category</a>
      </li>
  
  </ul>
    
<div class="well">
    <h3 class="mb-3">SubCategory List</h3>
    <p>
    <a class="btn btn-success" href="{{route('admin.subcategory.new')}}">Add Sub-Category</a>
    
    </p>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th class="h5">Id</th>
    <th class="h5">Sub_category</th>
    <th class="h5">Under_category</th>
    <th class="h5">Action</th>

    </tr>
    </thead>
    
    <tbody>
    

    @foreach($allcategories as $child)


<tr>
  <td class="h6">{{$child->id}}</td>
  <td class="h5">{{$child->name}}</td>
  <td class="h5">{{$child->parent_category->name}}</td>

  <td class="d-flex justify-content-center align-items-center">
      <a href="{{route('admin.subcategory.show', $child->id)}}" class="btn btn-info text-white me-3">Details</a>
      <a href="{{route('admin.subcategory.edit', $child->id)}}" class="btn btn-warning me-3">Edit</a>
    <form class="d-inline" action="{{route('admin.subcategory.delete', $child->id)}}" method="POST">
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

      
      {{$allcategories->links()}}
      

      </div>
      </div>
    </div>

@endsection