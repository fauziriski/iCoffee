<div>
  <article class="card-group-item">
    <header class="card-header"><h6 class="title">Riwayat Pembiayaan</h6></header>
    @foreach ($orders as $item)
      <div class="col-md-12 ftco-animate cart-detail">
        <br>
        <div class="card mb-1">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img  src="{{ url('/Uploads/Investasi/Produk/'.$produk[$loop->index][0]->kode_produk.'/'.$produk[$loop->index][0]->gambar)}}" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">
                  {{$produk[$loop->index][0]->nama_produk}}
                </h5>
                <p style="text-align:left;">
                  Harga: @money($produk[$loop->index][0]->harga)
                  <span style="float:right;">
                    Kuantitas: {{$item->qty}}
                  </span>
                </p>
                <p style="text-align:left;">
                  Total: @money($item->total)
                  <span style="float:right;">
                    Status:
                    @if($item->status == 1)
                        <span class="badge badge-warning text-right">Diproses</span>
                    @elseif($item->status == 2)
                        <span class="badge badge-success text-right">Sukses</span>
                    @elseif($item->status == 0)
                        <span class="badge badge-danger text-right">Ditolak</span>
                    @endif
                  </span>
                </p>
              </div>
            </div>
          </div>
        </div>
      <br>
    </div>
    @endforeach
</div>
