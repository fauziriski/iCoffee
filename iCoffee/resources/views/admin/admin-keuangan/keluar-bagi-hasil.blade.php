@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Pencairan Bagi Hasil')

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

	.select2-selection__rendered {
		line-height: 32px !important;
	}

	.select2-selection {
		height: 37px !important;
	}

	table{border-collapse:collapse}
	th{border:1px solid blue}

	input.form-control {
		width: auto;
	}

</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Pencairan Dana Investasi</h1>
		</div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Pencatatan</button>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="id_tabel" class="table table-striped table-bordered" border="0" style="width:100%">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama Tranksaksi</th>
								<th>Waktu Tranksaksi</th>
								<th>Tujuan Tranksaksi</th>
								<th>JumlahTranksaksi</th>
								<th> </th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div id="formModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Tambah Pencatatan</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body mt-3">
						<span id="form_result"></span>
						<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
							@csrf
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive">	
											<table cellpadding="10" border="1">
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Nama Tranksaksi  </th>	
														<th colspan="4"><input type="text" name="nama_tran" id="nama_tran" class="form-control" style="width: 100%" /></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Tujuan Tranksaksi  </th>	
														<th colspan="4"><select class="form-control" name="tujuan_tran" id="tujuan_tran" style="width: 100%">
															<option value="" selected>---- Pilih Tujuan -----</option>
															@foreach($tran as $key)
															<option value="{{$key->nama_tran}}">{{$key->nama_tran}}</option>
															@endforeach
														</select></th>
													</div>	
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Daftar Akun  </th>	
														<th width="35%" colspan="2">Akun :</th>
														<th width="25%">Posisi :</th>
														<th width="25%">Jumlah (IDR) :</th>
													</div>
												</tr>
												
												<tr>
													<div class="form-group">
														<th rowspan="2"></th>
														<th colspan="2">
														<select class="form-control" name="akun1" id="akun1" style="width: 100%">
																<option value="" selected>----- Pilih Akun -----</option>
																@foreach($kategori as $kat)
																<optgroup label="{{$kat->no_akun}}.&nbsp;&nbsp;{{$kat->nama_kat}}">{{$kat->nama_kat}}</optgroup>

																@foreach($satu as $sub1)
																@if($kat->id==$sub1->adm_kat_akun->id)
																<option value="{{ $sub1->nama_sub }}">{{$sub1->no_akun}}.&nbsp;&nbsp;{{ $sub1->nama_sub }}</option>
																@endif

																@foreach($dua as $sub2)
																@if($sub1->id==$sub2->adm_sub1_akun->id && $kat->id==$sub2->adm_kat_akun->id)
																
																<option value="{{ $sub2->nama_sub }}">{{$sub2->no_akun}}.&nbsp;&nbsp;{{ $sub2->nama_sub }}</option>
																@endif

																@endforeach
																@endforeach
																@endforeach							
															</select>
														</th>
														<th>
															<select class="form-control" name="posisi1" id="posisi1" style="width: 100%">
																<option value="Debit">Debit</option>
																<option value="Kredit">Kredit</option>
															</select>
														</th>
														<th><input type="number" name="jumlah1" id="jumlah1" class="form-control" /></th>

													</div>
												</tr>

												<tr>
													<div class="form-group">	
														<th colspan="2">
															<select class="form-control" name="akun2" id="akun2" style="width: 100%">
																<option value="" selected>----- Pilih Akun -----</option>
																@foreach($kategori as $kat)
																<optgroup label="{{$kat->no_akun}}.&nbsp;&nbsp;{{$kat->nama_kat}}">{{$kat->nama_kat}}</optgroup>

																@foreach($satu as $sub1)
																@if($kat->id==$sub1->adm_kat_akun->id)
																<option value="{{ $sub1->nama_sub }}">{{$sub1->no_akun}}.&nbsp;&nbsp;{{ $sub1->nama_sub }}</option>
																@endif

																@foreach($dua as $sub2)
																@if($sub1->id==$sub2->adm_sub1_akun->id && $kat->id==$sub2->adm_kat_akun->id)
																
																<option value="{{ $sub2->nama_sub }}">{{$sub2->no_akun}}.&nbsp;&nbsp;{{ $sub2->nama_sub }}</option>
																@endif

																@endforeach
																@endforeach
																@endforeach							
															</select>
														</th>
														<th>
															<select class="form-control" name="posisi2" id="posisi2" style="width: 100%">	
																<option value="Kredit">Kredit</option>
																<option value="Debit">Debit</option>
															</select>
														</th>
														<th><input type="number" name="jumlah2" id="jumlah2" class="form-control" /></th>

													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Bukti  </th>	
														<th colspan="4">
															<div class="form-group">
																<div class="custom-file">
																	<input type="file" class="custom-file-input" name="bukti" id="inputGroupFile02"/>
																	<label class="custom-file-label" for="inputGroupFile02">Choose file</label>
																</div>
															</div>
														</th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th style="text-align: center;">Catatan </th>
														<th colspan="4">
															<textarea name="catatan" class="form-control" id="ckeditor"></textarea>
														</th>
													</div>
												</tr>


											</table>
										</div>
									</div>
								</div>
								<br />
								<div align="right">
									<input type="hidden" name="action" id="action" value="" />
									<input type="hidden" name="hidden_id" id="hidden_id" />
									<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Tambah" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	<div id="modalLihat" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pencatatan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="table-responsive col-md-12 col-sm-12">
                            <table cellpadding="10" border="0">
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Kode&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="kode2"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Nama Tranksaksi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="nama_tran2"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th style="text-align: right;">Catatan&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="catatan2"></a>
                                        </th>
                                    </th>
                                </div>
                            </tr>
                        </table>
                    </div>
					</div>

                    <div class="table-responsive col-md-12 col-sm-12 mt-3">
                        <div class="row">
                            <table cellpadding="10" border="0">
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Waktu Tranksaksi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="created_at2"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Tujuan Tranksaksi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="tujuan_tran2"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Foto Bukti&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <div id="image">
                                                <a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
                                                    <img src="" id="bukti2" width="100px" height="100px"/>
                                                </a>
                                                <div>
                                                    <div>
                                                        <div
                                                            class="modal fade "
                                                            id="imagemodal"
                                                            tabindex="-1"
                                                            role="dialog"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <img class="modal-img"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>

						<div class="table-responsive">
						<div class="container">
                        <div class="row">
                            
                            <div class="col-md-12 col-sm-12">
                                <table cellpadding="10" border="1">
                                    <tr style="background-color: #4e73df; color: white;">
                                        <div class="form-group">
                                            <th width="40%">Akun&nbsp;&nbsp;:</th>
                                            <th width="15%">Posisi&nbsp;&nbsp;:</th>
                                            <th width="20%">Jumlah&nbsp;&nbsp;:</th>
                                        </div>
                                    </tr>
                                    @for ($i = 0; $i < 2; $i++)
                                    <tr>
                                        <div class="form-group">
                                            <th>
                                                <a id="akun11{{$i}}"></a>
                                            </th>
                                            <th>
                                                <a id="posisi11{{$i}}"></a>
                                            </th>
                                            <th>
                                                <a id="jumlah11{{$i}}"></a>
                                            </th>
                                        </div>
                                    </tr>
                                    @endfor
                                </table>
								</div>
                            </div>
                       
						

                        <div align="right" class="mt-5 mb-3">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
						</div>
                    </div>
					</div>
                </div>
            </div>
        </div>


		<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Pencatatan</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body mt-3">
						<span id="form_result22"></span>
						<form method="post" id="sample_form22" class="form-horizontal" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="kode22" id="kode22" value="kode22" />
							<input type="hidden" name="total_jumlah22" id="total_jumlah22" value="total_jumlah22" />
							<input type="hidden" name="waktu22" id="waktu22" value="waktu22" />
							
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive col-md-12 col-sm-12">
											<table cellpadding="10" border="1">
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Nama Tranksaksi  </th>	
														<th colspan="4"><input type="text" name="nama_tran22" id="nama_tran22" class="form-control" style="width: 100%" /></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Tujuan Tranksaksi  </th>	
														<th colspan="4"><select class="js-example-placeholder-single js-states form-control" name="tujuan_tran22" id="tujuan_tran22" style="width: 100%">
															<option value="" selected>----- Pilih Tujuan -----</option>
															@foreach($tran as $key)
															<option value="{{$key->nama_tran}}">{{$key->nama_tran}}</option>
															@endforeach
														</select></th>
													</div>	
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Daftar Akun  </th>	
														<th width="35%" colspan="2">Akun :</th>
														<th width="25%">Posisi :</th>
														<th width="25%">Jumlah (IDR) :</th>
													</div>
												</tr>
												@for ($i = 0; $i < 2; $i++)
												<tr>
													<div class="form-group">
														<th></th>
														<th colspan="2">
															<select class="form-control" name="akun22[]" id="akun22{{$i}}" value="" style="width: 100%">
															<option value="" selected>----- Pilih Akun -----</option>
																@foreach($kategori as $kat)
																<optgroup label="{{$kat->no_akun}}.&nbsp;&nbsp;{{$kat->nama_kat}}">{{$kat->nama_kat}}</optgroup>

																@foreach($satu as $sub1)
																@if($kat->id==$sub1->adm_kat_akun->id)
																<option value="{{ $sub1->nama_sub }}">{{$sub1->no_akun}}.&nbsp;&nbsp;{{ $sub1->nama_sub }}</option>
																@endif

																@foreach($dua as $sub2)
																@if($sub1->id==$sub2->adm_sub1_akun->id && $kat->id==$sub2->adm_kat_akun->id)
																
																<option value="{{ $sub2->nama_sub }}">{{$sub2->no_akun}}.&nbsp;&nbsp;{{ $sub2->nama_sub }}</option>
																@endif

																@endforeach
																@endforeach
																@endforeach								
															</select>
														</th>
														<th>
															<select class="form-control" name="posisi22[]" id="posisi22{{$i}}" value="" style="width: 100%">
																<option value="Debit">Debit</option>
																<option value="Kredit">Kredit</option>
															</select>
														</th>
														<th><input type="number" name="jumlah22[]" id="jumlah22{{$i}}" value="" class="form-control" /></th>

													</div>
												</tr>
												@endfor

												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Bukti  </th>	
														<th colspan="4">
															
															<div class="row">
															<div class="col-md-2 col-sm-12">
															<span id="store_image"></span>
															</div>
															<div class="col-md-8 mt-4 col-sm-12">
															<div class="custom-file">
																	<input type="file" class="custom-file-input" name="foto_baru22" id="inputGroupFile03"/>
																	<label class="custom-file-label" for="inputGroupFile03">Choose file</label>
																</div>
															</div>
															</div>
														</th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th style="text-align: center;">Catatan </th>
														<th colspan="4">
															<textarea rows="2" cols="90" name="catatan22" id="catatan22" value="" class="form-control" ></textarea>
														</th>
													</div>
												</tr>
											</table>
									</div>
								</div>
								<br />
								<div align="right">
									
									<input type="hidden" name="action" id="action" value="" />
									<input type="hidden" name="hidden_id22" id="hidden_id22" />
									<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Simpan" />
								</div>
								</div>
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

							$('#id_tabel').DataTable({
								dom: 'Bfrtip',
								buttons: [
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
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
								ajax:{
									url: "{{ route('adminkeuangan.keluar-bagi-hasil') }}",
									dataType:"json",
								},
								columns:[

								{data: 'kode', name: 'kode'},
								{data: 'nama_tran', name:'nama_tran'},
								{data: 'created_at', name:'created_at'},
								{data: 'tujuan_tran', name:'tujuan_tran'},
								{data: 'total_jumlah', name:'total_jumlah'},
								{data: 'action',name: 'action',orderable: false},
								{data: 'bukti', name:'bukti', visible: false}

								]

							});

							$('#create_record').click(function(){
								$('.modal-title').text("Tambah Pencatatan");
								$('#action_button').val("Tambah");
								$('#action').val("Tambah");
								$('#formModal').modal('show');
							});


							$(document).on('click', '.edit', function(){
								var id = $(this).attr('id');
								$('#form_result').html('');
								$.ajax({
									url:"detail-keluar-bagi-hasil/"+id,
									dataType:"json",
									success:function(html){
										$('#nama_tran22').val(html.data.nama_tran);
										$('#tujuan_tran22').val(html.data.tujuan_tran);
										$('#hidden_id22').val(html.data.id);
										$('#bukti22').val(html.data.bukti);
										$('#kode22').val(html.data.kode);
										$('#total_jumlah22').val(html.data.total_jumlah);
										$('.modal-title').text("Edit Pencatatan");
										$('#action_button').val("Simpan");
										$('#action').val("Simpan");
										$('#ModalEdit').modal('show');
										$('#form_result22').html(html);
										$('#catatan22').val(html.data.catatan);
										$('#waktu22').val(html.data.created_at);

										$('#store_image').html("<img src={{ URL::to('/') }}/Uploads/Adm_bukti/AKKLA/" + html.data.bukti + " width='100px' height='100px'/>");
    									$('#store_image').append("<input type='hidden' name='bukti22' value='"+html.data.bukti+"' />");
										
										var data = html.akun;
										var banyak = data.length;

										for(var i = 0; i<banyak; i++){
											var nama_akun = data[i].nama_akun;
											var posisi_akun = data[i].posisi;
											var jumlah = data[i].jumlah;

											document.getElementById('akun22'+i).value = nama_akun;
											document.getElementById('posisi22'+i).value = posisi_akun;
											document.getElementById('jumlah22'+i).value = jumlah;

										}
										
										$('#ModalEdit').on('hidden.bs.modal', function(e) {
											$(this).find('#sample_form22')[0].reset();
										});

									}
								})
							});

							$('#sample_form').on('submit', function(event){
								event.preventDefault();
								if($('#action').val() == 'Tambah')
								{
									$.ajax({
										url:"{{ route('adminkeuangan.tambah-keluar-bagi-hasil') }}",
										method:"POST",
										data: new FormData(this),
										contentType: false,
										cache:false,
										processData: false,
										dataType:"json",
										success: function (data)
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
												$('#form_result').html(html);
												if(data.success)
												{	
													$('#formModal').modal('hide');
													swal('Berhasil', 'Data berhasil ditambahkan', 'success');
													$('#id_tabel').DataTable().ajax.reload();
													$('#formModal').on('hidden.bs.modal', function(e) {
													$(this).find('#sample_form')[0].reset();
													});	
												}			
										}
									})
								}
							});

								$('#sample_form22').on('submit', function(event){
								event.preventDefault();
								if($('#action').val() == "Simpan")
								{
									$.ajax({
										url:"{{ route('adminkeuangan.update-keluar-bagi-hasil') }}",
										method:"POST",
										data: new FormData(this),
										contentType: false,
										cache:false,
										processData: false,
										dataType:"json",
										success: function (data)
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
												$('#form_result22').html(html);
												if(data.success)
												{
													$('#ModalEdit').modal('hide');
													swal('Berhasil', 'Data berhasil diubah', 'success');
													$('#id_tabel').DataTable().ajax.reload();
													$('#ModalEdit').on('hidden.bs.modal', function(e) {
													$(this).find('#sample_form22')[0].reset();			
													});				
												}
											
										}
									});
								}
							});


							$(document).on('click', '.lihat', function(){
								var id = $(this).attr('id');
								$.ajax({
									url:"detail-keluar-bagi-hasil/"+id,
									dataType:"json",
									success:function(html){
										$('#modalLihat').modal('show');
										$('.modal-title').text("Detai Pencatatan");
										document.getElementById("kode2").innerHTML = html.data.kode;
										document.getElementById("nama_tran2").innerHTML = html.data.nama_tran;
										document.getElementById("created_at2").innerHTML = html.data.created_at;
										document.getElementById("tujuan_tran2").innerHTML = html.data.tujuan_tran;
										document.getElementById("catatan2").innerHTML = html.data.catatan;
										
										var img = "/Uploads/Adm_bukti/AKKLA/" + html.data.bukti  +"";
										$('#bukti2').attr("src",img);

										var data = html.akun;
										var banyak = data.length;

										for(var i = 0; i<banyak; i++){
											var nama_akun = data[i].nama_akun;
											var posisi_akun = data[i].posisi;
											var jumlah = data[i].jumlah;

											var	reverse = jumlah.toString().split('').reverse().join(''),
											ribuan 	= reverse.match(/\d{1,3}/g);
											ribuan	= ribuan.join('.').split('').reverse().join('');

											document.getElementById("akun11"+i).innerHTML = nama_akun;
											document.getElementById("posisi11"+i).innerHTML = posisi_akun;
											document.getElementById("jumlah11"+i).innerHTML = "Rp. "+ribuan;

										}

									}
								})
							});

						});

					</script>

					<script>
						$(document).on('click', '.delete', function () {
							var id = $(this).attr('id');
							swal({
								title: "Apakah anda yakin ingin menghapus ?",
								type: "warning",
								confirmButtonClass: "btn-danger",
								confirmButtonText: "Ya",
								showCancelButton: true
							}, function () {
								$.ajax({
									type: "GET",
									url:"hapus-keluar-bagi-hasil/"+id,
									dataType: "json",
									success: function (data) {
										swal('Berhasil', 'Data berhasil dihapus', 'success');
										$('#id_tabel').DataTable().ajax.reload();
									}
								});
							});
						});
					</script>
				
					<script>
					
						$('#inputGroupFile02').on('change',function(){
							var fileName = $(this).val();
							$(this).next('.custom-file-label').html(fileName);
						});

						$('#inputGroupFile03').on('change',function(){
							var fileName = $(this).val();
							$(this).next('.custom-file-label').html(fileName);
						});

					</script>

					<script>

						$(function(){
							$("#image img").on("click",function(){
								var src = $(this).attr("src");
								$(".modal-img").prop("src",src);
							})
						})

					</srcipt>	
						@stop

