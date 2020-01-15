@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Kerajang')
@section('sidebar')
@endsection
@section('content')

	<form action="/action_page.php" oninput="total.value=parseInt(harga.value)*parseInt(quantity.value)">
    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
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
								@foreach ($keranjang as $data)
									
								
						      <tr class="text-center">
						        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><div class="img" style="background-image: url({{ asset('Uploads/Produk/{'.$data->kode_produk.'}/'.$data->image) }});"></div></td>

						        <td class="product-name">
									<h3>{{ $data->nama_produk }}</h3>
						        </td>
						        
						        <td class="price">{{ $data->harga }}</td>
						        <input type="hidden" id="harga" name="harga" value="{{ $data->harga }}" readonly>
						        <td class="quantity">
						        	<div class="input-group mb-3">
										{{-- <span class="input-group-btn mr-2">
											<button type="button" class="quantity-left-minus btn"  data-quantity="minus" data-field="quantity">
											<i class="ion-ios-remove"></i>
											</button>
										</span> --}}
							
										<input type="number" id="jumlah" name="quantity" class="form-control input-number" value="{{ $data->jumlah }}" min="1" max="100">
										{{-- <span class="input-group-btn ml-2">
											<button type="button" class="quantity-right-plus btn" data-quantity="plus" data-field="quantity">
											<i class="ion-ios-add"></i>
										</button>
										</span> --}}
									</div>
					          </td>
						        
						        <td class="total"><output name="total" for="harga jumlah">{{ $data->total }}</output></td>
							  </tr><!-- END TR-->
							  







						      {{-- <tr class="text-center">
						        <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
						        
						        <td class="image-prod"><div class="img" style="background-image:url(images/product-4.jpg);"></div></td>
						        
						        <td class="product-name">
						        	<h3>Bell Pepper</h3>

						        </td>
						        
						        <td class="price">Rp 200.000</td>
						        
						        <td class="quantity">
						        	<div class="input-group mb-3">
										<span class="input-group-btn mr-2">
											<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
											<i class="ion-ios-remove"></i>
											</button>
									</span>
							
										<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1">
										<span class="input-group-btn ml-2">
											<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
											<i class="ion-ios-add"></i>
										</button>
										</span>
									</div>
					          </td>
						        
						        <td class="total">Rp 200.000</td>
						      </tr><!-- END TR--> --}}
							
							  @endforeach
							</tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col-lg-5 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<p class="d-flex total-price">
    						<span>Sub Total ({{ $carttotal }}) Produk</span>
							<span>{{ $subtotal }}</span>
    					</p>
    				</div>
					{{-- <p><a href="/jual-beli/checkout" class="btn btn-primary py-2 px-5">Checkout</a></p> --}}
					<p><input type="submit" class="btn btn-primary py-2 px-5" value="Checkout"></p>
    			</div>
    		</div>
			</div>
		</section>
   
  <script>
		$(document).ready(function(){

		var quantitiy=1;
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

		

		jQuery(document).ready(function(){
			// This button will increment the value
			$('[data-quantity="plus"]').click(function(e){
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				fieldName = $(this).attr('data-field');
				// Get its current value
				var currentVal = parseInt($('input[name='+fieldName+']').val());
				// If is not undefined
				if (!isNaN(currentVal)) {
					// Increment
					$('input[name='+fieldName+']').val(currentVal + 1);
				} else {
					// Otherwise put a 0 there
					$('input[name='+fieldName+']').val(0);
				}
			});
			// This button will decrement the value till 0
			$('[data-quantity="minus"]').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				fieldName = $(this).attr('data-field');
				// Get its current value
				var currentVal = parseInt($('input[name='+fieldName+']').val());
				// If it isn't undefined or its greater than 0
				if (!isNaN(currentVal) && currentVal > 0) {
					// Decrement one
					$('input[name='+fieldName+']').val(currentVal - 1);
				} else {
					// Otherwise put a 0 there
					$('input[name='+fieldName+']').val(0);
				}
			});
		});


	</script>
    

@endsection
