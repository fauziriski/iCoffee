@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
@section('sidebar')
@endsection
@section('content')


<div class="container mt-5">
	<div class="invoice-title">
		<h3>Invoice</h3><h3 class="pull-right">Order # {{ $order[0]->invoice }}</h3>
	</div>
	@for ($i = 0; $i < $hitung; $i++)
	
    <div class="row mb-2">
        <div class="col-md-12">	
    		<hr>
    		<div class="row">
    			<div class="col-md-3 col-6">
    				<address>
					<strong>Pengirim :</strong><br>
						
						{{ $alamat_penjual[$i]->nama }}<br>
						{{ $alamat_penjual[$i]->address }},
						{{ $alamat_penjual[$i]->kecamatan }},
						{{ $alamat_penjual[$i]->city->nama }},
    					{{ $alamat_penjual[$i]->province->nama }}, 			
						{{ $alamat_penjual[$i]->kode_pos }}
    				</address>
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
        			<strong>Penerima :</strong><br>
						{{ $alamat_pembeli[$i]->nama }}<br>
						{{ $alamat_pembeli[$i]->address }},
						{{ $alamat_pembeli[$i]->kecamatan }},
						{{ $alamat_pembeli[$i]->city->nama }},
						{{ $alamat_pembeli[$i]->province->nama }}, 			
						{{ $alamat_pembeli[$i]->kode_pos }}
    				</address>
    			</div>
    		   		
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Metode Pembayaran :</strong><br>
    					{{ $rekening[$i]->bank_name }} {{ $rekening[$i]->no_rekening }}<br>

					</address>
					
					@if ($order[$i]->status == 5 || 6 || 7 || 10 || 11)
					<address>
    					<strong>No Resi :</strong><br>
    				{{$kurir[$i][1]}} {{ $cek_resi[$i]->invoice }}<br>

					</address>
						
					@else
						
					<address>
						<strong>No Resi :</strong><br>
							

					</address>

					
					@endif
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Tanggal Order :</strong><br>
						{{ $order[$i]->created_at}}<br>
						
						<strong>Status :</strong><br>
						@if ( $order[$i]->status == 1)
							<div class="alert alert-warning" role="alert">
								Belum Dibayar
							</div>		  
						@elseif( $order[$i]->status == 2)
							<div class="alert alert-info" role="alert">
								Pembayaran Ditolak
							</div>

						@elseif( $order[$i]->status == 3)
							<div class="alert alert-info" role="alert">
								Di Serahkan ke Penjual
							</div>
						@elseif( $order[$i]->status == 4)
							<div class="alert alert-info" role="alert">
								Penjual Menerima dan Barang di Proses
							</div>
						@elseif( $order[$i]->status == 5)
							<div class="alert alert-info" role="alert">
								Barang Dikirim
							</div>
						@elseif( $order[$i]->status == 6)
							<div class="alert alert-success" role="alert">
								Selesai
							</div>
						@elseif( $order[$i]->status == 7)
							<div class="alert alert-info" role="alert">
								komplain
							</div>
						@elseif( $order[$i]->status == 8)
							<div class="alert alert-info" role="alert">
								Pembayaran Sedang di Proses
							</div>
						@elseif( $order[$i]->status == 9)
							<div class="alert alert-danger" role="alert">
								Pembelian dibatalkan
							</div>
						
						@elseif( $order[$i]->status == 10)
							<div class="alert alert-info" role="alert">
								Komplain dibatalkan
							</div>

						@elseif( $order[$i]->status == 11)
							<div class="alert alert-info" role="alert">
								Komplain diterima
							</div>

						@elseif( $order[$i]->status == 0)
							<div class="alert alert-danger" role="alert">
								Penjual Menolak Pesanan
							</div>
							
						@endif
    					
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row mb-5">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="card-header"><strong>Detail Order</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive col-sm-12">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td class="text-center"><strong>Nama Produk</strong></td>
        							<td class="text-center"><strong>Harga</strong></td>
        							<td class="text-center"><strong>Jumlah</strong></td>
        							<td class="text-center"><strong>Total</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@for ($j = 0; $j < $hitungdataorder[$i]; $j++)
    							<tr>
									<td>{{ $orderdetaildata[$i][$j]->nama_produk }}</td>
									<td class="text-center">Rp {{  number_format($orderdetaildata[$i][$j]->harga,0,",",".")  }}</td>
    								<td class="text-center">{{  $orderdetaildata[$i][$j]->jumlah  }}</td>
    								<td class="text-right">Rp {{  number_format($orderdetaildata[$i][$j]->total,0,",",".")  }}</td>
								</tr>
								
								@endfor
                                
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right">Rp {{ number_format($order[$i]->total_bayar,0,",",".") }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
    								<td class="no-line text-right">Rp {{ number_format($kurir[$i][0],0,",",".") }}</td>
								</tr>
								

    						</tbody>
						</table>
						
						@if ( $order[$i]->status == 5)
							<form action="/jual-beli/pesanan/selesai" method="post">
								@csrf
								<input type="hidden" name="id" required value="{{ $order[$i]->id }}">
								<input type="hidden" name="invoice" required value="{{ $order[0]->invoice }}">
								<input type="hidden" name="jumlah_seluruh" required value="{{ $order[$i]->total_bayar+$kurir[$i][0] }}">
								<p class="float-right"><input type="submit" class="btn btn-secondary  py-3 px-5" name="submit" value="Komplain">
									<input type="submit" class="btn btn-primary py-3 px-5" name="submit" value="Diterima">
							</p>
							</form>

						@elseif( $order[$i]->status == 6)
							<p class="float-right"><input type="submit" class="btn btn-primary  py-3 px-5" data-toggle="modal" data-target="#exampleModalCenter" name="submit" value="Rating"></p>
							<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Rating</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
										<div class="container">
											<form action="" id="rating_form" method="post">
												@csrf
												<input type="hidden" name="id_order_rating" id="id_order_rating" required value="{{ $order[$i]->id }}">
											<div class="row">
											<div class="col-lg-12">
												<div class="star-rating text-center">
												
												<span class="fa fa-star-o" data-rating="1"></span>
												<span class="fa fa-star-o" data-rating="2"></span>
												<span class="fa fa-star-o" data-rating="3"></span>
												<span class="fa fa-star-o" data-rating="4"></span>
												<span class="fa fa-star-o" data-rating="5"></span>
												<input type="hidden" name="whatever1" class="rating-value" value="{{ $penilaian[$i] }}" required>
												</div>
											</div>
											</div>
										</form>
										</div>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" id="rating" name="rating" class="btn btn-primary">Save changes</button>
									</div>
								</div>
								</div>
							</div>
						@endif
    				</div>
    			</div>
    		</div>
    	</div>
	</div>

	
	
	@endfor
	

	<div class="row mb-5">
    	<div class="col-md-12">
    		<div class="panel panel-default">
				<div class="panel-heading">
    				<h3 class="card-header"><strong>Total</strong><strong class="float-right">Rp {{ number_format($jumlah_seluruh,0,",",".") }}</strong></h3>
    			</div>
    		</div>
    	</div>
	</div>
</div>


<style>

.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}

.star-rating {
  line-height:40px;
  font-size:2.25em;
}

.star-rating .fa-star{color: yellow;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

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

		$star_rating.on('click', function() {
		$star_rating.siblings('input.rating-value').val($(this).data('rating'));
		return SetRatingStar();
		});

		SetRatingStar();
		$(document).ready(function() {

		});
</script>

<script>
	$(document).ready(function(){
		$('#rating').on('click', function() {
			var data = $('#rating_form').serialize();
			$.ajax({
			url:"/jual-beli/rating",
			method:"POST",
			data: data,
			success:function(data)
			{
				swal(
					'Berhasil',
					'Data Berhasil di Tambahkan',
					'success'
				);
				location.reload();

			}
		});

		});
	});

</script>


@endsection