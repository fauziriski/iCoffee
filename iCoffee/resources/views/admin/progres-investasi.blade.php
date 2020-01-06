@extends('admin.layout.master')

@section('title', 'Admin | Progres Investasi')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Progres Investasi</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Produk</th>
					<th>Nama Investor</th>
					<th>Kelompok Tani</th>
					<th>Kegiatan</th>
					<th>Update</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Arabika</td>
					<td>Mizar</td>
					<td>PT. Kopi Squad</td>
					<td>Pembibitan biji</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat Selengkapnya</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Toni</td>
					<td>PT. Kopi Squad</td>
					<td>Pemberian Pupuk</td>
					<td>Minggu, 05 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat Selengkapnya</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Arabika</td>
					<td>Fauzi</td>
					<td>PT. Kopi Squad</td>
					<td>Perawatan tanaman</td>
					<td>Sabtu, 04 Januari 2020 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat Selengkapnya</a>
					</tr>

					<tr>
					<td><input type="checkbox" name=""></td>
					<td>Kopi Robusta</td>
					<td>Mizar</td>
					<td>PT. Kopi Squad</td>
					<td>Panen</td>
					<td>Sabtu, 04 Januari 2021 07:38</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat Selengkapnya</a>
					</tr>

					</tbody>
				</table>
			</div>
		</div>

		@endsection