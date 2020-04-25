@extends('admin.layout.master')

@section('title', 'Admin | Validasi Investor')

@section('content')
@section('css')


<style>

	@media (min-width: 360px) {
		.modal-img {
			width: 100%;
			height: 100%;

		}
	}

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
			width: 400%;
			height: 200%;
			margin-left: -150%;
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
                <h5>Validasi Investor</h5>
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
                                <th>NO KTP</th>
                                <th>NPWP</th>
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
					<input type="hidden" name="status" id="status2" value="" />
					<input type="hidden" name="hidden_id2" id="hidden_id2" />
					<input type="hidden" name="action" id="action2" />
					<div class="text2">
						<h5 class="mt-3" align="center" style="margin:0;">Apakah anda yakin ingin validasi?</h5>
						<div class="mt-5"></div>
					</div>
					<div align="right">
						<input type="submit" name="action_button" id="action_button2" class="btn btn-primary" value="Validasi" />
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
				<h5 class="modal-title">Detail Pencatatan</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="form-group">

						<div class="table-responsive">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">Terdaftar Pada&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="created_at"></a></th>
										
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">Nama Pengguna&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="name"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">Email Pengguna&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="email"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">No KTP&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="no_ktp"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">No NPWP&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="no_npwp"></a></th>
										
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="45%" style="text-align: right;">Foto KTP&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%">
											<div id="image">
												<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
													<img src="" id="ktp" width="100px" height="100px"/>
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
													<th width="45%" style="text-align: right;">Foto NPWP&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%">
														<div id="image">
															<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
																<img src="" id="npwp" width="100px" height="100px"/>
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
												columns: [0,1,2,3]
											}
									},
									{
										extend: 'csv',
										footer: false,
										exportOptions: {
												columns: [0,1,2,3]
											}
									},
									{
										extend: 'excel',
										footer: false,
										exportOptions: {
												columns: [0,1,2,3]
											}
									},
									{
										extend: 'print',
										footer: false,
										exportOptions: {
												columns: [0,1,2,3]
											}
									},
									{
										extend: 'copy',
										footer: false,
										exportOptions: {
												columns: [0,1,2,3]
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

									ajax: '{{ route('admin.validasi-investor') }}',

									columns:[

									{data: 'no_ktp', name:'no_ktp'},
									{data: 'no_npwp', name:'no_npwp'},
									{data: 'created_at', name:'created_at'},
									{data: 'status', name:'status'},
									{data: 'action', name: 'action',orderable: false},
									{data: 'ktp', name:'ktp', visible: false},
									{data: 'npwp', name:'npwp', visible: false},
									{data: 'id_pengguna', name:'id_pengguna', visible: false}


									]
								});

								$(document).on('click', '.lihat', function(){
									var id = $(this).attr('id');
									$.ajax({
										url:"data-investor/"+id,
										dataType:"json",
										success:function(html){
											var data2 = data2;

											$('#modalLihat').modal('show');
											$('.modal-title').text("Detai Investor");
											document.getElementById("name").innerHTML = html.data2.name;
											document.getElementById("email").innerHTML = html.data2.email;
											document.getElementById("no_ktp").innerHTML = html.data.no_ktp;
											document.getElementById("no_npwp").innerHTML = html.data.no_npwp;
											document.getElementById("created_at").innerHTML = html.data.created_at;

											var img = "/Uploads/Investasi/Investor/" + html.data.id_pengguna + "/" + html.data.ktp +"";
											$('#ktp').attr("src",img);

											var img = "/Uploads/Investasi/Investor/" + html.data.id_pengguna + "/" + html.data.npwp +"";
											$('#npwp').attr("src",img);
										}
									})
								});


								$(document).on('click', '.tolak', function(){
									var id = $(this).attr('id');
									$('#form_konfirmasi').html('');
									$.ajax({
										url:"data-investor/"+id,
										dataType:"json",
										success:function(html){
											$('#hidden_id2').val(html.data.id);
											$('.modal-title2').text("Konfirmasi");
											$('#action_button2').val("Tolak");
											$('#status2').val("0");
											$('.text2').text("Apakah anda yakin ingin tolak?")
											$('#action2').val("Tolak");
											$('#modalVerifikasi').modal('show');
										}
									})
								});


								$(document).on('click', '.validasi', function(){
									var id = $(this).attr('id');
									$('#form_konfirmasi').html('');
									$.ajax({
										url:"data-investor/"+id,
										dataType:"json",
										success:function(html){
											$('#hidden_id2').val(html.data.id);
											$('.modal-title2').text("Konfirmasi");
											$('#action_button2').val("validasi");
											$('#status2').val("2");
											$('.text2').text("Apakah anda yakin ingin divalidasi?")
											$('#action2').val("Validasi");
											$('#modalVerifikasi').modal('show');
										}
									})
								});

								$(document).on('click', '.pesan', function(){
									var id = $(this).attr('id');
									$('#form_pesan').html('');
									$.ajax({
										url:"data-investor/"+id,
										dataType:"json",
										success:function(html){			
											var data2 = data2;

											$('#hidden_id3').val(html.data.id);
											document.getElementById("email3").innerHTML = html.data2.email;
											$('#action_button3').val("Kirim Pesan");
											$('#action3').val("Pesan");
											$('#modalPesan').modal('show');
										}
									})
								});

								$('#sample_form').on('submit', function(event){
									event.preventDefault();
									if($('#action2').val() == 'Tolak')
									{
										$.ajax({
											url:"{{ route('admin.tolak-investor.update') }}",
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


									if($('#action2').val() == "Validasi")
									{
										$.ajax({
											url:"{{ route('admin.validasi-investor.update') }}",
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