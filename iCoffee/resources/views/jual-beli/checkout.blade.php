@extends('jual-beli.layoutsjb.apps')

@section('content')

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col ftco-animate">

          	<h3 class="mb-4 billing-heading">Checkout</h3>

          		<div class="col-md-12 ">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Alamat Pengiriman</h3>
								<div class="form-group">
									<div class="row align-items-end">
										<div class="col-xl-6 ftco-animate">
											<p class="col-lg-12">Fauzi Riski</p>
											<p class="col-lg-12">Jl. Durian 2 no 20,tanjung karang pusat, bandar lampung - Tanjung Karang Pusat, Kota Bandar Lampung, 35116</p>
										</div>

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
									        <th>&nbsp;</th>
									        <th>Nama Produk</th>
									        <th>Harga</th>
									        <th>Jumlah</th>
									        <th>Total</th>
									      </tr>
									    </thead>
									    <tbody>
									      <tr class="text-center">
									        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
									        
									        <td class="image-prod"><div class="img" style="background-image:url(images/product-3.jpg);"></div></td>
									        
									        <td class="product-name">
									        	<h3>Bell Pepper</h3>
									        </td>
									        
									        <td class="price">Rp 300.000</td>
									        
									        <td class="total">1</td>
									        
									        <td class="total">Rp 300.000</td>
									      </tr><!-- END TR-->

									      <tr class="text-center">
									        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
									        
									        <td class="image-prod"><div class="img" style="background-image:url(images/product-4.jpg);"></div></td>
									        
									        <td class="product-name">
									        	<h3>Bell Pepper</h3>

									        </td>
									        
									        <td class="price">Rp 200.000</td>
									        
									        <td class="total">1</td>
									        
									        <td class="total">Rp 200.000</td>
									      </tr><!-- END TR-->
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
				          			<div class="col-md-6">
			            				<div class="form-group">
			            					<label for="country">Pilih Durasi</label>
			            					<div class="select-wrap">
								                  <select name="" id="" class="form-control">
								                  	<option value="">Cepat (1 Hari)</option>
								                    <option value="">Reguler (2-4 Hari)</option>
								                  </select>
								            </div>
								        </div>
			            			</div>

			            			<div class="col-md-6 ">
			            				<div class="form-group">
			            					<label for="country">State / Country</label>
			            					<div class="select-wrap">
								                  <select name="" id="" class="form-control">
								                  	<option value="">J&T (Rp 22.000)</option>
								                    <option value="">JNE (Rp 19.000)</option>
								                  </select>
								            </div>
								        </div>
		            				</div>

				          			<div class="col-md-12 p-1 p-md-3">
				          				<label for="country">Subtotal</label>
				          				<div class="cart-detail">
				          					
				          					<h6 class="text-center">Total Pembayaran Rp 500.000</h6>
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
											   <label><input type="radio" name="optradio" class="mr-2"> Bank BCA</label>
											</div>
										</div>
									</div>


									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Bank BNI</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Bank Mandiri</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Bank BRI</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Bank Lainnya</label>
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
			    						<span>Rp 500.000</span>
			    					</p>
			    					<p class="d-flex">
			    						<span>Total Ongkos Kirim</span>
			    						<span>Rp 22.000</span>
			    					</p>
			    					<hr>
			    					<p class="d-flex">
			    						<span>Total Pembayaran</span>
			    						<span>Rp 522.000</span>
			    					</p>
			    					
			    				</div>
			    				<div class="row">
			    				<div class="col-md-8 offset-md-7">
			    				<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Buat Pesanan</a></p>
			    			</div>
			    		</div>
			    			</div>
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
    