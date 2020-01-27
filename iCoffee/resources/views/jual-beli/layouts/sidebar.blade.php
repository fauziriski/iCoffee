
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
              <a href="{{url('edit-profile')}}" class="list-group-item"><span class="icon icon-edit"></span>&nbsp;&nbsp; Edit Profile</a>
            </div> 
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header"><h6 class="title">Jual Beli</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('pasang-produk')}}" class="list-group-item"><span class="icon icon-tags"></span>&nbsp;&nbsp; Pasang Produk</a>
              <a href="{{url('tranksaksi-jual')}}" class="list-group-item"><span class="oi oi-loop"></span>&nbsp;&nbsp; Tranksaksi Jual</a>
            </div> 
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header mt-3"><h6 class="title">Lelang</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('produk-lelang')}}" class="list-group-item"><span class="icon icon-timer"></span>&nbsp;&nbsp; Produk Lelang</a>
              <a href="{{url('riwayat-lelang')}}" class="list-group-item"><span class="oi oi-list"></span>&nbsp;&nbsp; Riwayat Lelang</a>
            </div>
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header mt-3"><h6 class="title">Investasi</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('jadi-mitra')}}" class="list-group-item"><span class="oi oi-people"></span>&nbsp;&nbsp; Jadi Mitra</a>
              <a href="{{url('jadi-investor')}}" class="list-group-item"><span class="oi oi-bar-chart"></span>&nbsp;&nbsp; Jadi Investor</a>
            </div>
          </div>
        </article> 
      </div>
    </div>