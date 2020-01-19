@extends('admin.layout.master')

@section('title', 'Admin | Mitra Perorangan')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Mitra Perorangan</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Nama Perorangan</th>
						<th>Jumlah Petani</th>
						<th>Alamat</th>
						<th>Email</th>
						<th>No Hp</th>
						<th>Terdaftar</th>
						<th>Status</th>
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

	<div id="formModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<span id="form_result"></span>
					<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label class="control-label col-md-4" >Nama Kategori : </label>
							<div class="col-md-12">
								<input type="text" name="kategori" id="kategori" class="form-control" />
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

	ajax: '{{ route('admin.mitra-perorangan') }}',

	columns:[

	{data: 'nama_perorangan', name:'nama_perorangan'},
	{data: 'jumlah_petani', name:'jumlah_petani'},
	{data: 'alamat', name:'alamat'},
	{data: 'email', name:'email'},
	{data: 'no_hp', name:'no_hp'},
	{data: 'created_at', name:'created_at'},
	{data: 'status', name:'status'},
	{data: 'action', name: 'action',orderable: false}

	]
});


var user_id;

$(document).on('click', '.delete', function(){
	user_id = $(this).attr('id');
	$('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
	$.ajax({
		url:"hapus-mitra/"+user_id,
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