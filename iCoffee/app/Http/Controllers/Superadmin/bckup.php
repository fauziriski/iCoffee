@extends('admin.layout.master')

@section('title', 'Admin | Mitra Koperasi')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Mitra Koperasi</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Nama Koperasi</th>
						<th>Jumlah Petani</th>
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
						<div class="form-group">
							<label class="control-label col-md-4" >Foto : </label>
							<div class="col-md-12">
								<c id="store_image"></c>
							</div>
							<label class="control-label col-md-4" >Nama Koperasi : </label>
							<div class="col-md-12">
								<input type="text" id="nama_koperasi" class="form-control" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Deskripsi : </label>
							<div class="col-md-12">
								<textarea type="text" id="deskripsi" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Alamat : </label>
							<div class="col-md-12">
								<textarea type="text" id="alamat" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<label>AD atau ART &nbsp;&nbsp;&nbsp;&nbsp;: </label>
							<span id="satu"></span>
						</div>
						<div class="col-md-6">
							<label>AKTE Koperasi &nbsp;: </label>
							<span id="dua"></span>
						</div>
						<div class="col-md-6">
							<label>KTP Pengurus &nbsp;&nbsp;: </label>
							<span id="tiga"></span>
						</div>			
						<br />
						<div class="modal-footer">
							<input type="hidden" name="id_mitra" id="id_mitra" />
							<input type="hidden" name="email" id="email" />
							<input type="hidden" name="nama_koperasi" id="nama_koperasi" />
							<input type="hidden" name="deskripsi" id="deskripsi" />
							<input type="hidden" name="alamat" id="alamat" />
							<input type="hidden" name="jumlah_petani" id="jumlah_petani" />
							<input type="hidden" name="gambar" id="gambar" />
							<input type="hidden" name="no_hp" id="no_hp" />
							<input type="hidden" name="action" id="action" />
							<input type="hidden" name="hidden_id" id="hidden_id" />
							<input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Validasi" />
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 align="center" style="margin:0;">Apakah anda yakin ingin menghapus?</h5>
				</div>
				<div class="modal-footer">
					<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Tolak</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>

	@endsection
	@section('js')


	<script>
		$(document).ready(function(){
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

				ajax: '{{ route('admin.mitra-koperasi') }}',

				columns:[

				{data: 'nama_koperasi', name:'nama_koperasi'},
				{data: 'jumlah_petani', name:'jumlah_petani'},
				{data: 'email', name:'email'},
				{data: 'no_hp', name:'no_hp'},
				{data: 'created_at', name:'created_at'},
				{data: 'status', name:'status'},
				{data: 'action', name: 'action',orderable: false},
				{data: 'deskripsi', name:'deskripsi', visible: false},
				{data: 'alamat', name:'alamat', visible: false},
				{data: 'gambar', name:'gambar', visible: false},
				{data: 'ad_art', name:'ad_art', visible: false},
				{data: 'akte', name:'akte', visible: false},
				{data: 'ktp_pengurus', name:'ktp_pengurus', visible: false},
				{data: 'id_mitra', name:'id_mitra', visible: false}

				]
			});

			$(document).on('click', '.lihat', function(){
				var id = $(this).attr('id');
				$('#form_result').html('');
				$.ajax({
					url:"validasi-koperasi/"+id,
					dataType:"json",
					success:function(html){
						$('#hidden_id').val(html.data.id);
						$('#id_mitra').val(html.data.id_mitra);
						$('#email').val(html.data.email);
						$('#nama_koperasi').val(html.data.nama_koperasi);
						$('#deskripsi').val(html.data.deskripsi);
						$('#alamat').val(html.data.alamat);
						$('#jumlah_petani').val(html.data.jumlah_petani);
						$('#gambar').val(html.data.gambar);
						$('#no_hp').val(html.data.no_hp);
						$('#store_image').html("<img src={{ URL::to('/') }}/Uploads/Mitra_Koperasi/{" + html.data.nama_koperasi  +"}/"+ html.data.gambar +" width='200' height='200' class='img-thumbnail' />");
						$('#satu').html("<a href={{ URL::to('/') }}/Uploads/Mitra_Koperasi/{" + html.data.nama_koperasi  +"}/"+ html.data.ad_art +" target='_blank'>&nbsp;lihat</a>");
						$('#dua').html("<a href={{ URL::to('/') }}/Uploads/Mitra_Koperasi/{" + html.data.nama_koperasi  +"}/"+ html.data.akte +" target='_blank'>&nbsp;lihat</a>");
						$('#tiga').html("<a href={{ URL::to('/') }}/Uploads/Mitra_Koperasi/{" + html.data.nama_koperasi  +"}/"+ html.data.ktp_pengurus +" target='_blank'>&nbsp;lihat</a>");
						$('#action_button').val("Validasi");
						$('#action').val("Validasi");
						$('#formModal').modal('show');
						

					}
				})
			});

			// $('#sample_form').on('submit', function(event){
			// 	event.preventDefault();
			// 	if($('#action').val() == 'Validasi')
			// 	{
			// 		$.ajax({
			// 			url:"{{ route('admin.validasi-petani.update') }}",
			// 			method:"POST",
			// 			data: new FormData(this),
			// 			contentType: false,
			// 			cache:false,
			// 			processData: false,
			// 			dataType:"json",
			// 			success:function(data)
			// 			{
			// 				var html = '';
			// 				if(data.errors)
			// 				{
			// 					html = '<div class="alert alert-danger">';
			// 					for(var count = 0; count < data.errors.length; count++)
			// 					{
			// 						html += '<p>' + data.errors[count] + '</p>';
			// 					}
			// 					html += '</div>';
			// 				}
			// 				if(data.success)
			// 				{
			// 					html = '<div class="alert alert-success">' + data.success + '</div>';
			// 					$('#sample_form')[0].reset();
			// 					$('#table_id').DataTable().ajax.reload();
			// 				}
			// 				$('#form_result').html(html);
			// 			}
			// 		});
			// 	}
			// });

			var mitra_id;

			$(document).on('click', '.tolak', function(){
				mitra_id = $(this).attr('id');
				$('#confirmModal').modal('show');
			});

			$('#ok_button').click(function(){
				$.ajax({
					url:"tolak-mitra/"+mitra_id,
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


	<div id="modalTolak" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<span id="form_tolak"></span>
					<form method="post" id="sample_form_tolak" class="form-horizontal" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="status" value="di tolak" />
						<input type="hidden" name="hidden_id" id="hidden_id" />
						<h5 align="center" style="margin:0;">Apakah anda yakin ingin tolak?</h5>
						<div class="modal-footer">
							<input type="hidden" name="action" id="action" />
							<input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Tolak" />
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>