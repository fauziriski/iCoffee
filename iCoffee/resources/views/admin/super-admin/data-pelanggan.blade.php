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
					<th>Aksi</th>
				</tr>
			</thead>
		</table>
	</div>
</div>


<div id="formModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Data Pelanggan</h4>
			</div>
			<div class="modal-body">
				<span id="form_result"></span>
				<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label class="control-label col-md-4" >Nama : </label>
						<div class="col-md-8">
							<input type="text" name="name" id="name" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4">Email : </label>
						<div class="col-md-8">
							<input type="email" name="email" id="email" class="form-control" />
						</div>
					</div>
					<br />
					<div class="form-group" align="center">
						<input type="hidden" name="action" id="action" />
						<input type="hidden" name="hidden_id" id="hidden_id" />
						<input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Tambah" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('js')


<script>
	$(document).ready(function(){
//read
$('#table_id').DataTable({
	processing: true,
	serverSide: true,
	ajax: '{{ route('data-pelanggan') }}',

	columns:[

	{data: 'name', name: 'name'},

	{data: 'email', name:'email'},

	{data: 'created_at', name:'created_at'},

	{data: 'action',name: 'action',orderable: false}
	]
});


//modal edit

$('#create_record').click(function(){
	$('.modal-title').text("Edit Data Pelanggan");
	$('#action_button').val("Edit");
	$('#action').val("Edit");
	$('#formModal').modal('show');
});

$(document).on('click', '.edit', function(){
	var id = $(this).attr('id');
	$('#form_result').html('');
	$.ajax({
		url:"user/"+id+"/edit",
		dataType:"json",
		success:function(html){
			$('#nama').val(html.data.name);
			$('#deskripsi').val(html.data.email);
			$('#hidden_id').val(html.data.id);
			$('.modal-title').text("Ubah Data");
			$('#action_button').val("Ubah");
			$('#action').val("Ubah");
			$('#formModal').modal('show');
		}
	})
});
});
</script>
@stop