
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
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <img src="logo.png" width="10%" height="5%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="{{url('jual-beli')}}" class="nav-link">JualBeli</a></li>
            <li class="nav-item"><a href="{{url('lelang')}}" class="nav-link">Lelang</a></li>
            <li class="nav-item"><a href="{{url('investasi')}}" class="nav-link">Investasi</a></li>
            <div class="dropdown ml-2 mt-1">
              <button type="button" class="btn btn-primary btn-outline-primary my-2 px-3 py-1 my-sm-0" data-toggle="dropdown">
               <i class="fa fa-plus"></i>&nbsp;Pasang Produk
             </button>
             <div class="dropdown-menu">
              <a class="dropdown-item" href="{{url('pasang-jualbeli')}}">Penjualan</a>
              <a class="dropdown-item" href="{{url('pasang-lelang')}}">Lelang</a>
              <a class="dropdown-item" href="{{url('pasang-investasi')}}">Investasi</a>
            </div>
          </div>
          @if(Auth::check())
          <li class="nav-item ml-2"><a href="{{url('keluar')}}" class="nav-link">| Keluar</a></li>
        </li>
        @else
        <li class="nav-item ml-2"><a href="{{url('masuk')}}" class="nav-link">| Masuk</a></li>
        @endif
      </ul>
    </div> 
  </div>
</nav>
</div>