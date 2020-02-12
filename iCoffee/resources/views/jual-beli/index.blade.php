@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
@section('sidebar')
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('Jualbeli/images/coffee.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
            <h1 class="mb-0 bread">Products</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10 mb-5 text-center">
    				<ul class="product-category">
						<li><a href="/jual-beli" class="@if(Request::getRequestUri() == '/jual-beli')active
						@endif">Semua</a></li>

						@foreach ($category as $data)
    					<li><a href="/jual-beli/kategori/{{$data->id}}" class="{{ Request::segment(3) == $data->id ? 'active' : null }}">Kopi {{ $data->kategori }}</a></li>
						@endforeach
						<li><a href="/jual-beli">Lainnya</a></li>
    				</ul>
    			</div>
    		</div>
    		<div class="row">

                @foreach($products as $data)
    			<div class="col-md-6 col-lg-3 ftco-animate">
    				<div class="product">
    					<a href="/jual-beli/produk/{{ $data->id }}" class="img-prod"><img class="img-fluid" src="{{ url('/Uploads/Produk/{'.$data->kode_produk.'}/'.$data->gambar) }}" alt="Colorlib Template">
    						<div class="overlay"></div>
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="/jual-beli/produk/{{ $data->id }}">{{ $data->nama_produk }}</a></h3>
    						<div class="d-flex">
    							<div class="pricing">
		    						<p class="price"><span class="price-sale">Rp. {{ number_format($data->harga) }} / Kg</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-3">
	    						<div class="m-auto d-flex">
	    							<a href="/jual-beli/produk/{{ $data->id }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
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
            {{-- <div class="block-27"> --}}
              <ul>
                {{-- <li>{{ $products->render() }}</li> --}}
                {{ $products->render() }}
                {{-- <li><a href="#">{{ $products->render() }}</a></li> --}}
                {{-- <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li> --}}
              </ul>
            {{-- </div> --}}
          </div>
        </div>
    	</div>
    </section>
	
		<!-- <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
          	<span>Get e-mail updates about our latest shops and special offers</span>
          </div>
          <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
              <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section> -->
  
@endsection