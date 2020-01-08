<!DOCTYPE html>
<html lang="en">
<head>
  <title>iCoffee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('Jualbeli/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/animate.css') }}">
  
  <link rel="stylesheet" href="{{asset('Jualbeli/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{asset('Jualbeli/css/aos.css') }}">

  <link rel="stylesheet" href="{{asset('Jualbeli/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{asset('Jualbeli/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/jquery.timepicker.css') }}">

  
  <link rel="stylesheet" href="{{asset('Jualbeli/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{asset('Jualbeli/css/style.css') }}">
  <link rel="stylesheet" href="{{asset('css/images.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>

@section('header')
@include('jual-beli.layouts.header')
@show

@section('sidebar')
@include('jual-beli.layouts.sidebar')
@show
@yield('content')

@section('footer')
@include('jual-beli.layouts.footer')
@show

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{asset('Jualbeli/js/jquery.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/popper.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/bootstrap.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery.easing.1.3.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery.waypoints.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery.stellar.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/owl.carousel.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/aos.js') }}"></script>
<script src="{{asset('Jualbeli/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{asset('Jualbeli/js/bootstrap-datepicker.js') }}"></script>
<script src="{{asset('Jualbeli/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('Jualbeli/js/google-map.js') }}"></script>
<script src="{{asset('Jualbeli/js/main.js') }}"></script>
<script src="{{asset('js/images.js') }}"></script>
</body>
</html>