
<body class="goto-here">
  <div class="py-1 bg-success">
    <div class="container">
      <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
        <div class="col-lg-12 d-block">
          <div class="row d-flex">
            <div class="col-md pr-4 d-flex topper align-items-center">
              <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
              <span class="text">+62 895 1650 1662</span>
            </div>
            <div class="col-md pr-4 d-flex topper align-items-center">
              <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
              <span class="text">icoffeeofficial@gmail.com</span>
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
      <img src="\logo.png" width="10%" height="5%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="{{url('jual-beli')}}" class="nav-link">JualBeli</a></li>
            <li class="nav-item"><a href="{{url('lelang')}}" class="nav-link">Lelang</a></li>
            <li class="nav-item"><a href="{{url('invest')}}" class="nav-link">Investasi</a></li>
            <div class="dropdown ml-2 mt-1">
              <a type="button" class="btn btn-primary btn-outline-primary my-2 px-3 py-1 my-sm-0" href="{{url('jadi-mitra')}}">
               <i class="fa fa-users"></i>&nbsp; Jadi Mitra Investasi
              </a>
          </div>

          @guest
          <li class="nav-item ml-2"><a href="{{ __('\login') }}" class="nav-link"> Masuk</a></li>
          
          @else
          <li class="nav-item ml-2 dropdown">  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            &nbsp;&nbsp;&nbsp;Hai, {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right px-1" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/invest/profil"><i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Profil') }}
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Keluar') }}
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
    
    @endguest
  </ul>
</div> 
</div>
</nav>
</div>