
@extends('backend.layouts.admin_layouts')


@section('title')
    Create New Product.
@endsection

@section('main')
<div class="row">
  <div class="col-12">

    <ul class="nav nav-tabs mb-5">
 
        
         
        <li class="nav-item">
          <a class="nav-link " href="{{route('admin.products')}}">Products List</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">Add Product</a>
          </li>
      
      
      </ul>

      @if($errors->any())
          
      @foreach ($errors->all() as $error)
          <div class="alert alert-danger mx-3 p-2">{{$error}}</div>
      @endforeach
      
      @endif


  
    <form action="{{route('admin.products')}}" method="POST" enctype="multipart/form-data">

        @csrf

      <div class="mb-3">
        <label for="title" class="form-label text-black h6">Product's Title</label>
        <input type="text" name="title" value="{{old('title')}}" class="form-control" id="title" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Enter your product's name/title here..</div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label text-black h6">Product's Descriptions</label>

       <textarea name="description" name="description" id="summary-ckeditor">{{old('description')}}</textarea>
       <div id="emailHelp" class="form-text">Enter your product's descriptions here..</div>

      </div>

      <div class="mb-3">
        <label for="image" class="form-label text-black h6">Product's Image</label>
        <input type="file" name="image"  class="form-control" id="image" aria-describedby="PriceHelp">
        <div id="emailHelp" class="form-text">Upload product's image..</div>

      </div>

      <div class="mb-3">
        <label for="price" class="form-label text-black h6">Product's Price</label>
        <textarea type="number" name="price"  class="form-control" id="price">{{old('price')}}</textarea>
        <div id="emailHelp" class="form-text">Enter your product's Original price..</div>

      </div>

      <div class="mb-3">
        <label for="sprice" class="form-label text-black h6">Product's Sell Price</label>
        <input type="number" name="sprice" value="{{old('sprice')}}" class="form-control" id="sprice" aria-describedby="PriceHelp">
        <div id="emailHelp" class="form-text">Enter your product's Sell price.</div>

      </div>


<label for="stock_status" class="form-label text-black h6">Product's Stock Status</label>
<div class="mb-3">
      <select select class="form-select" aria-label="Default select example" name="product_status" id="stock_status">

        <option value="1" {{old('product_status')=== 1? 'selected' : '' }}>Active</option>
        <option value="0" {{old('product_status')=== 0? 'selected' : '' }}>Inactive</option>

      </select>
    </div>

<label for="stock_status" class="form-label text-black h6">Product's Stock Status</label>
<div class="mb-3">
      <select select class="form-select" aria-label="Default select example" name="stock_status" id="stock_status">

        <option value="1">In Stock</option>
        <option value="0">Out Of Stock</option>

      </select>
    </div>


<label for="stock_status" class="form-label text-black h6">Select Category</label>
<div class="mb-3">
      <select id="categoryList" class="form-select" aria-label="Default select example" name="category">
        

        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach

      </select>
    </div>

   

<label for="stock_status" class="form-label text-black h6">Select Sub-Category</label>
<div class="mb-3">
      <select id="subcategoryList" select class="form-select" aria-label="Default select example" name="sub_category">
       
        @foreach ($categories as $category)
        @if($category->child_category)
        @foreach ($category->child_category as $sub)
            
        <option value="{{$sub->id}}" class='parent-{{ $sub->category_id }} subcategory'>{{$sub->name}}</option>

        @endforeach
        @endif
        @endforeach

      </select>
    </div>

    <label for="stock_status" class="form-label text-black h6">Select Child-Category</label>
    <div class="mb-3">
          <select id="childcategoryList" select class="form-select" aria-label="Default select example" name="child_category">
           
            @foreach ($categories as $category)
            @if($category->child_category)
            @foreach ($category->child_category as $sub)
            @if($sub->child->count()>0)   
            @foreach($sub->child as $child)

            <option value="{{$child->id}}" class='parent-{{ $child->subcategory_id }} childcategory'>{{$child->name}}</option>
    
            @endforeach
            @endif
            @endforeach
            @endif
            @endforeach
    
          </select>
        </div>


    <div id="emailHelp" class="form-text">Select a child-category. this is Optional</div>




      <button type="submit" class="btn btn-primary mt-3 w-100">Submit</button>
    </form>

    <script>
      CKEDITOR.replace( 'summary-ckeditor' );
      </script>

  </div>
</div>
@endsection

@section('before_body')

<script>

$('#categoryList').on('change', function () {
    $("#subcategoryList").attr('disabled', false); //enable subcategory select
    $("#subcategoryList").val("");
    $("#childcategoryList").attr('disabled', false); //enable subcategory select
    $("#childcategoryList").val("");
    $(".subcategory").attr('disabled', true); //disable all category option
    $(".subcategory").hide(); //hide all subcategory option
    $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
    $(".parent-" + $(this).val()).show(); 
});

$('#subcategoryList').on('change', function () {
    $("#childcategoryList").attr('disabled', false); //enable subcategory select
    $("#childcategoryList").val("");
    $(".childcategory").attr('disabled', true); //disable all category option
    $(".childcategory").hide(); //hide all subcategory option
    $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
    $(".parent-" + $(this).val()).show(); 
});

</script>
    
@endsection


