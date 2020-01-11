@extends('admin.layout.master')

@section('title', 'Super Admin | Data Customer')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<table id="example" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th><input type="checkbox" onclick="checkAll(this)"></th>
					<th>Nama Pengguna</th>
					<th>Email Pengguna</th>
					<th>No. Telp</th>
					<th>Begabung</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user as $keluar)
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>{{$keluar->name}}</td>
					<td>{{$keluar->email}}</td>
					<td>0895165901662</td>
					<td>{{$keluar->created_at}}</td>
					<td>
						<a href="" class="btn btn-primary"><i class="fas fa-eye fa-sm text-white-50"></i> Edit</a>
						<a href="" class="btn btn-danger"><i class="fas fa-times fa-sm text-white-50"></i> Hapus</a>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	@endsection