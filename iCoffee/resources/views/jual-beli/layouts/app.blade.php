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
  <link rel="stylesheet" href="{{asset('Jualbeli/css/images.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>

@section('header')
@include('jual-beli.layouts.header')
@show

@guest
@else
@section('sidebar')
@include('jual-beli.layouts.sidebar')
@show
@endguest

@yield('content')
@include('sweetalert::alert')

@section('footer')
@include('jual-beli.layouts.footer')
@show

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<script src="{{asset('Jualbeli/js/images.js') }}"></script>

<script>
  $(document).ready(function(){

  var quantitiy=0;
     $('.quantity-right-plus').click(function(e){
      
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      
      // If is not undefined
        
        $('#quantity').val(quantity + 1);

        var data = $('.form-user').serialize();
          $.ajax({
            type: 'POST',
            url: "/jual-beli/update-keranjang",
            data: data,
            success: function() {
              $('.tampildata').load("tampil.php");
            }
          });
        });

     $('.quantity-left-minus').click(function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      var quantity = parseInt($('#quantity').val());
      
      // If is not undefined
      
        // Increment
        if(quantity>0){
        $('#quantity').val(quantity - 1);
        }
        var data = $('.form-user').serialize();
          $.ajax({
            type: 'POST',
            url: "/jual-beli/update-keranjang",
            data: data,
            success: function() {
              $('.tampildata').load("tampil.php");
            }
          });
        });
    
  });
</script>
</body>
</html>