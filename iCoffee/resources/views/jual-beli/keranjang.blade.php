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
								  @if ($data->shop_product->stok <= 0)
									<td class="product-remove"><input type="checkbox" name="" id="" disabled></td>
								  @else
								  <td class="product-remove"><input type="checkbox" id="id_produk{{$data->id}}" name="id[]" value="{{$data->id}}"></td>
								  @endif
						        
						        
						        <td class="image-prod"><div class="img" style="background-image: url({{ asset('Uploads/Produk/{'.$data->kode_produk.'}/'.$data->image) }});"></div></td>

						        <td class="product-name">
									<h3>{{ $data->nama_produk }}</h3>
									<p>{{ $data->shop_product->user->name }}</p>
									@if ( $data->shop_product->stok <= 0)
										<p style="color:red">(Stok Kosong)</p>
									@endif
						        </td>
						        
						        <td class="price">Rp {{ number_format($data->harga,0,",",".") }}</td>
						        <input type="hidden" id="harga{{ $data->id }}" name="harga[]" value="{{ $data->harga }}" readonly>
								
								

								<td class="quantity">
									<form method="post" class="form-user">
										<input type="hidden" id="id_qty" value="{{ $data->id }}">

										<div class="input-group mb-3">
											<span class="input-group-btn mr-2">
												<button type="button" class="quantity-left-minus btn"  value="{{ $data->id }}"  data-type="minus" data-field="">
												<i class="ion-ios-remove"></i>
												</button>
											</span>
								
											<input type="text" id="qty{{ $data->id }}" name="quantity[]" class="qty form-control input-number" readonly required value="{{ $data->jumlah }}" min="1" max="100">
											<span class="input-group-btn ml-2">
												<button type="button" class="quantity-right-plus btn" value="{{ $data->id }}" data-type="plus" data-field="">
												<i class="ion-ios-add"></i>
											</button>
											</span>
										</div>
									</form>
					          </td>
						        
								<td class="total"><output name="total" id="total{{ $data->id }}" for="harga jumlah">Rp {{ number_format($data->total,0,",",".") }}</output></td>
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
							<span id="sub_total">Rp {{ number_format($subtotal,0,",",".") }}</span>
    					</p>
    				</div>
					{{-- <p><a href="/jual-beli/checkout" class="btn btn-primary py-2 px-5">Checkout</a></p> --}}
					<p><input type="submit" class="btn btn-primary py-2 px-5" id="checkBtn" value="Checkout"></p>
    			</div>
    		</div>
			</div>
		</section>
   
	

{{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> --}}
    

@endsection
@section('js')
	
	

<script>
	$(document).ready(function(){
	var  u = {!!json_encode($subtotal)!!};
	
	var quantitiy=0;
	   $('.quantity-right-plus').click(function(e){
		var y = $(this).val();
		var z = $('#qty'+y).val();
		var x = $('#total'+y).val();
		var w = $('#harga'+y).val();
		var v = parseInt(w)+parseInt(u);
  
		  $.ajax({
			  type: 'GET',
			  url: "/jual-beli/update-keranjang/"+y+"/plus",
			  data: "id=y&type=jumlah",
			  success: function(data) {
			    $('#qty'+y).replaceWith('<input type="text" id="qty'+ y +'" name="quantity[]" class="qty form-control input-number" required value="'+ data.jumlah +'" min="1" max="100">');
				$('#total'+y).replaceWith('<output name="total" id="total'+ y +'" for="harga jumlah">Rp '+ data.total.toLocaleString("id-ID") +'</output>');
				$('#sub_total').replaceWith('<span id="sub_total">Rp '+ v.toLocaleString("id-ID") +' </span>');
				u = v;
			  }
		  });
		
	  });
  
	   $('.quantity-left-minus').click(function(e){
		

		var y = $(this).val();
		var z = $('#qty'+y).val();
		var w = $('#harga'+y).val();
		var v = parseInt(u)-parseInt(w);
		
  
		  $.ajax({
			  type: 'GET',
			  url: "/jual-beli/update-keranjang/"+y+"/minus",
			  data: "id=y&type=jumlah",
			  success: function(data, tombol) {
	 
				$('#qty'+y).replaceWith('<input type="text" id="qty'+ y +'" name="quantity" class="qty form-control input-number" required value="'+ data.jumlah +'" min="1" max="100">');
				$('#total'+y).replaceWith('<output name="total" id="total'+ y +'" for="harga jumlah">Rp '+ data.total.toLocaleString("id-ID") +'</output>');
				$('#sub_total').replaceWith('<span id="sub_total">Rp '+ v.toLocaleString("id-ID") +' </span>');
				u = v;
			  }
		  });
		
	  });

    $('#checkBtn').click(function() {
		checked = $("input[type=checkbox]:checked").length;

		if(!checked) {
			swal(
                'Gagal',
                'Pilih Barang Untuk di Pesan',
                'error'
              );
			return false;
		}

		});


	  
	});

	
  </script>

  @stop