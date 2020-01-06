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
  </head>
  <body class="goto-here">
		<div class="py-1 bg-primary">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
	    		<div class="col-lg-12 d-block">
		    		<div class="row d-flex">
		    			<div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <span class="text">+6281 1786 1595</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
						    <span class="text">contact@icoffee.com</span>
					    </div>
					    <div class="col-md pr-4 d-flex topper align-items-center">
					    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="oi oi-globe"></span></div>
						    <span class="text">Jl. Pagar Alam No.44, Kedaton</span>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="" href="/"></a><img src="{{asset('Jualbeli/logo.png') }}" width="7%" height="10%">
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.html" class="nav-link">Beranda</a></li>
	           <li class="nav-item">
				 <a href="shop.html" class="nav-link">JualBelis</a>
              <!-- <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="shop.html">Shop</a>
              	<a class="dropdown-item" href="wishlist.html">Wishlist</a>
                <a class="dropdown-item" href="product-single.html">Single Product</a>
                <a class="dropdown-item" href="cart.html">Cart</a>
                <a class="dropdown-item" href="checkout.html">Checkout</a>
              </div> -->
            </li>
	          <li class="nav-item"><a href="blog.html" class="nav-link">Lelang</a></li>
	          <li class="nav-item"><a href="investasi.html" class="nav-link">Investasi</a></li>
	          <!-- <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-plus"></span>Pasang Iklan</a></li> -->
			  <li class="nav-item"><a href="masuk.html" class="nav-link">Masuk</a></li>
	        </ul>
	      </div>
	    </div>
      </nav>


     
      @yield('content')



      <footer class="ftco-footer ftco-section">
        <div class="container">
          <div class="row">
            <div class="mouse">
              <a href="#" class="mouse-icon">
                <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
              </a>
            </div>
          </div>
          <div class="row mb-5">
            <div class="col-md">
              <div class="ftco-footer-widget mb-4">
          <h2 class="ftco-heading-2"><img src="Jualbeli/logo.png" width="35%" height="8%"></h2>
          <h2 >Hubungi</h2>
          <div class="block-23 mb-3">
          <ul>
            <li><span class="icon icon-map-marker"></span><span class="text">Jl. Pagar Alam (Gang PU) No.44 Kedaton Bandar Lampung 35145</span></li>
            <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 811 7861 595</span></a></li>
            <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
            </ul>
  
          </div>
  
                <!-- <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                  <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                  <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                </ul> -->
              </div>
            </div>
            <div class="col-md">
              <div class="ftco-footer-widget mb-4 ml-md-5">
                <h2 class="ftco-heading-2">Tentang iCoffee</h2>
                <ul class="list-unstyled">
                  <li><a href="#" class="py-2 d-block">Tentang Kami</a></li>
                  <li><a href="#" class="py-2 d-block">FAQ</a></li>
                  <li><a href="#" class="py-2 d-block">Panduan Pengguna</a></li>
          <li><a href="#" class="py-2 d-block">Blog</a></li>
          <li><a href="#" class="py-2 d-block">Karir</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
               <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">Pembeli</h2>
                <div class="d-flex">
                  <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                    <li><a href="#" class="py-2 d-block">Cara Beli di iCoffee</a></li>
            <li><a href="#" class="py-2 d-block">Cara Pengembalian Barang (Pembeli)</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md">
              <div class="ftco-footer-widget mb-4">
                <h2 class="ftco-heading-2">Penjual</h2>
          <div class="d-flex">
            <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
              <li><a href="#" class="py-2 d-block">Cara Jualan di iCoffee</a></li>
              <li><a href="#" class="py-2 d-block">Cara Pengembalian Barang 
              (Penjual)</a></li>
            </ul>
            </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
  
              <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </footer>
      
    
  
    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>




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
  </body>
</html>