@extends('admin.layout.master')

@section('title', 'Admin | Proses Lelang')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proses Lelang</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Harga Produk</th>
					<th>Satuan Produk (Kg)</th>
					<th>Waktu Lelang</th>
					<th>Jumlah Penawar</th>
					<th>Harga Tertinggi</th>
					<th>Harga Terendah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td><div id="demo1"></div></td>
					<td>1</td>
					<td>Rp. 75.000</td>
					<td>Rp. 75.000</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Batalkan</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td><div id="demo2"></div></td>
					<td>3</td>
					<td>Rp. 75.000</td>
					<td>Rp. 50.000</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Batalkan</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Arabika</td>
					<td>Rp. 200.000</td>
					<td>2 Kg</td>
					<td><div id="demo3"></div></td>
					<td>2</td>
					<td>Rp. 175.000</td>
					<td>Rp. 150.000</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Batalkan</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td><div id="demo4"></div></td>
					<td>3</td>
					<td>Rp. 75.000</td>
					<td>Rp. 50.000</td>
					<td>
						<a href="" class="btn btn-success"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat Pemenang</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td>selesai</div></td>
					<td>3</td>
					<td>Rp. 75.000</td>
					<td>Rp. 50.000</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Batalkan</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td><div id="demo6"></div></td>
					<td>3</td>
					<td>Rp. 75.000</td>
					<td>Rp. 50.000</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Batalkan</a>
					</tr>

					
				</tbody>
			</table>
		</div>
	</div>


	@endsection