@extends('investasi.mitra.layout.master')
@section('title', 'Pengajuan Dana | Investasi')
@section('content')
<div class="row justify-content-center">
    @foreach($produk as $item)
        <div class="card mb-3 mt-3" style="max-width: 720px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{{ asset('Uploads/Investasi/Produk/{'.$item->kode_produk.'}/'.$item->gambar) }}" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->nama_produk}}</h5>
                        <p class="card-text">{{ Str::limit($item->detail_produk,100) }}</p>
                        <p class="card-text"><small class="text-muted">{{$item->created_at}}</small></p>
                        <a href="pengajuan-dana/{{$item->kode_produk}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection