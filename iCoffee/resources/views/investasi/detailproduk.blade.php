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
              <div class="col-lg-6 pl-4 md-5 pr-2 ftco-animatee">
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
                  <i class="fa fa-percent"></i> Return yang didapat
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

              <form action="/invest/checkout" method="post"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_produk" value="{{$products->id}}">
                <input type="hidden" name="id_mitra" value="{{$products->id_mitra}}">


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
              {{-- <button type="submit" class="btn btn-primary py-3 px-5"><i class="fa fa-credit-card"> </i>&nbsp;&nbsp;&nbsp; Salurkan Pembayaran</button> --}}
           
              <input type="submit" class="btn btn-primary py-3 px-5" value="Salurkan Pembayaran">
               
         
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
              <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
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
          <div class="container">
            <div class="row">
              <div class="col-md-4-sm-4">
                <img src="{{$path}}" height="150px" width="150px" style="border-radius: 40%">
              </div>
              <div class="col-md-7-sm-7-ml-2">
                <h5>{{$mitra->nama}}</h5>
                <hr>
                <p>Operator iCoffee</p>
                <i class="fa fa-leaf fa-lg"></i> 331 Dikelola <i class="fa fa-user fa-lg"></i> {{$mitra->jumlah_petani}} Petani <i class="fa fa-map fa-lg"></i> {{$mitra->alamat}}
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
		            if(quantity>1){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
  </script>
  
  <script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#1cc88a';
    
    function number_format(number, decimals, dec_point, thousands_sep) {
      // *     example: number_format(1234.56, 2, ',', ' ');
      // *     return: '1 234,56'
      number = (number + '').replace(',', '').replace(' ', '');
      var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
        };
      // Fix for IE parseFloat(0.55).toFixed(0) = 0;
      s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
      if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
      }
      if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
      }
      return s.join(dec);
    }
    
    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: {!! json_encode($collection)!!},
        datasets: [{
          label: "Profit",
          lineTension: 0.3,
          backgroundColor: "#f2fcf3",
          borderColor: "#1cc88a",
          pointRadius: 3,
          pointBackgroundColor: "#1cc88a",
          pointBorderColor: "#1cc88a",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: {!! json_encode($collect)!!},
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return 'Rp. ' + number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
    </script>
    <script src="{{asset('investasi/mitra/vendor/chart.js/Chart.min.js')}}"></script>
    <link href="{{asset('investasi/mitra/css/sb-admin-2.min.css') }}" rel="stylesheet">
@endsection

