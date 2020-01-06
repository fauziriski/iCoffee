@extends('admin.layout.master')

@section('title', 'Admin | Produk Investasi')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Produk Investasi</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Harga Produk/unit</th>
					<th>Return/tahun</th>
					<th>Periode Hasil</th>
					<th>Update</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Pembenihan Kopi Arabika</td>
					<td>Rp. 5.000.000</td>
					<td>15%</td>
					<td>1 Tahun</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-check fa-sm text-white-50"></i> Hapus</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Pembenihan Kopi Robusta</td>
					<td>Rp. 6.000.000</td>
					<td>20%</td>
					<td>1 tahun</td>
					<td>Minggu, 05 Januari 2020 09:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-check fa-sm text-white-50"></i> Hapus</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Pembenihan Kopi Arabika</td>
					<td>Rp. 5.000.000</td>
					<td>15%</td>
					<td>1 tahun</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-check fa-sm text-white-50"></i> Hapus</a>
					</tr>

					</tbody>
				</table>
			</div>
		</div>

		@endsection