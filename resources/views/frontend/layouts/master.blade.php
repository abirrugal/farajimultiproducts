<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>{{config('app.name')}}</title>


                              
               {{-- Alertyfy Requirement files  --}}

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>


                           {{-- Google font  --}}

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">

                            {{-- CSS Files  --}}
{{-- Bootstrap5  --}}
        <link rel="stylesheet" href="{{asset('css/bootstrap5.css?v=').time()}}">
{{-- Custom css  --}}
        <link rel="stylesheet" href="{{asset('css/custom.css?v=').time()}}">
        <link rel="stylesheet" href="{{asset('css/slider.css?v=').time()}}">
{{-- Sidebar  --}}
        <link rel="stylesheet" href="{{asset('css/sidemenu.css?v=').time()}}">
{{-- Font Awesome--}}
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />


                             {{-- JavaScript --}}
{{-- Custom Js  --}}
        <script src="{{asset('js/custom.js')}}"></script>
{{-- Bootstrap5  --}}
        <script src="{{asset('js/bootstrap5.js')}}"></script>
{{-- Jquery and other required Js files  --}}
        <script src="{{asset('js/app.js')}}"></script>



      
    </head>
    <body>

       @include('frontend.partials.header')
       @include('frontend.partials.helpmenu')

       
       @include('frontend.partials.sidemenu')

          
          <main role="main">
<div class="container">


@if (session('message'))
  <div class="alert alert-{{session('type')}} mt-3">{{session('message')}}</div>
@endif
</div>

         
           @yield('main')    

          </main>
    
          @include('frontend.partials.footer')


 @yield('before_body')

    

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{asset('js/cart.js')}}" type="text/javascript"></script>
<script src="{{asset('js/sidemenu.js')}}" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

 
    </body>
</html>
