@extends('admin.layout.master')

@section('title', 'Admin | Kelompok Petani')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Kelompok Petani</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Kelompok Tani</th>
					<th>Jumlah Pekerja</th>
					<th>Jumlah Kelola</th>
					<th>Jenis Kopi</th>
					<th>Alamat</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>PT. Kopi Squad</td>
					<td>10</td>
					<td>21 dikelola</td>
					<td>Kopi robusta, arabika</td>
					<td>Lampung</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-info"><i class="fas fa-check fa-sm text-white-50"></i> Validasi</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Tolak</a>
					</tr>

					<tr>
						<td><input type="checkbox" name=""></td>
						<td>PT. Kopi Robusta</td>
						<td>11</td>
						<td>42 dikelola</td>
						<td>Kopi robusta</td>
						<td>Lampung</td>
						<td>
							<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
							<a href="" class="btn btn-info disabled">Sudah Validasi <i class="fas fa-check fa-sm text-white-50"></i></a>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		@endsection