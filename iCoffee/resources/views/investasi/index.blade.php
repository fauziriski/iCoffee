@extends('investasi.layouts.app')
@section('title', 'Investasi | Beranda')
@section('sidebar')
@endsection
@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url('images/petani.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Investasi</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
            <h5>Mulai Pembiayaan disini...</h5>
            <hr>
            <br>
            <div class="row">

              @foreach($products as $data)
        <div class="col-md-6 col-lg-3 ftco-animate">
          <div class="product">
            <a href="/invest/produk/{{ $data->id }}" class="img-prod"><img class="img-fluid" src="{{ url('/Uploads/Investasi/Produk/{'.$data->id_mitra.'}/{'.$data->kode_produk.'}/'.$data->gambar) }}" alt="Colorlib Template">
              <div class="overlay"></div>
            </a>
            <div class="text py-3 pb-4 px-3 text-center">
              <h3><a href="/invest/produk/{{ $data->id }}">{{ Str::limit($data->nama_produk,30) }}</a></h3>
              <div class="d-flex">
                <div class="pricing">
                  <p class="price"><span class="price-sale">Rp. {{ $data->harga }} / Unit</span></p>
                </div>
              </div>
              <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                  <a href="/invest/produk/{{ $data->id }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                    <span><i class="ion-ios-menu"></i></span>
                  </a>
                  <a href="cart.html" class="buy-now d-flex justify-content-center align-items-center mx-1">
                    <span><i class="ion-ios-cart"></i></span>
                  </a>
                  
                </div>
              </div>
            </div>
          </div>
              </div>
              @endforeach

        

      </div>
        <div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                {{ $products->render() }}
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </body>
</html>

@endsection