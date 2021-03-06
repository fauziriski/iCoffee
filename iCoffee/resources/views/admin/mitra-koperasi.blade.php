@extends('admin.layout.master')

@section('title', 'Admin | Mitra Koperasi')

@section('content')

@section('css')

<style>

	@media (min-width: 480px) {
		.modal-img {
			width: 100%;
			height: 100%;

		}
	}

	@media (min-width: 640px) {
		.modal-img {
			width: 200%;
			height: 100%;
			margin-left: -50%;
		}
	}

	@media (min-width: 768px) {
		.modal-img {
			width: 200%;
			height: 200%;
			margin-left: -50%;
		}
	}

	@media (min-width: 992px) {
		.modal-img {
			width: 300%;
			height: 200%;
			margin-left: -100%;
		}
	}

	@media (min-width: 1200px) {
		.modal-img {
			width: 300%;
			height: 200%;
			margin-left: -100%;
		}
	}
</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5>Validasi Mitra Koperasi</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">

            <div class="table-responsive">
                <table
                    id="table_id"
                    class="table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Koperasi</th>
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
					<input type="hidden" name="action" id="action" />
					<input type="hidden" name="id_mitra" id="id_mitra2" />
					<input type="hidden" name="email" id="email2" />
					<input type="hidden" name="nama_koperasi" id="nama_koperasi2" />
					<input type="hidden" name="deskripsi" id="deskripsi2" />
					<input type="hidden" name="alamat" id="alamat2" />
					<input type="hidden" name="jumlah_petani" id="jumlah_petani2" />
					<input type="hidden" name="gambar" id="gambar2" />
					<input type="hidden" name="no_hp" id="no_hp2" />
					<input type="hidden" name="kode" id="kode2" />
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
					<div class="col-md-12">
						<input type="hidden" name="hidden_id" id="hidden_id3" />
						<input type="hidden" name="action" id="action3" />
						<div class="form-group">
							<label class="control-label">Kepada : &nbsp;&nbsp;</label>
							<a id="email3"></a>
						</div>
						<div class="form-group">
							<label class="control-label mb-4">Pesan : </label>
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
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Mitra</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="form-group">

						<div class="table-responsive">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="25%" style="text-align: right;">Foto Mitra&nbsp;&nbsp;&nbsp;:</th>		
										<th width="25%">
											<div id="image">
												<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
													<img src="" id="foto_mitra" width="100px" height="100px"/>
												</a>
												<div>   
													<div>   
														<div class="modal fade " id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
															<div class="modal-dialog modal-sm">
																<div class="modal-content">
																	<img class="modal-img" />
																</div>
															</div>
														</div>
													</div>
												</th>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">Nama Koperasi&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="nama_koperasi"></a></th>

												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">Jumlah Petani&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="jumlah_petani"></a></th>

												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">Email Koperasi&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="email"></a></th>

												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">No Telepon&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="no_hp"></a></th>

												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">Alamat Koperasi&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="alamat"></a></th>

												</div>	
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">Deskripsi&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="deskripsi"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">KTP&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a href="" target="_blank" class="btn btn-success py-0" id="ktp_pengurus">lihat berkas</a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">ADRT&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a href="" target="_blank" class="btn btn-success py-0" id="ad_art">lihat berkas</a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: right;">AKTE&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a href="" target="_blank" class="btn btn-success py-0" id="akte">lihat berkas</a></th>
												</div>
											</tr>
											
										</table>
									</div>
								</div>
							</div>

							<br />
							<div align="right">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>
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
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1,2,3,4,5]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5]
									}
							}           
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
						{data: 'id_mitra', name:'id_mitra', visible: false},
						{data: 'kode', name:'kode', visible:false}

						]
					});


					$(document).on('click', '.lihat', function(){
						var id = $(this).attr('id');
						$.ajax({
							url:"validasi-koperasi/"+id,
							dataType:"json",
							success:function(html){

								$('#modalLihat').modal('show');
								$('.modal-title').text("Detail Mitra");
								document.getElementById("nama_koperasi").innerHTML = html.data.nama_koperasi;
								document.getElementById("jumlah_petani").innerHTML = html.data.jumlah_petani+" petani";
								document.getElementById("email").innerHTML = html.data.email;
								document.getElementById("no_hp").innerHTML = html.data.no_hp;
								document.getElementById("alamat").innerHTML = html.data.alamat;
								document.getElementById("deskripsi").innerHTML = html.data.deskripsi;

								var img = "/Uploads/Mitra_Koperasi/" + html.data.kode + "/" + html.data.gambar +"";
								$('#foto_mitra').attr("src",img);

								var ktp = "/Uploads/Mitra_Koperasi/" + html.data.kode  +"/"+ html.data.ktp_pengurus +"";
								$('#ktp_pengurus').attr("href",ktp);

								var adrt = "/Uploads/Mitra_Koperasi/" + html.data.kode  +"/"+ html.data.ad_art +"";
								$('#ad_art').attr("href",adrt);

								var akt = "/Uploads/Mitra_Koperasi/" + html.data.kode  +"/"+ html.data.akte +"";
								$('#akte').attr("href",akt);

							}
						})
					});

					$(document).on('click', '.tolak', function(){
						var id = $(this).attr('id');
						$('#form_konfirmasi').html('');
						$.ajax({
							url:"validasi-koperasi/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('.modal-title').text("Konfirmasi");
								$('#action_button').val("Tolak");
								$('#status2').val("3");
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
							url:"validasi-koperasi/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('.modal-title').text("Konfirmasi");
								$('#status2').val("2");
								$('#password2').val("password");
								$('#id_mitra2').val(html.data.id_mitra);
								$('#email2').val(html.data.email);
								$('#nama_koperasi2').val(html.data.nama_koperasi);
								$('#deskripsi2').val(html.data.deskripsi);
								$('#alamat2').val(html.data.alamat);
								$('#jumlah_petani2').val(html.data.jumlah_petani);
								$('#gambar2').val(html.data.gambar);
								$('#no_hp2').val(html.data.no_hp);
								$('#kode2').val(html.data.kode);
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
							url:"validasi-koperasi/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id3').val(html.data.id);
								document.getElementById("email3").innerHTML = html.data.email;
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
								url:"{{ route('admin.tolak-koperasi.update') }}",
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
								url:"{{ route('admin.validasi-petani.koperasi') }}",
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
			<script>

				$(function(){
					$("#image img").on("click",function(){
						var src = $(this).attr("src");
						$(".modal-img").prop("src",src);
					})
				})

			</script>
			@stop