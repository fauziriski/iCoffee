@extends('blog.app')
@section('title', 'iCoffee | Tentang Kami')
@section('content')
@push('nav')
<ul class="nav-menu nav navbar-nav">
    @foreach ($categori as $item)
    <li class="cat-4"><a href="{{ route('artikel.kategori',$item->slug) }}">{{$item->nama_kategori}}</a></li>
    @endforeach
</ul>
@endpush
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <ul class="page-header-breadcrumb">
                    <li><a href="/artikel">Home</a></li>
                    <li>Tentang Kami</li>
                </ul>
                <h1>Tentang Kami</h1>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-8">
                <div class="section-row">
                    <p>iCoffee merupakan platform yang menggabungkan konsep investasi dengan penyediaan saluran distribusi disektor perkebunan kopi .</p>
                    <figure class="figure-img">
                        <img class="img-responsive" src="./img/about-1.jpg" alt="">
                    </figure>
                    <p>iCoffee sebagai perantara pemilik modal yang tidak tahu cara bertanam kopi dengan petani kopi. 
                    Tidak hanya itu iCoffee sebagai penyaluran produk semua jenis kopi dengan layanan marketplace, dan layanan lelang yang sangat membantu petani</p>
                </div>
                <div class="row section-row">
                    <div class="col-md-6">
                        <figure class="figure-img">
                            <img class="img-responsive" src="./img/about-2.jpg" alt="">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <h3>3 Layanan</h3>
                        <p>iCoffee memiliki layanan utama diantaranya.</p>
                        <ul class="list-style">
                            <li>
                                <p>Layanan Jual-Beli/Marketplace</p>
                            </li>
                            <li>
                                <p>Layanan Lelang</p>
                            </li>
                            <li>
                                <p>Layanan Investasi.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
@push('categoris')
<ul class="footer-links">
    @foreach ($categori as $item)
    <li><a href="{{ route('artikel.kategori',$item->slug) }}">{{$item->nama_kategori}}</a></li>
    @endforeach
</ul>
@endpush
@endsection
