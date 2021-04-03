@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<div class="container my-4">
<h3>{{$category->name}}</h3> 

<p class="btn-sm m-0">Created : {{$category->created_at}}</p>

<div class="card-title h5 ml-2 my-3">Sub-Categories under this Category</div>

@if($category->child_category->count()<1)
<li class="list-group-item text-center font-weight-bold h6">There is no Sub-Category in this Category</li> 
@endif

@if ($category->child_category)

<ul class="list-group ">
@foreach($category->child_category as $child)


    <li class="list-group-item">{{$child->name}}</li> 



@endforeach


@endif



</ul>
</div>



</div>

 
    </div>
    </div>

@endsection