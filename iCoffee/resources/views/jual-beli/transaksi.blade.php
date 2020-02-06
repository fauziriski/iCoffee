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
            @for ($i = 0; $i < $hitung_invoice; $i++)

                <div class="row mt-3">
                    <div class="col">
                        <p>Tanggal : <strong>{{ $tanggal[$i] }}</strong></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <p>Invoice : <strong style="color:#ee4d2c">{{ $invoice[$i] }}</strong></p>
                    </div>
                    <div class="col">
                        <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($cek_data[$i]) }}</strong></p>
                    </div>
                    <div class="col">
                        <a href="/jual-beli/invoice/{{ $invoice[$i] }}"><span class="oi oi-eye"></span>&nbsp; Detail Pesanan </a>
                    </div>
                </div>
                <hr>
        
                @endfor
            </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container" style="border-radius: 400px;">
                @for ($i = 0; $i < $jumlah_transaksi_penjual; $i++)
                    
                    <div class="row mt-3">
                        <div class="col">
                            <p>Tanggal : <strong>{{ $transaksipenjual[$i]->updated_at }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <p>Invoice : <strong style="color:#ee4d2c">{{ $transaksipenjual[$i]->invoice }}</strong></p>
                        </div>
                        <div class="col">
                            <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($total_bayar[$i]) }}</strong></p>
                        </div>
                        <div class="col">
                            <a href="/jual-beli/invoice_penjual/{{ $transaksipenjual[$i]->invoice }}"><span class="oi oi-eye"></span>&nbsp; Detail Pesanan </a>
                        </div>
                    </div>
                    <hr>
            
                    @endfor
                </div>
        </div>
    </div>
    </article> 
    </div>
</div><!-- tutup side -->

</div>
</section>


@endsection