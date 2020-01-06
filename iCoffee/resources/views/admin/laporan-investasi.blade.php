@extends('admin.layout.master')

@section('title', 'Admin | Laporan Investasi')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Laporan Investasi</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Harga Produk/unit</th>
					<th>Investor</th>
					<th>Jumlah/unit</th>
					<th>Return</th>
					<th>Periode</th>
					<th>Profit</th>
					<th>Payback</th>
					<th>Total</th>
					<th>Ahkir Periode</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 3.913.000</td>
					<td>Mizar</td>
					<td>1</td>
					<td>12%</td>
					<td>1 tahun</td>
					<td>Rp. 469.560</td>
					<td>Rp. 3.913.000</td>
					<td>Rp. 4.382.560</td>
					<td>05 Januari 2020</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
					</tr>

					<tr>
						<td><input type="checkbox" name=""></td>
						<td>Kopi Robusta</td>
						<td>Rp. 4.000.000</td>
						<td>Mizar</td>
						<td>1</td>
						<td>15%</td>
						<td>1 tahun</td>
						<td>Rp. 600.000</td>
						<td>Rp. 4.000.000</td>
						<td>Rp. 4.600.000</td>
						<td>05 Januari 2020</td>
						<td>
							<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						</tr>

						<tr>
							<td><input type="checkbox" name=""></td>
							<td>Kopi Arabika</td>
							<td>Rp. 5.000.000</td>
							<td>Toni</td>
							<td>1</td>
							<td>15%</td>
							<td>1 tahun</td>
							<td>Rp. 750.000</td>
							<td>Rp. 5.000.000</td>
							<td>Rp. 5.750.000</td>
							<td>05 Januari 2020</td>
							<td>
								<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
							</tr>

						</tbody>
					</table>
			</div>
		</div>

		@endsection