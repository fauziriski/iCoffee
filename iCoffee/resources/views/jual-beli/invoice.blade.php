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
								Sudah Dibayar
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
									<td class="text-center">Rp {{  number_format($orderdetaildata[$i][$j]->harga)  }}</td>
    								<td class="text-center">{{  $orderdetaildata[$i][$j]->jumlah  }}</td>
    								<td class="text-right">Rp {{  number_format($orderdetaildata[$i][$j]->total)  }}</td>
								</tr>
								
								@endfor
                                
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right">Rp {{ number_format($order[$i]->total_bayar) }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
    								<td class="no-line text-right">Rp {{ number_format($kurir[$i][0]) }}</td>
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
						<h2 class="text-right">Rating : <div class="star-rating float-right"><s><s><s><s><s></s></s></s></s></s></div></h2>
								
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
    				<h3 class="card-header"><strong>Total</strong><strong class="float-right">Rp {{ number_format($jumlah_seluruh) }}</strong></h3>
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

.star-rating s:hover {
    color: red;
}
.star-rating s,
.star-rating-rtl s {
    color: black;
    font-size: 50px;
    cursor: default;
    text-decoration: none;
    line-height: 30px;
}
.star-rating {
    padding: 2px;
}
.star-rating-rtl {
    background: #555;
    display: inline-block;
    border: 2px solid #444;
}
.star-rating-rtl s {
    color: yellow;
}
.star-rating s:hover:before{
    content: "\2605";
}
.star-rating s:before {
    content: "\2606";
}
.star-rating-rtl s:hover:after{
    content: "\2605";
}
.star-rating-rtl s:after {
    content: "\2606";
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
	$(function() {
    $("div.star-rating > s, div.star-rating-rtl > s").on("click", function(e) {
        var numStars = $(e.target).parentsUntil("div").length+1;
        console.log(numStars);
    });
});

</script>


@endsection