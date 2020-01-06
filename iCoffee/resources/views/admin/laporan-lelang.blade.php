@extends('admin.layout.master')

@section('title', 'Admin | Laporan Lelang')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Laporan Lelang</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Harga Terjual</th>
					<th>Satuan Terjual (kg)</th>
					<th>Harga Tertinggi</th>
					<th>Waktu Selesai</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Rp. 100.000</td>
					<td>1 Kg</td>
					<td>Rp. 90.000</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
					</tr>

					<tr>
						<td><input type="checkbox" name=""></td>
						<td>Kopi Robusta</td>
						<td>Rp. 200.000</td>
						<td>2 Kg</td>
						<td>Rp. 90.000</td>
						<td>Sabtu, 06 Januari 2020 07:38</td>
						<td>
							<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
						</tr>

						<tr>
							<td><input type="checkbox" name=""></td>
							<td>Kopi Arabika</td>
							<td>Rp. 300.000</td>
							<td>3 Kg</td>
							<td>Rp. 280.000</td>
							<td>Sabtu, 02 Januari 2020 07:38</td>
							<td>
								<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
							</tr>

							<tr>
								<td><input type="checkbox" name=""></td>
								<td>Kopi Robusta</td>
								<td>Rp. 100.000</td>
								<td>1 Kg</td>
								<td>Rp. 90.000</td>
								<td>Sabtu, 03 Januari 2020 07:38</td>
								<td>
									<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
								</tr>

								<tr>
									<td><input type="checkbox" name=""></td>
									<td>Kopi Robusta</td>
									<td>Rp. 100.000</td>
									<td>1 Kg</td>
									<td>Rp. 90.000</td>
									<td>Sabtu, 04 Januari 2020 07:38</td>
									<td>
										<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
									</tr>

									<tr>
										<td><input type="checkbox" name=""></td>
										<td>Kopi Robusta</td>
										<td>Rp. 100.000</td>
										<td>1 Kg</td>
										<td>Rp. 95.000</td>
										<td>Sabtu, 05 Januari 2020 07:38</td>
										<td>
											<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						@endsection