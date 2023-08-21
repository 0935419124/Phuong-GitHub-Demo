<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="{{ URL::asset('images/favicon.png')}}" />
  <title>@yield('title')</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/linericon/style.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('css/themify-icons.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('css/flaticon.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/lightbox/simpleLightbox.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/nice-select/css/nice-select.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/animate-css/animate.css')}}" />
  <link rel="stylesheet" href="{{ URL::asset('vendors/jquery-ui/jquery-ui.css')}}" />
  <!-- main css -->
  <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('css/cart.css')}}" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
<link rel="stylesheet" href="{{ URL::asset('css/temp.css')}}" />
  <style>
    
  </style>
</head>

<body>
  <!--================Header Menu Area =================-->
    @include('client/partials/_header')
  <!--================Header Menu Area =================-->
     @yield('content')

  <!--================ start footer Area  =================-->
    @include('client/partials/_footer')
  <!--================ End footer Area  =================-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{ URL::asset('js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{ URL::asset('js/popper.js')}}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js')}}"></script>
  <script src="{{ URL::asset('js/stellar.js')}}"></script>
  <script src="{{ URL::asset('vendors/lightbox/simpleLightbox.min.js')}}"></script>
  <script src="{{ URL::asset('vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
  <script src="{{ URL::asset('vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ URL::asset('vendors/isotope/isotope-min.js')}}"></script>
  <script src="{{ URL::asset('vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{ URL::asset('js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{ URL::asset('vendors/counter-up/jquery.waypoints.min.js')}}"></script>
  <script src="{{ URL::asset('vendors/counter-up/jquery.counterup.js')}}"></script>
  <script src="{{ URL::asset('js/mail-script.js')}}"></script>
  <script src="{{ URL::asset('js/theme.js')}}"></script>
  <script></script>
</body>

</html>