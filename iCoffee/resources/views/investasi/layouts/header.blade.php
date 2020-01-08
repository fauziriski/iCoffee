
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
      <a class="navbar-brand" href="index.html"><img src="logo.png" width="15%" height="10%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>


      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Beranda</a></li>
          <li class="nav-item">
            <a href="{{url('jual-beli')}}" class="nav-link">JualBeli</a>

                <!-- <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                  <a class="dropdown-item" href="shop.html">Shop</a>
                  <a class="dropdown-item" href="wishlist.html">Wishlist</a>
                  <a class="dropdown-item" href="product-single.html">Single Product</a>
                  <a class="dropdown-item" href="cart.html">Cart</a>
                  <a class="dropdown-item" href="checkout.html">Checkout</a>
              </div> -->
          </li>
          <li class="nav-item"><a href="{{url('lelang')}}" class="nav-link">Lelang</a></li>
          <li class="nav-item"><a href="{{url('investasi')}}" class="nav-link">Investasi</a></li>
          <!-- <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span class="icon-plus"></span>Pasang Iklan</a></li> -->

          @if(Auth::check())
          <li class="nav-item"><a href="{{url('keluar')}}" class="nav-link">Keluar</a></li>
          </li>
          @else
           <li class="nav-item"><a href="{{url('masuk')}}" class="nav-link">Masuk</a></li>
          @endif

      </ul>
  </div>
</div>
</nav>
