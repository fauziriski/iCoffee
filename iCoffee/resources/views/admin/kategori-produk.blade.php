@extends('admin.layout.master')

@section('title', 'Admin | Kategori Produk')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Kategori Produk</h1>
		</div>
		<div class="panel-body">
			<div align="right">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm mb-3"><i class="fa fa-plus-square"></i> Tambah Kategori</button>
			</div>

			<table id="kategori_table" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Nama Kategori</th>
						<th>Update</th>
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
					<h5 class="modal-title">Tambah Kategori</h5>
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


	<div id="confirmModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Konfirmasi</h4>
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
</div>
@endsection
@section('js')


<script>
	$(document).ready(function(){

		$('#kategori_table').DataTable({
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
			ajax:{
				url: "{{ route('admin.kategori-produk') }}",
				dataType:"json",
			},
			columns:[

			{data: 'kategori', name: 'kategori'},

			{data: 'updated_at', name:'updated_at'},

			{data: 'action',name: 'action',orderable: false}
			]
		});

		$('#create_record').click(function(){
			$('.modal-title').text("Tambah Kategori");
			$('#action_button').val("Tambah");
			$('#action').val("Tambah");
			$('#formModal').modal('show');
		});

		$(document).on('click', '.edit', function(){
			var id = $(this).attr('id');
			$('#form_result').html('');
			$.ajax({
				url:"edit-kategori/"+id,
				dataType:"json",
				success:function(html){
					$('#kategori').val(html.data.kategori);
					$('#hidden_id').val(html.data.id);
					$('.modal-title').text("Edit Kategori");
					$('#action_button').val("Edit");
					$('#action').val("Edit");
					$('#formModal').modal('show');
				}
			})
		});

		$('#sample_form').on('submit', function(event){
			event.preventDefault();
			if($('#action').val() == 'Tambah')
			{
				$.ajax({
					url:"{{ route('admin.kategori-produk.store') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						var html = '';
						if(data.errors)
						{
							html = '<div class="alert alert-danger">';
							for(var count = 0; count < data.errors.length; count++)
							{
								html += '<p>' + data.errors[count] + '</p>';
							}
							html += '</div>';
						}
						if(data.success)
						{
							html = '<div class="alert alert-success">' + data.success + '</div>';
							$('#sample_form')[0].reset();
							$('#kategori_table').DataTable().ajax.reload();
						}
						$('#form_result').html(html);
					}
				})
			}

			if($('#action').val() == "Edit")
			{
				$.ajax({
					url:"{{ route('admin.kategori-produk.update') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						var html = '';
						if(data.errors)
						{
							html = '<div class="alert alert-danger">';
							for(var count = 0; count < data.errors.length; count++)
							{
								html += '<p>' + data.errors[count] + '</p>';
							}
							html += '</div>';
						}
						if(data.success)
						{
							html = '<div class="alert alert-success">' + data.success + '</div>';
							$('#sample_form')[0].reset();
							$('#kategori_table').DataTable().ajax.reload();
						}
						$('#form_result').html(html);
					}
				});
			}
		});


		var mitra_id;
		$(document).on('click', '.delete', function(){
			mitra_id = $(this).attr('id');
			$('#confirmModal').modal('show');
		});

		$('#ok_button').click(function(){
			$.ajax({
				url:"hapus-kategori/"+mitra_id,
				success:function(data)
				{
					setTimeout(function(){
						$('#confirmModal').modal('hide');
						$('#kategori_table').DataTable().ajax.reload();
					}, 500);
				}
			})
		});

	});

</script>
@stop

