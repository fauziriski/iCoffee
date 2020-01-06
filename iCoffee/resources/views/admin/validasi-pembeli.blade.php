@extends('admin.layout.master')

@section('title', 'Admin | Validasi Pembeli')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Validasi Pembeli</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Satuan Produk (Kg)</th>
					<th>Total Harga</th>
					<th>Nama Pembeli</th>
					<th>Waktu Tranksaksi</th>
					<th>Status Produk</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>1 Kg</td>
					<td>Rp. 100.000</td>
					<td>Mizar</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>belum dikirim</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Terima</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>

					<tr>
						<td><input type="checkbox" name=""></td>
						<td>Kopi Arabika</td>
						<td>3 Kg</td>
						<td>Rp. 300.000</td>
						<td>Toni</td>
						<td>Minggu, 05 Januari 2020 09:38</td>
						<td>dikirim</td>
						<td>
							<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
							<a href="" class="btn btn-success disabled"><i class="fas fa-check fa-sm text-white-50"></i> Terkirim</a>
						</tr>

					</tbody>
				</table>
			</div>
		</div>

		@endsection