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
            <div class="col" style="border-radius: 400px;">
            @foreach ($transaksipembeli as $data)

                <div class="row mt-3">
                    <div class="col">
                        <p>Tanggal : <strong>{{  $data->created_at }}</strong></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img class="img-fluid" src="{{ url('/Uploads/Lelang/{'.$data->auction_products->kode_lelang.'}/'.$data->auction_products->gambar) }}" width="70%" height="70%">
                    </div>
                    <div class="col-md-3">
                        <p>Invoice : <strong style="color:#ee4d2c">{{  $data->invoice }}</strong></p>
                    </div>
                    <div class="col-md-4 mt-2">
                        <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($data->total_bayar) }}</strong></p>
                    </div>
                    <div class="col text-center mt-2">
                        <a href="/lelang/invoice/{{ $data->invoice }}"><span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan </a>
                    </div>
                </div>
                <hr>
        
                @endforeach
            </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container" style="border-radius: 400px;">
                @foreach ($transaksipenjual as $data)
                    
                <div class="row mt-3">
                    <div class="col">
                        <p>Tanggal : <strong>{{  $data->created_at }}</strong></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img class="img-fluid" src="{{ url('/Uploads/Lelang/{'.$data->auction_products->kode_lelang.'}/'.$data->auction_products->gambar) }}" width="70%" height="70%">
                    </div>
                    <div class="col-md-3">
                        <p>Invoice : <strong style="color:#ee4d2c">{{  $data->invoice }}</strong></p>
                    </div>
                    <div class="col-md-4 mt-2">
                        <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($data->total_bayar) }}</strong></p>
                    </div>
                    <div class="col text-center mt-2">
                        <a href="/lelang/invoice_penjual/{{ $data->invoice }}"><span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan </a>
                    </div>
                </div>
                <hr>
            
                    @endforeach
                </div>
        </div>
    </div>
    </article> 
    </div>
</div><!-- tutup side -->

</div>
</section>


@endsection