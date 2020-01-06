@extends('admin.layout.master')

@section('title', 'Admin | Validasi Produk Lelang')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Validasi Produk Lelang</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Nama Penjual</th>
					<th>Satuan Produk</th>
					<th>No. Resi</th>
					<th>Status Produk</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>terkirim</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-success disabled"><i class="fas fa-check fa-sm text-white-50"></i> Terpasang</a>
					</tr>
					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>proses pengiriman</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Pasang</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>
					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>proses pengiriman</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Pasang</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>
					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>proses pengiriman</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Pasang</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>
					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>proses pengiriman</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Pasang</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>
					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>20 kg</td>
					<td>000148003628</td>
					<td>proses pengiriman</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-primary"><i class="fas fa-check fa-sm text-white-50"></i> Pasang</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a></td>
					</tr>

					</tbody>
				</table>
			</div>
		</div>

		@endsection