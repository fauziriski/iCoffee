@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
    <div class="card">
   
      <article class="card-group-item">
       <header class="card-header">
         <ul class="nav nav-pills" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Beli</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Jual</a>
         </li>
       </ul>
       </header>
       <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

            <div class="col-md-12  mt-3 mb-3 ftco-animate">

                <div class="row mt-3">
                    <div class="col-md-10">
                        Tanggal
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name="edit_alamat" value="" data-whatever="@mdo">Detail</button>
                        
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mt-2">
                        <strong><p>Nama Toko</p></strong>
                                <p> invoice</p>
                    </div>

                    <div class="col-md-4 mt-2">
                        <p>Status</p>
                        <strong><p>pesanan</p></strong>
                    </div>

                    <div class="col-md-4 mt-2">
                        <p>Total Belanja</p>
                        <strong><p>Rp</p></strong>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4 mt-2">
                        <strong><p>Nama Produk</p></strong>
                        <p>Jumlah Produk</p>
                    </div>

                    <div class="col-md-4 mt-2">
                        <p>Harga Produk</p>
                        <strong><p>Rp. </p></strong>
                    </div>

                    <div class="col-md-4 mt-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name="edit_alamat" value="" data-whatever="@mdo">Beli Lagi</button>
                        
                    </div>
                </div>

                <div class="row mt-3">
                    
                </div>


            </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        </div>
    </div>
    </article> 
    </div>
</div><!-- tutup side -->

</div>
</section>


@endsection