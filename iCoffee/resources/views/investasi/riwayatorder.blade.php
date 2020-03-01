@extends('investasi.layouts.app')
@section('title', 'Produk Investasi | Investasi')
@section('content')

<div class="col-md-9">
   <div class="card">
     <article class="card-group-item">
        <header class="card-header"><h6 class="title">Riwayat Pembiayaan</h6></header>
        <div class="col-md-12 ftco-animate cart-detail">
            <br>
            @foreach($order as $item)
            <div class="card mb-3">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="{{ asset('Uploads/Investasi/Produk/{'.$produk[$loop->index][0]->kode_produk.'}/'.$produk[$loop->index][0]->gambar) }}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{$produk[$loop->index][0]->nama_produk}}</h5>
                    <p style="text-align:left;">
                      Harga: @money($produk[$loop->index][0]->harga)
                      <span style="float:right;">
                        Kuantitas: {{$item->qty}}
                      </span>
                    </p>
                    <p style="text-align:left;">
                      Total: @money($produk[$loop->index][0]->harga*$item->qty)
                      <span style="float:right;">
                        @if($item->status == 1)
                          Status: Belum Divalidasi
                        @elseif($item->status == 2)
                          Status: Sudah Divalidasi
                        @else
                          Status: Sabar Ya
                        @endif
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <br>
            <ul class="pagination justify-content-center">
              {{$order->links()}}
            </ul>
        </div>
      </div>
    </div><!-- tutup side -->
  </div>
</section>
@endsection