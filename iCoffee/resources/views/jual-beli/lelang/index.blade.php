@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Beranda')
@section('sidebar')
@endsection
@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url('images/photo-1550470789-fc6193fd518c.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Lelang</span></p>
            <h1 class="mb-0 bread">Lelang</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
    					<li><a href="#" class="active">Semua</a></li>
    					<li><a href="#">Kopi Robusta</a></li>
    					<li><a href="#">Kopi Arabika</a></li>
    					<li><a href="#">Kopi Luak</a></li>
						<li><a href="#">Kopi Jawa</a></li>
						<li><a href="#">Lainnya</a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">
    			
    			<div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="product-lelang.html" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="product-lelang.html">Kopi Jawa</a></h3>
                             <p class="price" id="demo1"></p>     
                        </div>
                    </div>
                </div>
    	
            
        </div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>



  <script>
    // Set the date we're counting down to
    var sis = 27;
    
    var countDownDate = new Date("2020-01-21 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo1").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo1").innerHTML = "EXPIRED";
      }
    }, 1000);
    </script>
    
  </body>
</html>

@endsection