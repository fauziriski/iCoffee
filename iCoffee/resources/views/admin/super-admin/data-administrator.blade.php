@extends('admin.layout.master')

@section('title', 'Super Admin | Data Admin')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Administrator</h1>
		</div>
			<div class="panel-body">
			<div align="right">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus-square"></i> Tambah Kategori</button>
			</div>
		
		<div class="table-responsive">
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
</div>


<div id="confirmModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
			</div>
			<div class="modal-body">
				<h5 align="center" style="margin:0;">Apakah anda yakin ingin menghapus?</h5>
			</div>
			<div class="modal-footer">
				<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

	oLanguage: {
		"sProcessing":   "Sedang memproses ...",
		"sLengthMenu":   "Tampilkan _MENU_ entri",
		"sZeroRecords":  "Tidak ditemukan data yang sesuai",
		"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
		"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
		"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
		"sInfoPostFix":  "",
		"sSearch":       "Cari:",
		"sUrl":          "",
		"oPaginate": {
			"sFirst":    "Pertama",
			"sPrevious": "Sebelumnya",
			"sNext":     "Selanjutnya",
			"sLast":     "Terakhir"
		}
	},
	

	processing: true,
	serverSide: true,

	ajax: '{{ route('superadmin.data-admin') }}',

	columns:[

	{data: 'name', name: 'name'},

	{data: 'email', name:'email'},

	{data: 'created_at', name:'created_at'},

	{data: 'action',name: 'action',orderable: false}
	]
});


var user_id;

$(document).on('click', '.delete', function(){
	user_id = $(this).attr('id');
	$('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
	$.ajax({
		url:"hapus-pengguna/"+user_id,
		success:function()
		{
			setTimeout(function(){
				$('#confirmModal').modal('hide');
				$('#table_id').DataTable().ajax.reload();
			}, 500);
		}
	})
});

});

</script>
@stop