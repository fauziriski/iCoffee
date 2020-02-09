@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
@section('sidebar')
@endsection
@section('content')


<div class="container mt-5">
	<div class="invoice-title">
		<h3>Invoice</h3><h3 class="pull-right">Order #{{ $order->invoice }}</h3>
	</div>
	
    <div class="row mb-2">
        <div class="col-md-12">	
    		<hr>
    		<div class="row">
    			<div class="col-md-3 col-6">
    				<address>
					<strong>Pengirim :</strong><br>
						
						{{ $order->addresses_penjual->nama }}<br>
						{{ $order->addresses_penjual->address }},
						{{ $order->addresses_penjual->kecamatan }},
						{{ $order->addresses_penjual->city->nama }},
    					{{ $order->addresses_penjual->province->nama }}, 			
						{{ $order->addresses_penjual->kode_pos }}
    				</address>
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
        			<strong>Penerima :</strong><br>
						{{ $order->addresses_pembeli->nama }}<br>
						{{ $order->addresses_pembeli->address }},
						{{ $order->addresses_pembeli->kecamatan }},
						{{ $order->addresses_pembeli->city->nama }},
						{{ $order->addresses_pembeli->province->nama }}, 			
						{{ $order->addresses_pembeli->kode_pos }}
    				</address>
    			</div>
    		   		
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Metode Pembayaran :</strong><br>
    					{{ $bank_information->bank_name }} {{ $bank_information->no_rekening }}<br>

					</address>
					
					@if (!($order->status == 1 || 2 || 8 || 3))
						<address>
							<strong>No Resi :</strong><br>
						{{$kurir[1]}} {{ $cek_resi->invoice }}<br>

						</address>
					@else
					<address>
						<strong>No Resi :</strong><br>
							

					</address>

					
					@endif
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Status :</strong><br>
						@if ( $order->status == 1)
							<div class="alert alert-warning" role="alert">
								Belum Dibayar
							</div>		  
						@elseif( $order->status == 2)
							<div class="alert alert-info" role="alert">
								Sudah Dibayar
							</div>

						@elseif( $order->status == 3)
							<div class="alert alert-info" role="alert">
								Di Serahkan ke Penjual
							</div>
						@elseif( $order->status == 4)
							<div class="alert alert-info" role="alert">
								Penjual Menerima dan Barang di Proses
							</div>
						@elseif( $order->status == 5)
							<div class="alert alert-info" role="alert">
								Barang Dikirim
							</div>
						@elseif( $order->status == 6)
							<div class="alert alert-success" role="alert">
								Selesai
							</div>
						@elseif( $order->status == 7)
							<div class="alert alert-info" role="alert">
								komplain
							</div>
						@elseif( $order->status == 8)
							<div class="alert alert-info" role="alert">
								Pembayaran Sedang di Proses
							</div>
						@elseif( $order->status == 9)
							<div class="alert alert-danger" role="alert">
								Pembelian dibatalkan
							</div>
						
						@elseif( $order->status == 10)
							<div class="alert alert-info" role="alert">
								Komplain dibatalkan
							</div>

						@elseif( $order->status == 11)
							<div class="alert alert-info" role="alert">
								Komplain diterima
							</div>

						@elseif( $order->status == 0)
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
        							<td class="text-center"><strong>Harga Awal</strong></td>
        							<td class="text-center"><strong>Jumlah</strong></td>
        							<td class="text-center"><strong>Tawaran Anda</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                                    
                                
    							<tr>
									<td>{{ $order->auction_products->nama_produk }}</td>
									<td class="text-center">Rp {{  number_format($order->tawaran_awal)  }}</td>
    								<td class="text-center">{{  $order->jumlah  }}</td>
    								<td class="text-right">Rp {{  number_format($order->sub_total)  }}</td>
								</tr>
								
                                
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
									<td class="thick-line text-right">Rp {{ number_format($order->sub_total) }}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
    								<td class="no-line text-right">Rp {{ number_format($kurir[0]) }}</td>
    							</tr>

    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
	</div>
	
	

	<div class="row mb-5">
    	<div class="col-md-12">
    		<div class="panel panel-default">
				<div class="panel-heading">
    				<h3 class="card-header"><strong>Total</strong><strong class="float-right">Rp {{ number_format($order->total_bayar) }}</strong></h3>
                </div>
                <div class="panel-body mt-3 float-right">
					@if ( $order->status == 5)
						<form action="/lelang/pesanan/selesai" method="post">
							@csrf
							<input type="hidden" name="id" required value="{{ $order->id }}">
                            <input type="hidden" name="invoice" required value="{{ $order->invoice }}">
                            <input type="hidden" name="jumlah_seluruh" required value="{{ $order->total_bayar }}">
							<p><input type="submit" class="btn btn-secondary  py-3 px-5" name="submit" value="Komplain">
								<input type="submit" class="btn btn-primary py-3 px-5" name="submit" value="Diterima">
						</p>
						</form>
					@endif
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

</style>


@endsection