@extends('backend.layouts.admin_layouts')

@section('sidenav')
@include('backend.layouts.partials.side_menu')
@endsection

@section('main')

<div class="container my-4">
@section('title')
{{$subcategory->name}}
@endsection

<p class="btn-sm m-0">Created Date : {{$subcategory->created_at}}</p>
<p class="btn-sm m-0">Last Update at : {{$subcategory->updated_at}}</p>
<p class="btn ">Id : {{$subcategory->id}}</p>

<div class="card-title h5 ml-2 my-3">Sub-Categories under this Category</div>

@if($subcategory->parent_category->count()<1)
<li class="list-group-item text-center font-weight-bold h6">There is no Category in this Category</li> 

@else
<ul class="list-group ">

    <li class="list-group-item">{{$subcategory->parent_category->name}}</li> 

</ul>
@endif

@if ($subcategory->child_category)

<ul class="list-group ">
@foreach($subcategory->child_category as $child)


    <li class="list-group-item">{{$child->name}}</li> 



@endforeach




@endif



</ul>
</div>



</div>

 
    </div>
    </div>

@endsection