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
		
		<table id="table_id" class="table table-striped table-bordered" style="width:100%">
			<thead>
				<tr>
					<th>Nama Pengguna</th>
					<th>Email Pengguna</th>
					<th>Begabung</th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

@endsection
@section('footer_scripts')
<script>
	$(document).ready( function () {
		$('#table_id').DataTable({
			processing:true,
			serverside:true,
			ajax: "{{route('get.data.siswa')}}",

			columns: [

			{data: 'name', name: 'name'},

			{data:'email', name:'email'},

			{data:'created_at', name:'created_at'},

			],

		} );
	</script>
	@stop