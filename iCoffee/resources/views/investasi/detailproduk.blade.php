@extends('investasi.layouts.app')
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
              <img class="img-fluid" src="{{ asset('Uploads/Investasi/Produk/{'.$products->kode_produk.'}/'.$products->gambar) }}" alt="Colorlib Template">
            </div>

            @foreach($image as $data)
            <div class="slider-item">
              <img class="img-fluid" src="{{ asset('Uploads/Investasi/Produk/{'.$products->kode_produk.'}/'.$data->nama) }}" alt="Colorlib Template">
            </div>
            @endforeach
          </div>
              </div>
          






    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
            <h3>{{ $products->nama_produk }}</h3>
            <hr>
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

					  <p class="price"><h5>@money($products->harga) / Unit</h5></p>

            <div class="row">
              <p class="text-left">
                <div class="col">
                  <i class="fa fa-calendar"></i> Periode Kontrak
                </div>
                <div class="col">
                  <p>{{$products->periode}} Tahun</p>
                </div>
              </p>
            </div>

            <div class="row">
              <p class="text-left">
                <div class="col">
                  <i class="fa fa-money"></i> Return yang didapat
                </div>
                <div class="col">
                  <p>{{$products->roi}}% Per Tahun</p>
                </div>
              </p>
            </div>

            <div class="row">
              <p class="text-left">
                <div class="col">
                  <i class="fa fa-coffee"></i> Periode Bagi Hasil
                </div>
                <div class="col">
                  <p>{{$products->profit_periode}} Tahun</p>
                </div>
              </p>
            </div>

            <div class="row">
              <p class="text-left">
                <div class="col">
                  <i class="fa fa-leaf"></i> Telah tertanam 331 Unit disponsori 170 orang
                </div>
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
            <p style="color: #000;">{{$products->stok}} Tersisa</p>
            
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



            
              </div>
              {{-- <button type="submit" class="btn btn-primary mt-3 py-3">Masuk</button> --}}
              <p><a href="\invest/checkout" class="btn btn-primary py-3 px-5"><i class="fa fa-credit-card"> </i>&nbsp;&nbsp;&nbsp; Salurkan Pembayaran</a></p>
              {{-- <p><a type="submit" class="btn btn-primary mt-3 py-3"></a>Beli</p> --}}
          </div>
          </form>

			</div>
      @php
          $loop = $products->periode/$products->profit_periode;
          $profit = $products->harga*($products->roi/100);
          $total = $profit*$loop+$products->harga;
          $collection = collect([0]);
          $collect = collect([0]);
          for($i=1;$i<=$loop+1;$i++){
            $collection->push($i);
          }
          for($i=1;$i<=$loop;$i++){
            $collect->push($profit);
          }
          $collect->push(0);
      @endphp
			<div class="col mb-5 ftco-animate">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Simulasi Bagi Hasil</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" align="justify">
            <br>
            {{ $products->detail_produk }}
          </div>
            
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <br>
              <div style="width: 100%;height: 100%">
                <canvas id="myChart"></canvas>
              </div>
              <div class="row">
                <div class="col">
                  Tahun Ke
                </div>
                <div class="col">
                  Bagi Hasil Bersih
                </div>
                <div class="col">
                  ROI
                </div>
              </div>
              @for($i=1;$i<=$loop;$i++)
              <div class="row">
                <div class="col">
                  {{$i}}
                </div>
                <div class="col">
                  @money($profit)
                </div>
                <div class="col">
                  {{$products->roi}}%
                </div>
              </div>
              @endfor
              <div class="row">
                <div class="col">
                  Pengembalian Modal
                </div>
                <div class="col">
                  @money($products->harga)
                </div>
                <div class="col">
                </div>
              </div>
              <div class="row">
                <div class="col">
                  Total
                </div>
                <div class="col">
                  @money($total)
                </div>
                <div class="col">
                  -
                </div>
              </div>
            </div>
          </div>
          <br>
          <hr>
          <h4>Mitra Proyek</h4>
          @foreach ($mitra as $item)
          <div class="container">
            <div class="row">
              <div class="col-md-4-sm-4">
                <img src="\images/Logo.jpg" height="130px" width="170px">
            </div>
            <div class="col-1">
            </div>
              <div class="col-md-7-sm-7-ml-2">
                <h5>{{$item->nama}}</h5>
                <hr>
                <p>Operator iCoffee</p>
                <i class="fa fa-leaf fa-lg"></i> 331 Dikelola <i class="fa fa-user fa-lg"></i> {{$item->jumlah_petani}} Petani <i class="fa fa-map fa-lg"></i> {{$item->alamat}}
              </div>
            </div>
           </div>
          @endforeach
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

    		</div>
    	</div>
    </section>

@endsection
    
@section('scripts')
  <script type="text/javascript" src="{{asset('investasi/js/Chart.js')}}"></script>
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
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: {!! json_encode($collection)!!},
        xAxisID: 'Bulan',
        datasets: [{
          label: 'Simulasi Bagi Hasil',
          data: {!! json_encode($collect)!!},
          backgroundColor: [
          'rgba(201, 170, 91, 1)'
          ],
          borderColor: [
          'rgba(201, 170, 91, 1)'
          ],
          borderWidth: 1
        }]
      }
    });
  </script>
@endsection

