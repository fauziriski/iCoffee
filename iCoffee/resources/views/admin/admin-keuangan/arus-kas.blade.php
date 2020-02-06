@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Arus Kas')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<div class="card">

			<div class="card-header float-center"><h5>Laporan Arus Kas</h5></div>
			<div class="container">
				<div class="card-body mt-3">
					<div class="table-responsive">
						<table cellpadding="10" class="table" border="0" style="width:100%">

							<tr>
								<th width="1%"></th>
								<th width="60%">Keterangan</th>
								<th width="30%">Jumlah Total</th>
							</tr>

							<tr>
								<td><strong>A. </strong></td>
								<td><strong>ARUS KAS DARI AKTIVITAS OPERASI</strong></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Operasi</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jual printer</td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td></td>
								<td><strong>KAS BERSIH YANG DIHASILKAN UNTUK AKTIVITAS OPERASI :</strong></td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Operasi</td>
								<td></td>
							</tr>
							@foreach($AKKA as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_tran}}</td>
								<td>@money($key->total_jumlah)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>KAS BERSIH YANG DIGUNAKAN UNTUK AKTIVITAS OPERASI :</strong></td>
								<td>@money($total)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td><strong>B. </strong></td>
								<td><strong>ARUS KAS DARI AKTIVITAS JUAL/BELI</strong></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Jual/Beli</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rek. BNI pembeli TN. A</td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td></td>
								<td><strong>KAS BERSIH YANG DIHASILKAN UNTUK AKTIVITAS JUAL/BELI :</strong></td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Jual/Beli</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rek. BRI penjual TN B</td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td></td>
								<td><strong>KAS BERSIH YANG DIGUNAKAN UNTUK AKTIVITAS JUAL/BELI :</strong></td>
								<td>Rp. 2005000</td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection



