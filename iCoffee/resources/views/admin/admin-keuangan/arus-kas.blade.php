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
						<table cellpadding="5" border="0" style="width: 100%;">
							<tr cellpadding="1">
								<th colspan="3" style="text-align: center;">
									<h5>PT. ICOFFEE</h5>
								</th>
							</tr>
							<tr>
								<th colspan="3" style="text-align: center;">
									<h5><strong>Laporan Arus Kas</strong></h5>
								</th>
							</tr>
							<tr>
								<th colspan="3" style="text-align: center;">
									<h5>Periode 02 February 2020 s.d 29 February 2020</h5>
								</th>
							</tr>
						</table>
						<table cellpadding="10" class="table mt-5" border="0" style="width:100%">
							<tr>
								<td><strong>A. </strong></td>
								<td><strong>ARUS KAS DARI AKTIVITAS OPERASIONAL</strong></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Operasional :</td>
								<td></td>
							</tr>
							@foreach($ambil6 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS MASUK DARI AKTIVITAS OPERASIONAL :</strong></td>
								<td>@money($total6)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Operasional :</td>
								<td></td>
							</tr>
							@foreach($ambil1 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS OPERASIONAL :</strong></td>
								<td>@money($total1)</td>
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
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Jual/Beli :</td>
								<td></td>
							</tr>
							@foreach($ambil7 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS MASUK DARI AKTIVITAS JUAL/BELI :</strong></td>
								<td>@money($total7)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Jual/Beli :</td>
								<td></td>
							</tr>
							@foreach($ambil2 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS JUAL/BELI :</strong></td>
								<td>@money($total2)</td>
							</tr>
							<tr>
								<tr>
									<td colspan="3"></td>
								</tr>

								<tr>
									<td><strong>C. </strong></td>
									<td><strong>ARUS KAS DARI AKTIVITAS LELANG</strong></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1.&nbsp;&nbsp; Arus Kas Masuk - Lelang :</td>
									<td></td>
								</tr>
								@foreach($ambil8 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS MASUK DARI AKTIVITAS LELANG :</strong></td>
									<td>@money($total8)</td>
								</tr>
								<tr rowspan="2">
									<td colspan="3"></td>
								</tr>
								<tr>
									<td></td>
									<td>2.&nbsp;&nbsp; Arus Kas Keluar - Lelang :</td>
									<td></td>
								</tr>
								@foreach($ambil3 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS LELANG :</strong></td>
									<td>@money($total3)</td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>

								<tr>
									<td><strong>D. </strong></td>
									<td><strong>ARUS KAS DARI AKTIVITAS INVESTASI</strong></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1.&nbsp;&nbsp; Arus Kas Masuk - Investasi :</td>
									<td></td>
								</tr>
								@foreach($ambil9 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS MASUK DARI AKTIVITAS INVESTASI :</strong></td>
									<td>@money($total9)</td>
								</tr>
								<tr rowspan="2">
									<td colspan="3"></td>
								</tr>
								<tr>
									<td></td>
									<td>2.&nbsp;&nbsp; Arus Kas Keluar - Investasi :</td>
									<td></td>
								</tr>
								@foreach($ambil4 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS INVESTASI :</strong></td>
									<td>@money($total4)</td>
								</tr>
								<tr>
									<td colspan="3"></td>
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



