@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Kerajang')
@section('sidebar')
@endsection
@section('content')

	<form action="/jual-beli/checkout-barang" method="POST" oninput="total.value=parseInt(harga.value)*parseInt(quantity.value)">
		@csrf
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
								<th>&nbsp;</th>
						      </tr>
						    </thead>
						    <tbody>
								@foreach ($keranjang as $data)
									
								
						      <tr class="text-center">
						        <td class="product-remove"><input type="checkbox" name="id[]" value="{{$data->id}}"></td>
						        
						        <td class="image-prod"><div class="img" style="background-image: url({{ asset('Uploads/Produk/{'.$data->kode_produk.'}/'.$data->image) }});"></div></td>

						        <td class="product-name">
									<h3>{{ $data->nama_produk }}</h3>
									<p>{{ $data->shop_product->user->name }}</p>
						        </td>
						        
						        <td class="price">{{ $data->harga }}</td>
						        <input type="hidden" id="harga" name="harga[]" value="{{ $data->harga }}" readonly>
								
								

								<td class="quantity">
									<form method="post" class="form-user">
										<input type="hidden" id="id_qty" value="{{ $data->id}}">

										<div class="input-group mb-3">
											<span class="input-group-btn mr-2">
												<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
												<i class="ion-ios-remove"></i>
												</button>
											</span>
								
											<input type="text" id="{{ $data->id }}" name="quantity[]" class="form-control input-number" required value="{{ $data->jumlah }}" min="1" max="100">
											<span class="input-group-btn ml-2">
												<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
												<i class="ion-ios-add"></i>
											</button>
											</span>
										</div>
									</form>
					          </td>
						        
								<td class="total"><output name="total" for="harga jumlah">{{ $data->total }}</output></td>
								<td class="product-remove"><a href="/jual-beli/keranjang/hapus/{{ $data->id }}"><span class="oi oi-trash"></span></a></td>
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
   
	

{{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}
    

@endsection
@section('js')
	
@foreach ($keranjang as $data)
	

<script>
	$(document).ready(function(){
  
	var quantitiy=0;
	   $('.quantity-right-plus').click(function(e){
		
		// Stop acting like a button
		e.preventDefault();
		// Get the field name
		var quantity = parseInt($('#{!!json_encode($data->id)!!}').val());
		
		// If is not undefined
		  
		  $('#{!!json_encode($data->id)!!}').val(quantity + 1);
  
		  var data = $('.form-user').serialize();
  
		  $.ajax({
			  type: 'POST',
			  url: "/jual-beli/update-keranjang",
			  data: data
			  // success: function() {
			  //   $('.tampildata').load("tampil.php");
			  // }
		  });
		
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
@endforeach

  @stop