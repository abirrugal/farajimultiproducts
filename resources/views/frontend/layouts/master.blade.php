<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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

        <link rel="stylesheet" href="{{asset('css/all.css?v=').time()}}">
        <link rel="stylesheet" href="{{asset('css/custom.css?v=').time()}}">

                             {{-- JavaScript --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />        
        <script src="{{asset('js/custom.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
      
    </head>
    <body>

       @include('frontend.partials.header')
          
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

    
 <script src="{{asset('js/cart.js')}}"></script>
       
      
 
    </body>
</html>
