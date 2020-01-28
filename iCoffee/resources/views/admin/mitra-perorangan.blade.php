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
						<th>Email</th>
						<th>No Hp</th>
						<th>Terdaftar</th>
						<th>Status</th>
						<th></th>

					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="modalVerifikasi" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Konfirmasi</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<span id="form_konfirmasi"></span>
				<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="password" id="password2" value="password" />
					<input type="hidden" name="status" id="status2" value="divalidasi" />
					<input type="hidden" name="hidden_id" id="hidden_id2" />
					<input type="hidden" name="action" id="action2" />
					<input type="hidden" name="id_mitra" id="id_mitra2" />
					<input type="hidden" name="email" id="email2" />
					<input type="hidden" name="nama_koperasi" id="nama_koperasi2" />
					<input type="hidden" name="deskripsi" id="deskripsi2" />
					<input type="hidden" name="alamat" id="alamat2" />
					<input type="hidden" name="jumlah_petani" id="jumlah_petani2" />
					<input type="hidden" name="gambar" id="gambar2" />
					<input type="hidden" name="no_hp" id="no_hp2" />
					<input type="hidden" name="kode" id="kode" />
					<div class="text">
						<h5 class="mt-3" align="center" style="margin:0;">Apakah anda yakin ingin validasi?</h5>
						<div class="mt-5"></div>
					</div>
					<div align="right">
						<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Validasi" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div id="modalPesan" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Kirim Pesan</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<span id="form_pesan"></span>
				<form method="post" id="sample_form_pesan" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="hidden_id" id="hidden_id" />
					<input type="hidden" name="action" id="action" />
					<div class="form-group">
						<label class="control-label col-md-4" >Kepada : </label>
						<div class="col-md-12">
							<input type="text" id="email3" name="email" class="form-control" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4" >Pesan : </label>
						<div class="col-md-12">
							<textarea type="text" id="pesan3" class="form-control" name="pesan" rows="5"></textarea>
						</div>
					</div>
					<div class="mt-5"></div>
					<div align="right">
						<input type="submit" name="action_button" id="action_button3" class="btn btn-primary" value="Kirim" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="modalLihat" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<span id="form_lihat"></span>
				<div class="form-group">
					<div class="form-group">
						<label class="control-label col-md-4" >Foto : </label>
						<div class="col-md-12">
							<c id="store_image1"></c>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Nama Perorangan : </label>
							<div class="col-md-12">
								<input type="text" id="nama_koperasi1" class="form-control" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Deskripsi : </label>
							<div class="col-md-12">
								<textarea type="text" id="deskripsi1" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Alamat : </label>
							<div class="col-md-12">
								<textarea type="text" id="alamat1" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<label>Kartu Keluarga &nbsp;&nbsp;&nbsp;&nbsp;: </label>
							<span id="kk"></span>
						</div>
						<div class="col-md-6">
							<label>Surat Nikah &nbsp;: </label>
							<span id="surat_nikah"></span>
						</div>	
						<br />

					</div>
				</div>
			</div>
		</div>


		@endsection
		@section('js')


		<script>
			$(document).ready(function(){
				$('#table_id').DataTable({
					dom: 'Bfrtip',
					buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
					],

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
					{data: 'email', name:'email'},
					{data: 'no_hp', name:'no_hp'},
					{data: 'created_at', name:'created_at'},
					{data: 'status', name:'status'},
					{data: 'action', name: 'action',orderable: false},
					{data: 'deskripsi', name:'deskripsi', visible: false},
					{data: 'alamat', name:'alamat', visible: false},
					{data: 'gambar', name:'gambar', visible: false},
					{data: 'kartu_keluarga', name:'kartu_keluarga', visible: false},
					{data: 'surat_nikah', name:'surat_nikah', visible: false},
					{data: 'id_mitra', name:'id_mitra', visible: false},
					{data: 'kode', name:'kode', visible:false}

					]
				});

				$(document).on('click', '.lihat', function(){
					var id = $(this).attr('id');
					$('#form_lihat').html('');
					$.ajax({
						url:"validasi-perorangan/"+id,
						dataType:"json",
						success:function(html){
							$('#nama_koperasi1').val(html.data.nama_perorangan);
							$('#deskripsi1').val(html.data.deskripsi);
							$('#alamat1').val(html.data.alamat);
							$('#store_image1').html("<img src={{ URL::to('/') }}/Uploads/Mitra_Perorangan/{" + html.data.kode  +"}/"+ html.data.gambar +" width='200' height='200' class='img-thumbnail' />");
							$('#kk').html("<a href={{ URL::to('/') }}/Uploads/Mitra_Perorangan/{" + html.data.kode  +"}/"+ html.data.kartu_keluarga +" target='_blank'>&nbsp;lihat</a>");
							$('#surat_nikah').html("<a href={{ URL::to('/') }}/Uploads/Mitra_Perorangan/{" + html.data.kode  +"}/"+ html.data.surat_nikah +" target='_blank'>&nbsp;lihat</a>");
							$('#modalLihat').modal('show');
						}
					})
				});

				$(document).on('click', '.tolak', function(){
					var id = $(this).attr('id');
					$('#form_konfirmasi').html('');
					$.ajax({
						url:"validasi-perorangan/"+id,
						dataType:"json",
						success:function(html){
							$('#hidden_id2').val(html.data.id);
							$('.modal-title').text("Konfirmasi");
							$('#action_button').val("Tolak");
							$('#status2').val("ditolak");
							$('.text').text("Apakah anda yakin ingin tolak?")
							$('#action').val("Tolak");
							$('#modalVerifikasi').modal('show');
						}
					})
				});

				$(document).on('click', '.verifikasi', function(){
					var id = $(this).attr('id');
					$('#form_konfirmasi').html('');
					$.ajax({
						url:"validasi-perorangan/"+id,
						dataType:"json",
						success:function(html){
							$('#hidden_id2').val(html.data.id);
							$('.modal-title2').text("Konfirmasi");
							$('#status2').val("divalidasi");
							$('#password2').val("password");
							$('#id_mitra2').val(html.data.id_mitra);
							$('#email2').val(html.data.email);
							$('#nama_koperasi2').val(html.data.nama_perorangan);
							$('#deskripsi2').val(html.data.deskripsi);
							$('#alamat2').val(html.data.alamat);
							$('#jumlah_petani2').val(html.data.jumlah_petani);
							$('#gambar2').val(html.data.gambar);
							$('#no_hp2').val(html.data.no_hp);
							$('#kode').val(html.data.kode);
							$('.text').text("Apakah anda yakin ingin validasi?")
							$('#action_button').val("Validasi");
							$('#action').val("Verifikasi");
							$('#modalVerifikasi').modal('show');
						}
					})
				});

				$(document).on('click', '.pesan', function(){
					var id = $(this).attr('id');
					$('#form_pesan').html('');
					$.ajax({
						url:"validasi-perorangan/"+id,
						dataType:"json",
						success:function(html){
							$('#hidden_id3').val(html.data.id);
							$('#email3').val(html.data.email);
							$('#action_button3').val("Kirim Pesan");
							$('#action3').val("Pesan");
							$('#modalPesan').modal('show');
						}
					})
				});

				$('#sample_form').on('submit', function(event){
					event.preventDefault();
					if($('#action').val() == 'Tolak')
					{
						$.ajax({
							url:"{{ route('admin.tolak-perorangan.update') }}",
							method:"POST",
							data: new FormData(this),
							contentType: false,
							cache:false,
							processData: false,
							dataType:"json",

							success:function(data)
							{
								setTimeout(function(){
									$('#modalVerifikasi').modal('hide');
									$('#table_id').DataTable().ajax.reload();
								}, 500);
							}
						});
					}

					if($('#action').val() == "Verifikasi")
					{
						$.ajax({
							url:"{{ route('admin.validasi-petani.perorangan') }}",
							method:"POST",
							data: new FormData(this),
							contentType: false,
							cache:false,
							processData: false,
							dataType:"json",
							success:function(data)
							{
								setTimeout(function(){
									$('#modalVerifikasi').modal('hide');
									$('#table_id').DataTable().ajax.reload();
								}, 500);
							}
						});
					}
				});
			});

		</script>
		@stop