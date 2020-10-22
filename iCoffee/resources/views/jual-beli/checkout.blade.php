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
									<div class="col-md-9 col-12 ftco-animate">
										<p class="col-lg-12">{{ $alamat->nama }}</p>
										<p class="col-lg-12">{{ $alamat->address }} - {{ $alamat->province->nama }}, {{ $alamat->city->nama }}, {{ $alamat->subdistrict->name }},  {{ $alamat->kode_pos }}</p>
									</div>

									<input type="hidden" name="id_alamat" value="{{ $alamat->id }}">
									<input type="hidden" name="nama_alamat" value="{{ $alamat->nama }}">

									<div class="col-md-3 col-12">
										<p><a href="/profile/alamat#pills-daftar-alamat" style="border-radius: 10px" class="btn btn-primary py-3 px-4 align-self-end">Ganti Alamat</a></p>	
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>



					@for ($i = 0; $i < $jumlah_penjual; $i++)
					<div class="col-md-12">
						<h3>Toko {{ $penjual[$i]->name }}</h3>
						<input type="hidden" name="id_toko[{{ $i }}]" value="{{ $penjual[$i]->id }}">

						<div class="cart-detail p-3 p-md-4">
							<div class="row">
								<div class="col-md-12 ftco-animate">
									<div class="table-responsive col-sm-12">
										<table class="table table-condensed">
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


												@for ($j = 0; $j < $jumlah_data_checkout[$i]; $j++)


												<tr class="text-center">
													<td class="image-prod">
														<img src="{{ asset('Uploads/Produk/'.$checkout_data[$i][$j]->kode_produk.'/'.$checkout_data[$i][$j]->image) }}" alt="Responsive image" class="img rounded">
													</td>
													<td class="product-name">
														<h3>{{ $checkout_data[$i][$j]->nama_produk }}</h3>
													</td>
													<td class="price">Rp {{ number_format($checkout_data[$i][$j]->harga,0,",",".") }}</td>
													<td class="total">{{ $checkout_data[$i][$j]->jumlah }}</td>
													<td class="total">Rp {{ number_format($checkout_data[$i][$j]->total,0,",",".") }}</td>
												</tr><!-- END TR-->
												<input type="hidden" name="id_keranjang[]" value="{{ $checkout_data[$i][$j]->id  }}">
												<input type="hidden" name="id_produk[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->id_produk   }}">
												<input type="hidden" name="id_penjual[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->id_penjual }}">
												<input type="hidden" name="harga[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->harga }}">
												<input type="hidden" name="jumlah[{{ $i }}][{{ $j }}]" value="{{$checkout_data[$i][$j]->jumlah }}">
												<input type="hidden" name="nama_produk[{{ $i }}][{{ $j }}]" value="{{$checkout_data[$i][$j]->nama_produk }}">
												<input type="hidden" name="kode_produk[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->kode_produk }}">
												<input type="hidden" name="gambar[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->image }}">
												<input type="hidden" name="total[{{ $i }}][{{ $j }}]" value="{{ $checkout_data[$i][$j]->total }}">


												@endfor



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
											<textarea rows="5" type="text" name="pesan[]" class="form-control" ></textarea>
										</div>
									</div>
								</div>

								<div class="col-md-6 p-1 p-md-3">
									<div class="row align-items-end">

										<div class="col-md-12">
											<div class="form-group">
												<label for="country">Pilih Kurir</label>
												<div class="select-wrap">
													<select name="kurir[{{ $i }}]" id="kurir{{ $penjual[$i]->id }}" class="kurir form-control"  required>
														{{-- onchange="myFunction()" --}}
														<option selected disabled="disabled" value="" >Pilih Kurir</option>
														@for ($k = 0; $k < count($costjne[$i]["rajaongkir"]["results"][0]["costs"]); $k++)
														<option value="{{ $costjne[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"] }}: JNE: {{ $costjne[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }} " >
															JNE Rp {{ number_format($costjne[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"],0,",",".") }} ( {{ $costjne[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }} {{ $costjne[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["etd"] }} Hari )
														</option>
														@endfor

														@for ($k = 0; $k < count($costtiki[$i]["rajaongkir"]["results"][0]["costs"]); $k++)
														<option value="{{ $costtiki[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"] }}: TIKI: {{ $costtiki[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }}">
															TIKI Rp {{ number_format($costtiki[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"],0,",",".") }} ( {{ $costtiki[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }} {{ $costtiki[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["etd"] }} Hari )
														</option>
														@endfor

														@for ($k = 0; $k < count($costjnt[$i]["rajaongkir"]["results"][0]["costs"]); $k++)
														<option value="{{ $costjnt[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"] }}: JNT: {{ $costjnt[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }}">
															J&T Rp {{ number_format($costjnt[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"],0,",",".") }} ( {{ $costjnt[$i]["rajaongkir"]["results"][0]["costs"][$k]["description"] }} {{ $costjnt[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["etd"] }} )
														</option>
														@endfor

														@for ($k = 0; $k < count($costninja[$i]["rajaongkir"]["results"][0]["costs"]); $k++)
														<option value="{{ $costninja[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"] }}: Ninja: {{ $costninja[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }}">
															Ninja Rp {{ number_format($costninja[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"],0,",",".") }} ( {{ $costninja[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }} {{ $costninja[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["etd"] }} )
														</option>
														@endfor

														@for ($k = 0; $k < count($costlion[$i]["rajaongkir"]["results"][0]["costs"]); $k++)
														<option value="{{ $costlion[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"] }}: Lion: {{ $costlion[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }}">
															Ninja Rp {{ number_format($costlion[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["value"],0,",",".") }} ( {{ $costlion[$i]["rajaongkir"]["results"][0]["costs"][$k]["service"] }} {{ $costlion[$i]["rajaongkir"]["results"][0]["costs"][$k]["cost"][0]["etd"] }} )
														</option>
														@endfor

													</select>
												</div>
											</div>
										</div>

										<div class="col-md-12 p-1 p-md-3">
											<label for="country">Subtotal</label>
											<div class="cart-detail">

												<input type="hidden" name="total_bayar[]" value="{{ $jumlah[$i] }}">

												<h6 class="text-center mt-1">Total Pembayaran Rp. {{ number_format($jumlah[$i],0,",",".") }}</h6>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>


					</div>
					@endfor



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
										<span>Rp. {{ number_format($jumlah_seluruh,0,",",".") }}</span>
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
									<div class="col-md-4 col text-center col-12 offset-md-8 mb-5">
										{{-- <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Buat Pesanan</a></p> --}}
										<p><input type="submit"  style="border-radius: 10px" class="btn btn-primary py-3 px-4" value="Buat Pesanan"></p>
									</div>
								</div>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>


	@endsection

	@section('js')

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
	<script>
		$(document).ready(function() {
			var penjual =  {!!json_encode($penjual)!!};
			length = penjual.length
			for (i = 0; i < length; i++) {
				id = penjual[i].id;
			}
			

			$(function(){
				
				$(".kurir").change(function() {
					var sum = 0;
					for (i = 0; i < length; i++) {
						console.log('mantap');
						$("#kurir"+penjual[i].id).each(function() {
							sum += parseInt($(this).val());
						});
						
					}
					var c = sum.toLocaleString("id-ID");


					var y = {!!json_encode($jumlah_seluruh)!!};
					var b = y.toLocaleString("id-ID");
					var z = parseInt(sum)+parseInt(y);
					var a = z.toLocaleString("id-ID");

					document.getElementById("demo").innerHTML = "Rp " +c;
					document.getElementById("total").innerHTML = "Rp " +a;
				});


			});
		})
		
		
		/*POWZI PUNYA
		function myFunction() {
				  var x = document.getElementById("kurir"+id).value;
				  console.log(x);
		  var y = {!!json_encode($jumlah_seluruh)!!};
		  var z = parseInt(x)+parseInt(y);
		  document.getElementById("demo").innerHTML = "Rp. " +x;
		  document.getElementById("total").innerHTML = "Rp. " +z;
		}
		*/
	</script>


	@stop