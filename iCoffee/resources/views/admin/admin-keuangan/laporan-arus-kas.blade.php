@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Laporan Arus Kas')

@section('content')

<body id="page-top">
	<div class="container-fluid">

		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h5>Laporan Arus Kas</h5>
				<div class="dropdown no-arrow">			
					<button class="btn btn-success btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-filter"></i> Pencarian Tanggal</button>		
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"  style="width: 200%;">
						<div class="container">
							<p class="mt-2"><strong>Tanggal Awal</strong></p>
							<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" />
							<p class="mt-2"><strong>Tanggal Ahkir</strong></p>
							<input type="text" name="to_date" id="to_date" class="form-control" placeholder="MM/DD/YYYY" />
							<input type="submit" name="filter" id="filter" class="btn btn-primary mt-3" value="Tampilkan" />
						</div>
					</div>
				</div>
			</div>

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
							@foreach($akun as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key['nama_akun']}}</td>
									<td>@money($key['total_jumlah'])</td>
								</tr>
								@endforeach
                                <tr>
                                <td><strong>TOTAL KAS MASUK DARI AKTIVITAS INVESTASI :</strong></td>
									<td>@money($total_jumlah)</td>
								</tr>
							
                            @endsection