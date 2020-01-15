@extends('jual-beli.layouts.app')
@section('title', 'Detail Produk')
@section('sidebar')
@endsection
@section('content')


    <section class="ftco-section">
    	{{-- <div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="{{ asset('Jualbeli/images/product-1.jpg') }}" class="image-popup"><img src="{{ asset('Jualbeli/images/product-1.jpg') }}" class="img-fluid" alt="Colorlib Template"></a>

        <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="{{ asset('Jualbeli/images/product-2.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-2.jpg') }}" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="{{ asset('Jualbeli/images/product-3.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-3.jpg') }}" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="{{ asset('Jualbeli/images/product-4.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-4.jpg') }}" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="{{ asset('Jualbeli/images/product-5.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-5.jpg') }}" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
            </div>
          </div>
        </div>
      </div>
          </div> --}}
          <div class="container">
            <div class="row">
              <div class="col-lg-6 mb-5 pl-4 md-5 pr-2 ftco-animatee">
          <div class="home-slider owl-carousel">
            
    
            <div class="slider-item">
              <img class="img-fluid" src="{{ asset('Uploads/Produk/{'.$products->kode_produk.'}/'.$products->gambar) }}" alt="Colorlib Template">
            </div>

            @foreach($image as $data)
            <div class="slider-item">
              <img class="img-fluid" src="{{ asset('Uploads/Produk/{'.$products->kode_produk.'}/'.$data->nama_gambar) }}" alt="Colorlib Template">
            </div>
            @endforeach
          </div>
              </div>
          






    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3>{{ $products->nama_produk }}</h3>
    				<!-- <div class="rating d-flex">
							<p class="text-left mr-4">
								<a href="#" class="mr-2">5.0</a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
								<a href="#"><span class="ion-ios-star-outline"></span></a>
							</p>
							<p class="text-left mr-4">
								<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
							</p>
							<p class="text-left">
								<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
							</p>
						</div> -->

					  <p class="price"><span>Rp {{ $products->harga }} / Kg</span></p>

            <div class="row">
              <p class="text-left">
                <div class="col-2">
                <a href="#" class="mr-2" style="color: #000;">Stok
                </div>
                  <div class="col">
                  <span class="mr-4" style="color: #bbb;">{{ $products->stok }} Kg</span>
                </div>
                </a>
              </p>
            </div>

            <div class="row">
              <p class="text-left">
                <div class="col-2">
                  <a href="#" class="mr-4" style="color: #000;">Kategori
                </div>
                <div class="col">
                  <span class="mr-4" style="color: #bbb;">{{$products->category->kategori}}</span>
                </div>
                </a>
              </p>
            </div>
            
              <!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
              </p> -->

              <form action="/jual-beli/keranjang/tambah-produk" method="post"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_produk" value="{{$products->id}}">
                <input type="hidden" name="nama_produk" value="{{$products->nama_produk}}">
                <input type="hidden" name="harga" value="{{$products->harga}}">
                <input type="hidden" name="gambar" value="{{$products->gambar}}">
                <input type="hidden" name="kode_produk" value="{{$products->kode_produk}}">


              <div class="row mt-2">
                <div class="col-md-6">
                  <div class="form-group d-flex">
                    <!-- <div class="select-wrap"> -->
                      <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->
                      <!-- <select name="" id="" class="form-control">
                        <option value="">Small</option>
                        <option value="">Medium</option>
                        <option value="">Large</option>
                        <option value="">Extra Large</option>
                      </select> -->
                    <!-- </div> -->
                  </div>
                </div>
                <div class="w-100"></div>
                <div class="input-group col-md-6 d-flex mb-3">
                  <span class="input-group-btn mr-2">
                      <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                      <i class="ion-ios-remove"></i>
                      </button>
                  </span>
              
                  <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                  <span class="input-group-btn ml-2">
                      <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                        <i class="ion-ios-add"></i>
                    </button>
                  </span>
                </div>

                <div class="w-100"></div>
                <div class="col-md-12">
                  <p style="color: #000;">Terjual 30 Produk</p>
              
                </div>


            
              </div>
              {{-- <button type="submit" class="btn btn-primary mt-3 py-3">Masuk</button> --}}
              <p><input type="submit" class="btn btn-primary py-3 px-5" value="Beli"></p>
              {{-- <p><a type="submit" class="btn btn-primary mt-3 py-3"></a>Beli</p> --}}
          </div>
          </form>

			</div>
      
      <div class="row">
			<div class="col mb-5 ftco-animate">
				<p>{{ $products->detail_produk }}</p>
      </div>
    </div>
			

    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
				<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">Produk Terkait</h2>
          </div>
        </div>   		
    	</div>
    	<div class="container">
    		<div class="row">
    			
    				<div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="/jual-beli/produk" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                <span class="status">30%</span>
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="/jual-beli/produk">Kopi Arabika</a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price"><span class="price-sale">Rp 30.000/Kg</span></p>
                  </div>
                </div>
                <div class="bottom-area d-flex px-3">
                  <div class="m-auto d-flex">
                    <a href="/jual-beli/produk" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                      <span><i class="ion-ios-menu"></i></span>
                    </a>
                    <a href="/jual-beli/keranjang" class="buy-now d-flex justify-content-center align-items-center mx-1">
                      <span><i class="ion-ios-cart"></i></span>
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="/jual-beli/produk" class="img-prod"><img class="img-fluid" src="images/product-2.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="/jual-beli/produk">Kopi Robusta</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="price-sale">Rp 15.000/Kg</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="/jual-beli/produk" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="/jual-beli/keranjang" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="/jual-beli/produk" class="img-prod"><img class="img-fluid" src="images/product-3.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="/jual-beli/produk">Kopi Luwak</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="price-sale">Rp 25.000/Kg</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="/jual-beli/produk" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="/jual-beli/keranjang" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="/jual-beli/produk" class="img-prod"><img class="img-fluid" src="images/product-4.jpg" alt="Colorlib Template">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="/jual-beli/produk">Kopi Liberika</a></h3>
                            <div class="d-flex">
                                <div class="pricing">
                                    <p class="price"><span class="price-sale">Rp 50.000/Kg</span></p>
                                </div>
                            </div>
                            <div class="bottom-area d-flex px-3">
                                <div class="m-auto d-flex">
                                    <a href="/jual-beli/produk" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                        <span><i class="ion-ios-menu"></i></span>
                                    </a>
                                    <a href="/jual-beli/keranjang" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                        <span><i class="ion-ios-cart"></i></span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    		</div>
    	</div>
    </section>


    

  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
  </script>
  

@endsection

