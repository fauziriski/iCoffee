@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Detail Produk')
@section('sidebar')
@endsection
@section('content')


    <section class="ftco-section">
     <div class="container">
    		<div class="row">
    			{{-- <div class="col-lg-6 mb-5 ftco-animate">
    				<a href="{{ asset('Jualbeli/images/product-1.jpg') }}" class="image-popup"><img src="{{ asset('Jualbeli/images/product-1.jpg') }}" class="img-fluid" alt="Colorlib Template"></a>

            <div class="container">
              <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-3 col-3 ftco-animate">
                  <div class="product">
                    <a href="{{ asset('Jualbeli/images/product-2.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-2.jpg') }}" alt="Colorlib Template">
                      <div class="overlay"></div>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3 col-3 ftco-animate">
                  <div class="product">
                    <a href="{{ asset('Jualbeli/images/product-3.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-3.jpg') }}" alt="Colorlib Template">
                      <div class="overlay"></div>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3 col-3 ftco-animate">
                  <div class="product">
                    <a href="{{ asset('Jualbeli/images/product-4.jpg') }}" class="image-popup"><img class="img-fluid" src="{{ asset('Jualbeli/images/product-4.jpg') }}" alt="Colorlib Template">
                      <div class="overlay"></div>
                    </a>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-3 col-3 ftco-animate">
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
              <div class="col-lg-6 mb-1 ftco-animate">
                <div class="row">
                  <div class="col-md-12 text-center border-bottom">
                    {{-- <img class="img-fluid rounded" src="{{ asset('Uploads/Produk/{'.$products->kode_produk.'}/'.$products->gambar) }}" alt="Colorlib Template"> --}}
                    <a style="" href="{{ asset('Uploads/Produk/'.$products->kode_produk.'/'.$products->gambar) }}" class="image-popup">
                      <img class="img-fluid rounded" src="{{ asset('Uploads/Produk/'.$products->kode_produk.'/'.$products->gambar) }}" class="img-fluid" alt="Colorlib Template">
                    </a>
                  </div>
                  <div class="col-md-12 mt-2">
                      <div class="row">
                        @foreach($image as $data)
                        <div class="col-lg-3 col-md-6 col-sm-3 col-3 ftco-animate">
                          <div class="product">
                            <a href="{{ asset('Uploads/Produk/'.$products->kode_produk.'/'.$data->nama_gambar) }}" class="image-popup">
                              <img class="img-fluid rounded border" src="{{ asset('Uploads/Produk/'.$products->kode_produk.'/'.$data->nama_gambar) }}" alt="Colorlib Template">
                              <div class="overlay"></div>
                            </a>
                          </div>
                        </div>
                        @endforeach
                      </div>
                  </div>
                </div>
              </div>






    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3 class="font-weight-bold">{{ $products->nama_produk }}</h3>
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

					  <p class="price font-weight-bold"><span style="color:red">Rp {{ number_format($products->harga,0,",",".") }} / Kg</span></p>

            <div class="row">
                <div class="col-5 col-md-3">
                  <i class="fas fa-boxes"></i>&nbsp;<a style="font-size: 16px" class="ml-0" style="color: #000;">Stok
                </div>
                <div class="col-auto">
                  @if ( $products->stok == 0 )
                      <span class="mr-4" style="color: #bbb;">Kosong</span>
                  @else
                      <span style="color: #000;">{{ number_format($products->stok,0,",",".") }} Kg</span>
                  @endif
                  
                </div>
                </a>
            </div>

            <div class="row">
                <div class="col-5 col-md-3">
                  <i class="fas fa-tags"></i>&nbsp;<a style="font-size: 16px" class="ml-0" style="color: #000;">Kategori
                </div>
                <div class="col-auto">
                  <span style="color: #000;">{{$products->category->kategori}}</span>
                </div>
                </a>
            </div>
            
              <!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until.
              </p> -->

              <form action="/jual-beli/keranjang/tambah-produk" method="post"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_produk" value="{{$products->id}}">
                {{-- <input type="hidden" name="id_penjual" value="{{$products->id_pelanggan}}">
                <input type="hidden" name="nama_produk" value="{{$products->nama_produk}}">
                <input type="hidden" name="harga" value="{{$products->harga}}">
                <input type="hidden" name="gambar" value="{{$products->gambar}}">
                <input type="hidden" name="kode_produk" value="{{$products->kode_produk}}"> --}}


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
              
                  <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="30">
                  <span class="input-group-btn ml-2">
                      <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                        <i class="ion-ios-add"></i>
                    </button>
                  </span>
                </div>

                <div class="w-100"></div>
                <div class="col-md-12">
                @if ($jumlah_terjual_produk > 0)
                    <p style="color: #000;">Terjual {{$jumlah_terjual_produk}} Produk</p>
                @else()
                    <p style="color: #000;">Jadilah Orang Pertama yang Membeli Produk Ini</p>
                @endif
                  
              
                </div>
              </div>
              {{-- <button type="submit" class="btn btn-primary mt-3 py-3">Masuk</button> --}}
              <div class="row">
                <div class="col-md-4 col-12 text-center">
                @guest
                <p><input type="submit" style="border-radius: 10px; padding: 17px 40%" class="btn btn-primary" value="Beli"></p>
                @else
                @if ($products->stok < 1)
                  <input type="hidden" name="ketersedian" value="Kosong">
                  <p><input type="submit" style="border-radius: 10px" class="btn btn-secondary py-3 px-5" disabled value="Kosong"></p> 
                @elseif($products->id_pelanggan == Auth::user()->id) 
                  <input type="hidden" name="Penjual" value="Penjual">
                  <p><input type="hidden" style="border-radius: 10px" class="btn btn-secondary py-3 px-5" value="Penjual" disabled></p> 
                @else
                  <input type="hidden" name="ketersedian" value="Tersedia">
                  <p><input type="submit" style="border-radius: 10px" class="btn btn-primary py-3 px-5" value="Beli"></p>
                @endif
                @endguest
              </div>
            </div>
              
              {{-- <p><a type="submit" class="btn btn-primary mt-3 py-3"></a>Beli</p> --}}
          </div>
          </form>

			</div>
      
        <div class="row mt-2">
          <div class="col-12 col-md-12 mb-0 text-center ftco-animate border-bottom">
            <h5><strong>Deskripsi Produk</strong></h5>
          </div>
          <div class="col mb-5 mt-2 ftco-animate">
            {!! $products->detail_produk !!}
          </div>
        </div>
        <br>
        <hr>

        <div class="row ">
          <div class="container">

            <div class="card mb-3" style="max-width: 540px;">
              <div class="row no-gutters">
                <div style="display: flex;justify-content: center;align-items: center;" class="col-md-4 col-4 col-sm-4">
                  <img src="{{ asset('2557.jpg')}}" class="card-img" alt="...">
                </div>
                <div class="col-md-8 col-8 col-sm-8">
                  <div class="card-body">
                    <h5 class="card-title">{{$products->user->name}}</h5>
                    <p style="font-size: 14px" class="card-text">{{ $alamat->province->nama }}, {{ $alamat->city->nama }}</p>
                    @if (!($rating_toko == 0))

                
                    <div class="star-rating">
                      {{ $rating_toko }}
                      <span class="fa fa-star-o" data-rating="1"></span>
                      <span class="fa fa-star-o" data-rating="2"></span>
                      <span class="fa fa-star-o" data-rating="3"></span>
                      <span class="fa fa-star-o" data-rating="4"></span>
                      <span class="fa fa-star-o" data-rating="5"></span>
                      ({{ $count }})
                      <input type="hidden" name="whatever1" class="rating-value" value="{{ $rating_toko }}" required>
                      </div>
    
    
                    @else
                    <p style="font-size: 14px" >Jadilah Yang Pertama Mengulas Toko Ini</p>
    
                    @endif
                  </div>
                </div>
              </div>
            </div>

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
            @foreach ($produk_terkait as $data)
                
            
    				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 ftco-animate">
            <div class="product">
              <a href="/jual-beli/produk/{{ $data->slug }}" class="img-prod">
                <img class="img-fluid rounded" src="{{ url('/Uploads/Produk/'.$data->kode_produk.'/'.$data->gambar) }}" alt="Colorlib Template">
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="/jual-beli/produk/{{ $data->slug }}" class="font-weight-bold">{{ $data->nama_produk }}</a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price"><span class="price-sale font-weight-bold">Rp {{ number_format($data->harga,0,",",".") }} /Kg</span></p>
                  </div>
                </div>
                <div class="bottom-area d-flex px-3">
                  <div class="m-auto d-flex">
                    <a href="/jual-beli/produk/{{ $data->slug }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
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

          @endforeach
          
 
    		</div>
    	</div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>


    <style>
            
      .star-rating {
        line-height:0px;
        font-size:1.10em;
      }

      .star-rating .fa-star{
        color: orange;
      }
      
    </style>
    

  <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
        
        
          // Stop acting like a button
          e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        if (quantity < 30) {
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
          
        }
		        
		        
		        
		    });

		     $('.quantity-left-minus').click(function(e){
         
            // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>1){
		            $('#quantity').val(quantity - 1);
                }

		        
		    });
		    
		});
  </script>

<script>
	var $star_rating = $('.star-rating .fa');

	var SetRatingStar = function() {
		return $star_rating.each(function() {
			if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {  
			return $(this).removeClass('fa-star-o').addClass('fa-star');
			} else {
			return $(this).removeClass('fa-star').addClass('fa-star-o');
			}
		});
		};

		SetRatingStar();
		$(document).ready(function() {

		});
</script>
  

@endsection

