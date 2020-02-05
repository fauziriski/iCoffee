
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
          <header class="card-header"><h6 class="title">Portofolio</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('invest/pembiayaan')}}" class="list-group-item"><span class="fa fa-mug-hot"></span>&nbsp;&nbsp; Pembiayaan</a>
              <a href="#" class="list-group-item"><span class="icon icon-spinner"></span>&nbsp;&nbsp; Progress Investasi</a>
            </div> 
          </div>
        </article> 
        <article class="card-group-item">
          <header class="card-header mt-3"><h6 class="title">Investasi</h6></header>
          <div class="filter-content">
            <div class="list-group list-group-flush">
              <a href="{{url('invest/konfirmasi')}}" class="list-group-item"><span class="fas fa-money-bill-wave"></span>&nbsp;&nbsp; Konfirmasi Pembiayaan</a>
              <a href="{{url('jadi-investor')}}" class="list-group-item"><span class="oi oi-bar-chart"></span>&nbsp;&nbsp; Jadi Investor</a>
            </div>
          </div>
        </article> 
      </div>
    </div>