
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Dashboard Template · Bootstrap v4.6</title>


    
    <!-- Custom styles for this template -->
    <link href="{{asset('css/all.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/admin.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/mdb.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap5.css?v=').time()}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />


    {{-- Custom Js  --}}
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/bootstrap5.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


  </head>
  <body>
    <header>
@include('backend.layouts.partials.header')

    </header>
    
    
<main style="margin-top: 58px">
<div class="container-fluid px-1 px-sm-2 pt-4">
  <section class="mb-4">
    <div class="px-sm-3">
      <div class="card-header py-3">
        <h5 class="mb-0 text-center"><strong>
      @yield('title')
        </strong></h5>
      </div>
      <div class="">

        @if (session('message'))
            <div class="alert alert-{{session('type')}}">
              {{session('message')}}
            </div>
        @endif

      @yield('main')

    </div>
  </div>
</section>
</div>
</main>

  

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('js/admin/mdb.min.js')}}"></script>   


@yield('before_body')
  </body>
</html>
