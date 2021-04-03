@extends('frontend.layouts.master') @section('main')



<div class="container mt-4">

  
    

    @guest
    <div class="alert alert-info my-3 text-center h5">You need to login first to complete your order</div>
    <div class="jumbotron p-3">
            <div class="d-flex justify-content-center">
         <a href="{{route('login')}}"> <button class="btn btn-primary mr-2 btn-lg">Sign into your Account</button></a>
         <a href="{{route('register')}}"> <button class="btn btn-secondary btn-lg">Create an account</button></a>
        </div>
    </div>
    @endguest
@empty($totalProducts)
    <div class="alert alert-warning text-center h5">Your cart is empty. Please add some product to your cart first.</div>
@endempty


@auth
@if($totalProducts)
@foreach ($errors->all() as $message)
<div class="alert alert-danger">{{$message}}</div>
@endforeach
<div class="alert alert-info my-3">You are ordering as {{auth()->user()->name}}</div>

      <h2>Checkout form</h2>
  
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Product name</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Second product</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$8</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">-$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (USD)</span>
            <strong>$20</strong>
          </li>
        </ul>
  
        <form action="" method="POST" class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
        </form>
      </div>

  {{-- Address Start      --}}


      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>

        <form action="{{route('order')}}" method="POST" class="needs-validation" novalidate>
            @csrf
  
        <div class="mb-3">
            <label for="lastName">Name</label>
            <input type="text" class="form-control" name="name" id="Name" placeholder=""  value="{{auth()->user()->name}}" required>
            <div class="invalid-feedback">
                @error('name')
                <div class="alert-danger mt-2">{{$message}}</div>
                  @enderror
            </div>
        </div>

        

          <div class="mb-3">
            <label for="email">Phone Number<span class="text-muted">(Optional)</span></label>
            <input type="number" class="form-control" name="phone" id="phone" value="{{auth()->user()->phone_number}}" placeholder="you@example.com">
            <div class="invalid-feedback">
              @error('phone')
              <div class="alert-danger mt-2">{{$message}}</div>
              @enderror
            </div>
          </div>
  
          <div class="mb-3">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" id="address" placeholder="1234 Main St" required></textarea>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
          </div>
  
      
  
          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">City</label>
              <select class="custom-select d-block w-100" name="city" id="city" required>
                <option value="">Choose...</option>
                <option>Dhaka</option>
              </select>
           
            </div>
        
            <div class="col-md-3 mb-3">
              <label for="zip">Postal code</label>
              <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="" required>
              <div class="invalid-feedback">
                @error('postal_code')
                <div class="alert-danger mt-2">{{$message}}</div>
                @enderror
              </div>
            </div>
          </div>
          {{-- <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address">
            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="save-info">
            <label class="custom-control-label" for="save-info">Save this information for next time</label>
          </div>
          <hr class="mb-4"> --}}
  
  
    

   
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
        </form>
      </div>
    </div>
    @endif
@endauth

@endsection