
@extends('backend.layouts.admin_layouts')


@section('title')
    Products List.
@endsection

@section('main')
<ul class="nav nav-tabs my-4">
 
  <li class="nav-item">
    <a class="nav-link active" href="#">Products List</a>
  </li>

  <li class="nav-item">
    <a class="nav-link " href="{{route('admin.products.new')}}">Add Product</a>
  </li>

</ul>



<div class="well">
<h3 class="my-4">Product's List</h3>
<p>
<a class="btn btn-success" href="{{route('admin.products.new')}}">Add Product</a>

</p>
<div class="table-responsive">
<table class="table table-bordered table-condensed">

<thead>
<tr>
<th class="h5 p-3">Id</th>
<th class="h5 p-3">Image</th>
<th class="h5 p-3">Product's Name</th>
<th class="h5 p-3">Stock Status</th>
<th class="h5 p-3">Price</th>
<th class="h6 p-3">Discounted Price<div class="text-muted btn-sm">Price after discount</div></th>
<th class="h5 p-3">Action</th>
</tr>
</thead>

<tbody>


@foreach($allproducts as $product)
<tr>
<td class="h6">{{$product->id}}</td>
<td class="h5"><img width="110px" height="110px" src="{{asset('allfiles/products_image').'/'.$product->image}}" alt=""></td>
<td class="h5">{{$product->title}}</td>
<td class="h6">{{ $product->in_stock ===1? 'In Stock' : 'Out Of Stock'}}</td>
<td class="h6">{{number_format($product->price,2)}}</td>
<td class="h6">{{$product->sale_price === null? 'No Discount' : number_format($product->sale_price, 2) }}</td>

<td class="d-flex justify-content-center align-items-center">
    <a  href="{{route('admin.products.show', $product->id)}}" class="mt-2 btn btn-info text-white me-3">Details</a>
    <a  href="{{route('admin.products.edit', $product->id)}}" class="mt-2 btn btn-warning me-3">Edit</a>
  <form class="d-inline " onclick="return confirm('Sure to delete product ?')"  action="{{route('admin.products.delete', $product->id)}}" method="POST">
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
{{$allproducts->links()}}
</div>
</div>
</div>
@endsection


