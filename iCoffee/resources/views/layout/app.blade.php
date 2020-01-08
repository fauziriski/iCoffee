<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

</head>
@section('header')
@include('layout.header')
@show
@yield('content')
@section('footer')
@include('layout.footer')
@show



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{asset('js/jquery.min.js') }}"></script>
<script src="{{asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{asset('js/popper.min.js') }}"></script>
<script src="{{asset('js/bootstrap.min.js') }}"></script>
<script src="{{asset('js/jquery.easing.1.3.js') }}"></script>
<script src="{{asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{asset('js/jquery.stellar.min.js') }}"></script>
<script src="{{asset('js/owl.carousel.min.js') }}"></script>
<script src="{{asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{asset('js/aos.js') }}"></script>
<script src="{{asset('js/jquery.animateNumber.min.js') }}"></script>
<script src="{{asset('js/bootstrap-datepicker.js') }}"></script>
<script src="{{asset('js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{asset('js/google-map.js') }}"></script>
<script src="{{asset('js/main.js') }}"></script>

</body>
</html>
