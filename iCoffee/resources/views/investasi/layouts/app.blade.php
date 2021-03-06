<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
  
  <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{asset('investasi/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/animate.css') }}">
  
  <link rel="stylesheet" href="{{asset('investasi/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/aos.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/jquery.timepicker.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/images.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/icomoon.css') }}">
  <link href="{{asset('investasi/css/style.css') }}" rel="stylesheet" type="text/css">
  <link href="{{asset('investasi/css/sb-admin-2.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="{{asset('landing_page/images/favicon.png') }}">
  <meta name="google-site-verification" content="yr0b1EXiV-YTqxP_WX3A3LGbEtl805Xnq-hrlgDxj78" />
  @livewireStyles
  @yield('css')
</head>

@section('header')
@include('investasi.layouts.header')
@show

@guest
@else
@section('sidebar')
@include('investasi.layouts.sidebar')
@show
@endguest

@yield('content')
@include('sweetalert::alert')

@section('footer')
@include('investasi.layouts.footer')
@show

<script src="{{asset('investasi/js/jquery.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('investasi/js/popper.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('investasi/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('investasi/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('investasi/js/aos.js')}}"></script>
<script src="{{asset('investasi/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('investasi/js/scrollax.min.js')}}"></script>
<script src="{{asset('investasi/js/images.js')}}"></script>
<script src="{{asset('investasi/js/google-map.js')}}"></script>
<script src="{{asset('investasi/js/main.js')}}"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
@livewireScripts
@yield('scripts')


</body>
</html>