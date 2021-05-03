@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<ul class="nav nav-tabs my-4">
  
  <li class="nav-item">
    <a class="nav-link active" href="{{route('admin.childcategories')}}">Child-Category List</a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="{{route('admin.childcategory.new')}}">Add Child-Category</a>
  </li>


  
  </ul>
    
<div class="well">
    <h3 class="my-4">Child-Category List</h3>
    <p>
    <a class="btn btn-success" href="{{route('admin.childcategory.new')}}">Add Child-Category</a>
    
    </p>
    <div class="table-responsive">
    <table class="table table-bordered table-condensed">
    
    <thead>
    <tr>
    <th class="h5 p-3">Id</th>
    <th class="h5 p-3">Child_category Name</th>
    <th class="h5 p-3">Under Sub-category</th>
    <th class="h5 p-3">Action</th>
    </tr>
    </thead>
    
    <tbody>
    
    
    @foreach($allcategories as $childcategory)

    
    <tr>
    <td class="h6">{{$childcategory->id}}</td>
    <td class="h5">{{$childcategory->name}}</td>
    <td class="h6">{{$childcategory->subcat->name}}</td>

    <td class="d-flex justify-content-center align-items-center">
        <a  href="{{route('admin.childcategory.show', $childcategory->id)}}" class="mt-2 btn btn-info text-white me-3">Details</a>
        <a  href="{{route('admin.childcategory.edit', $childcategory->id)}}" class="mt-2 btn btn-warning me-3">Edit</a>
      <form class="d-inline "  action="{{route('admin.childcategory.delete', $childcategory->id)}}" method="POST">
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