<div>
    <article class="card-group-item">
        <header class="card-header"><h6 class="title">Progress Investasi</h6></header>
        @foreach ($orders as $item)
        <div class="col-md-12 ftco-animate cart-detail">
        <br>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img  src="{{ url('/Uploads/Investasi/Produk/'.$produk[$loop->index]->kode_produk.'/'.$produk[$loop->index]->gambar)}}" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$produk[$loop->index]->nama_produk}}
                            </h5>
                            <p style="text-align:left;">
                                Harga: @money($produk[$loop->index]->harga)
                                <span style="float:right;">
                                Kuantitas: {{$item->qty}}
                                </span>
                            </p>
                            <p style="text-align:left;">
                                Total: @money($item->total)
                                <span style="float:right;">
                                Status:
                                if($item->status == 1)
                                                <span class="badge badge-warning float-right">Belum Divalidasi</span>
                                            @elseif($item->status == 0)
                                                <span class="badge badge-danger float-right">Ditolak</span>
                                            @elseif($item->status == 2)
                                                <span class="badge badge-success float-right">Divalidasi</span>
                                                @elseif($item->status == 3)
                                                <span class="badge badge-info float-right">On Progress</span>
                                            @endif
                                </span>
                            </p>
                            <a class="btn btn-secondary mt-5 float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Riwayat Progress
                            </a>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseExample">
                    <div class="accordion mt-5 mb-5" id="accordionExample">
                        @forelse($progress as $item)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                            #{{$loop->iteration}} - {{$item->judul}} - {{Carbon::parse( $item->created_at )->translatedFormat('l, d F Y')}}
                                            if($item->status == 1)
                                                <span class="badge badge-warning float-right">Belum Divalidasi</span>
                                            @elseif($item->status == 0)
                                                <span class="badge badge-danger float-right">Ditolak</span>
                                            @elseif($item->status == 2)
                                                <span class="badge badge-success float-right">Divalidasi</span>
                                                @elseif($item->status == 3)
                                                <span class="badge badge-info float-right">On Progress</span>
                                            @endif
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Deskripsi: {{$item->deskripsi}}</p>
                                        <div class="row">
                                            @foreach($item->files as $i)
                                                @if($i->type == 'video')
                                                    <div class="col">
                                                        <p>Video:</p>
                                                        <video width="400" controls>
                                                            <source src="{{ asset('/Uploads/Investasi/Produk/'.$item->kode_produk.'/'.$i->nama) }}">
                                                            Your browser does not support HTML video.
                                                        </video>
                                                    </div>
                                                @endif
                                                @if($i->type == 'photo')
                                                    <div class="col">
                                                        <p>Foto:</p>
                                                        <img height="300px" width="400px" src="{{ asset('/Uploads/Investasi/Produk/'.$item->kode_produk.'/'.$i->nama) }}">
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h6>Data Tidak Tersedia</h6>
                        @endforelse
                    </div>
                </div>
            </div>
        <br>
        </div>
        @endforeach
  </div>
  