@extends('jual-beli.layouts.app')
@section('title', 'Checkout')
@section('sidebar')
@endsection
@section('content')

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col ftco-animate">
			<form action="/jual-beli/pesanbarang" method="post">
				@csrf
          	<h3 class="mb-4 billing-heading">Checkout</h3>

          		<div class="col-md-12 ">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Alamat Pengiriman</h3>
								<div class="form-group">
									<div class="row align-items-end">
										<div class="col-xl-6 ftco-animate">
											<p class="col-lg-12">{{ $alamat->nama }}</p>
											<p class="col-lg-12">{{ $alamat->address }} - {{ $alamat->provinsi }}, {{ $alamat->kota_kabupaten }}, {{ $alamat->kecamatan }},  {{ $alamat->kode_pos }}</p>
										</div>

											<input type="hidden" name="id_alamat" value="{{ $alamat->id }}">
											<input type="hidden" name="nama_alamat" value="{{ $alamat->nama }}">

										<div class="col">
											<p><a href="checkout.html" class="btn btn-primary py-3 px-4 col-lg-7 align-self-end">Ganti Alamat</a></p>	
										</div>
									</div>
								</div>
	          		</div>
	          	</div>
	          	<br>

						
		
				
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<div class="row">
			    			<div class="col-md-12 ftco-animate">
			    				<div class="cart-list">
				    				<table class="table">
									    <thead class="">
									      <tr class="text-center">
						
									        <th>&nbsp;</th>
									        <th>Nama Produk</th>
									        <th>Harga</th>
									        <th>Jumlah</th>
									        <th>Total</th>
									      </tr>
									    </thead>
									    <tbody>
										@foreach ($checkout as $data)
									      <tr class="text-center">
									 
									        
									        <td class="image-prod"><div class="img" style="background-image: url({{ asset('Uploads/Produk/{'.$data->kode_produk.'}/'.$data->image) }});"></div></td>
									        
									        <td class="product-name">
									        	<h3>{{ $data->nama_produk }}</h3>
									        </td>
									        
									        <td class="price">{{ $data->harga }}</td>
									        
									        <td class="total">{{ $data->jumlah }}</td>
									        
									        <td class="total">{{ $data->total }}</td>
										  </tr><!-- END TR-->
										  <input type="hidden" name="id[]" value="{{ $data->id_produk }}">
										  <input type="hidden" name="id_produk[]" value="{{ $data->id_produk }}">
										  <input type="hidden" name="id_penjual[]" value="{{ $data->id_pelanggan }}">
										  <input type="hidden" name="harga[]" value="{{ $data->harga }}">
										  <input type="hidden" name="jumlah[]" value="{{ $data->jumlah }}">
										  <input type="hidden" name="nama_produk[]" value="{{ $data->nama_produk }}">
										  <input type="hidden" name="kode_produk[]" value="{{ $data->kode_produk }}">
										  <input type="hidden" name="gambar[]" value="{{ $data->image }}">
										  <input type="hidden" name="total[]" value="{{ $data->total }}">
					
											
										@endforeach


									    
									    </tbody>
									  </table>
								  </div>
			    			</div>
			    		</div>
        			</div>
      			</div>

      			<br>


      			<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">

	          			<div class="row align-items-end">
		          			<div class="col-md-6 p-2 p-md-4">
		          				<div class="form-group">
			                		<div class="form-group">
		                				<label for="pesan">Pesan untuk penjual (Opsional)</label>
		                  				<textarea rows="5" type="text" name="pesan" class="form-control" ></textarea>
		                			</div>
		          				</div>
		          			</div>

		          			<div class="col-md-6 p-1 p-md-3">
			          			<div class="row align-items-end">

			            			<div class="col-md-12">
			            				<div class="form-group">
			            					<label for="country">Pilih Kurir</label>
			            					<div class="select-wrap">
								                  <select name="kurir" id="kurir" class="form-control" onchange="myFunction()" required>
													<option selected disabled="disabled" value="" >Pilih Kurir</option>
													@for ($i = 0; $i < count($costjne[0]["costs"]); $i++)
												  <option value="{{ $costjne[0]["costs"][$i]["cost"][0]["value"] }}: JNE: {{ $costjne[0]["costs"][$i]["service"] }} " >JNE {{ $costjne[0]["costs"][$i]["cost"][0]["value"] }} ( {{ $costjne[0]["costs"][$i]["service"] }} {{ $costjne[0]["costs"][$i]["cost"][0]["etd"] }} Hari )</option>
													@endfor

													@for ($i = 0; $i < count($costtiki[0]["costs"]); $i++)
												  <option value="{{ $costtiki[0]["costs"][$i]["cost"][0]["value"] }}: TIKI: {{ $costjne[0]["costs"][$i]["service"] }}">TIKI {{ $costtiki[0]["costs"][$i]["cost"][0]["value"] }} ( {{ $costtiki[0]["costs"][$i]["service"] }} {{ $costtiki[0]["costs"][$i]["cost"][0]["etd"] }} Hari )</option>
													@endfor

													@for ($i = 0; $i < count($costpos[0]["costs"]); $i++)
												  <option value="{{ $costpos[0]["costs"][$i]["cost"][0]["value"] }}: POS: {{ $costjne[0]["costs"][$i]["service"] }}">POS {{ $costpos[0]["costs"][$i]["cost"][0]["value"] }} ( {{ $costpos[0]["costs"][$i]["service"] }} {{ $costpos[0]["costs"][$i]["cost"][0]["etd"] }} )</option>
													@endfor
						                    
								                  </select>
								            </div>
								        </div>
			            			</div>

				          			<div class="col-md-12 p-1 p-md-3">
				          				<label for="country">Subtotal</label>
				          				<div class="cart-detail">

										  	<input type="hidden" name="total_bayar" value="{{ $jumlah }}">
				          					
				          					<h6 class="text-center">Total Pembayaran Rp. {{ $jumlah }}</h6>
			            				</div>
			            			</div>
			          			</div>

				          	</div>
			          	</div>
		          	</div>


	          	</div>



	          	<div class="col-md-12">
	          		    <div class="row justify-content-end">
			    			<div class="col-lg-5 mt-5 cart-wrap ftco-animate">
			    				<div class="cart-total mb-3">
			    					<h3>Transfer Bank</h3>
			    					<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="bank" class="mr-2" value="BCA" required> Bank BCA</label>
											</div>
										</div>
									</div>


									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="bank" class="mr-2" value="BNI"> Bank BNI</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="bank" class="mr-2" value="Mandiri"> Bank Mandiri</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="bank" class="mr-2" value="BRI"> Bank BRI</label>
											</div>
										</div>
									</div>

			    				</div>
			    			</div>

			    			<div class="col-lg-7 mt-5 cart-wrap ftco-animate">
			    				<div class="cart-total mb-3">
			    					<h3>Cart Totals</h3>
			    					<p class="d-flex">
			    						<span>Subtotal untuk Produk</span>
			    						<span>Rp. {{ $jumlah }}</span>
			    					</p>
			    					<p class="d-flex">
			    						<span>Total Ongkos Kirim</span>
			    						<span id="demo" ></span>
			    					</p>
			    					<hr>
			    					<p class="d-flex">
			    						<span>Total Pembayaran</span>
			    						<span id="total"></span>
			    					</p>
			    					
			    				</div>
			    				<div class="row">
			    				<div class="col-md-8 offset-md-7">
								{{-- <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Buat Pesanan</a></p> --}}
								<p><input type="submit" class="btn btn-primary py-3 px-4" value="Buat Pesanan"></p>
			    			</div>
			    		</div>
			    			</div>
			    		</div>
      			</div>

			</form>
			 </div>
		</div>
      </div>

    </section> <!-- .section -->

		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
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
	</section>



@endsection
 
@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
	<script>
		function myFunction() {
		  var x = document.getElementById("kurir").value;
		  var y = {!!json_encode($jumlah)!!};
		  var z = parseInt(x)+parseInt(y);
		  document.getElementById("demo").innerHTML = "Rp. " +x;
		  document.getElementById("total").innerHTML = "Rp. " +z;		
		}
		</script>

	{{-- <script>
		function myTotal() {
		var x = document.getElementById("kurir").value;
		
		
		console.log(z);
		
		}

	</script> --}}

	{{-- <script type="text/javascript">
		$(document).ready(function() {

		$('select[name="kurir"]').on('change', function() {
			var provinceID = $(this).val();
				if(provinceID) {
				$.ajax({
					url: '/jual-beli/checkout/kurir/'+encodeURI(provinceID),
					type: "GET",
					dataType: "json",
					success:function(data) {
					$('select[name="biaya"]').empty();
					$.each(data, function(key, value) {
						$('select[name="biaya"]').append('<option value="'+ value["rajaongkir"]["results"][0]["costs"][$i]["cost"][0]["value"] +'">'+ value +'</option>');
						});
					}
				});
				}else{
				$('select[name="biaya"]').empty();
				}
			});
			});


	</script> --}}

@stop