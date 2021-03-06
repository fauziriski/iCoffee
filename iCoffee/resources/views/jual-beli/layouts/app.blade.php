<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link href="{{ asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('Jualbeli/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('Jualbeli/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('Jualbeli/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('Jualbeli/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('Jualbeli/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/css/images.css') }}">
    <link rel="stylesheet" href="{{ asset('Jualbeli/plugins/customPlugin/title.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('landing_page/images/favicon.png') }}">
    <meta name="google-site-verification" content="yr0b1EXiV-YTqxP_WX3A3LGbEtl805Xnq-hrlgDxj78" />

    <style>
        .btn-primary {
            border-radius: 10px;
        }

        .form-control {
            border-radius: 10px;
        }

        .input-group {
            border-radius: 10px;
        }

        .input-group .input-group-prepend {
            border-radius: 10px;
        }

        
        i.notif {
            position: relative;
            /* color: white; */
            cursor: pointer;
        }
        span.fa-circle {
            position: absolute;
            font-size: 1.3em;
            top: -12px;
            color: #28a745;
            right: -11px;
        }
        span.num {
            position: absolute;
            font-size: 12px;
            top: -7px;
            color: #fff;
            right: -5px;
            font-family: 'poppins';
        }

    </style>

</head>

@section('header')
    @include('jual-beli.layouts.header')
@show

@guest
@else
    @section('sidebar')
        @include('jual-beli.layouts.sidebar2')
    @show
@endguest

@yield('content')
@include('sweetalert::alert')

@section('footer')
    @include('jual-beli.layouts.footer')
@show

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://code.iconify.design/1/1.0.4/iconify.min.js"></script>
<script src="{{ asset('Jualbeli/js/jquery.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/popper.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/aos.js') }}"></script>
<script src="{{ asset('Jualbeli/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('Jualbeli/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('Jualbeli/js/scrollax.min.js') }}"></script>
{{-- <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
--}}
{{-- <script src="{{ asset('Jualbeli/js/google-map.js') }}"></script>
--}}
<script src="{{ asset('Jualbeli/js/main.js') }}"></script>
<script src="{{ asset('Jualbeli/js/images.js') }}"></script>
<script src="{{ asset('Jualbeli/plugins/customPlugin/alert.js') }}"></script>
{{-- <script src="{{ asset('Jualbeli/plugins/adminlte/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('Jualbeli/plugins/adminlte/demo.js') }}"></script> --}}

@yield('js')
</body>

</html>
