@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
@section('sidebar')
@endsection
@section('content')


<div class="container mt-5">
	<div class="invoice-title">
		<h3>Invoice</h3><h3 class="pull-right">Order # {{ $order->invoice }}</h3>
	</div>
	@for ($i = 0; $i < $jumlah_pelanggan; $i++)
	
    <div class="row mb-2">
        <div class="col-md-12">	
    		<hr>
    		<div class="row">
    			<div class="col-md-3 col-6">
    				<address>
					<strong>Pengirim :</strong><br>
						
						{{ $alamat_penjual[$i][0]->nama }}<br>
						{{ $alamat_penjual[$i][0]->address }},
						{{ $alamat_penjual[$i][0]->kecamatan }},
						{{ $alamat_penjual[$i][0]->city->nama }},
    					{{ $alamat_penjual[$i][0]->province->nama }}, 			
						{{ $alamat_penjual[$i][0]->kode_pos }}
    				</address>
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
        			<strong>Penerima :</strong><br>
						{{ $alamat_pembeli->nama }}<br>
						{{ $alamat_pembeli->address }},
						{{ $alamat_pembeli->kecamatan }},
						{{ $alamat_pembeli->city->nama }},
						{{ $alamat_pembeli->province->nama }}, 			
						{{ $alamat_pembeli->kode_pos }}
    				</address>
    			</div>
    		   		
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Metode Pembayaran :</strong><br>
    					{{ $rekening->bank_name }} {{ $rekening->no_rekening }}<br>

    				</address>
    			</div>
    			<div class="col-md-3 col-6">
    				<address>
    					<strong>Tanggal Order :</strong><br>
						{{ $order->created_at}}<br>
						
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
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<tr>
    								<td>BS-200</td>
									<td class="text-center"></td>
    								<td class="text-center">1</td>
    								<td class="text-right">$10.99</td>
    							</tr>
                                
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$670.99</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
    								<td class="no-line text-right">$15</td>
    							</tr>

    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
	</div>
	
	@endfor
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