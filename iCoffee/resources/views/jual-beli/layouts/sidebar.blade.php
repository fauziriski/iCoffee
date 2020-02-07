
<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
       <div class="card">
         <article class="card-group-item">
          <header class="card-header"><h6 class="title">Profile</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
            <li href="#" class="list-group-item"><img src="/images/tonii.png" width="25%" style="border-radius: 50%">&nbsp;&nbsp; {{ Auth::user()->name }}</li>
              <a href="{{url('/profil/edit')}}" class="list-group-item"><span class="icon icon-edit"></span>&nbsp;&nbsp; Edit Profile</a>
            </div> 
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header"><h6 class="title">Jual Beli</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('/pasang-jualbeli')}}" class="list-group-item"><span class="icon icon-tags"></span>&nbsp;&nbsp; Pasang Produk</a>
              <a href="{{url('/jual-beli/transaksi')}}" class="list-group-item"><span class="oi oi-loop"></span>&nbsp;&nbsp; Transaksi</a>
              <a href="{{url('tranksaksi-jual')}}" class="list-group-item"><span><i class="fas fa-th-large" aria-hidden="true"></i></span>&nbsp;&nbsp; Produk Anda</a>
              <a href="{{url('/jual-beli/konfirmasi')}}" class="list-group-item"><span><i class="fas fa-handshake" aria-hidden="true"></i></span>&nbsp; Konfirmasi Pembayaran </a>
            </div> 
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header mt-3"><h6 class="title">Lelang</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('/pasang-lelang')}}" class="list-group-item"><span class="icon icon-timer"></span>&nbsp;&nbsp; Pasang Lelang</a>
              <a href="{{url('/lelang/transaksi')}}" class="list-group-item"><span class="oi oi-list"></span>&nbsp;&nbsp; Riwayat Lelang</a>
              <a href="{{url('/jual-beli/konfirmasi/lelang')}}" class="list-group-item"><span><i class="fas fa-handshake" aria-hidden="true"></i></span>&nbsp; Konfirmasi Pembayaran </a>
            </div>
          </div>
        </article> 
      </div>
    </div>