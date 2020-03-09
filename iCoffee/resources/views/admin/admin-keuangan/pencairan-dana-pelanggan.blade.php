@extends('admin.layout.master')

@section('title', 'Admin | Validasi Pencairan Dana')

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
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-7">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5>Pengeluaran Saldo Pelanggan</h5>
						<div align="right">
							<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Pencatatan</button>
						</div>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="table-responsive">
							<table id="id_tabel" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Kode</th>
										<th>Nama Tranksaksi</th>
										<th>Waktu Tranksaksi</th>
										<th>Tujuan Tranksaksi</th>
										<th>Jumlah</th>
										<th> </th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- Pie Chart -->
			<div class="col-xl-4 col-lg-5">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
						<h5>Data Penarikan</h5>

					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="table-responsive">
							<table id="id_tabel2" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Invoice</th>
										<th>Jumlah</th>
										<th></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
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
													<th colspan="4"><a name="nama_tran1" id="nama_tran1" value="" class="form-control" /></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="25%" style="text-align: center;">Tujuan Tranksaksi  </th>	
													<th colspan="4"><a name="tujuan_tran1" id="tujuan_tran1" class="form-control" /></th>
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
													<th colspan="2"><a name="nama_akun1" id="nama_akun1" class="form-control"></th>
														<th><a name="posisi1" id="debit" class="form-control"></th></th>
															<th><a name="jumlah1" id="jumlah1" class="form-control" /></th>

														</div>
													</tr>

													<tr>
														<div class="form-group">	
															<th colspan="2">
																<select class="form-control" name="nama_akun2" id="nama_akun2" style="width: 100%">
																	<option></option>
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
																<a rows="2" cols="90" name="catatan" id="catatan1" class="form-control">
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
			<div id="modalLihat" class="modal fade" role="dialog">
				<div class="modal-dialog modal-md">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Detail Pencatatan</h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<div class="container">
								<div class="row">
									<div class="table-responsive col-md-12">
										<table cellpadding="10" border="0">
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Terdaftar&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="terdaftar"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Invoice&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="invoice"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Nama Penarik&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="pemilik_rekening"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Email Pengguna&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="email"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Nama Bank&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="bank"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">No Rekening&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="no_rekening"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Jumlah Penarikan&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="jumlah"></a></th>
												</div>
											</tr>
											<tr>
												<div class="form-group">
													<th width="35%" style="text-align: right;">Saldo Tercatat&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="saldo_pengguna"></a></th>
												</div>
											</tr>
										</table>
									</div>

								</table>
							</div>
						</div>

						<div align="right">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
	@section('js')

	<script>
		$(document).ready(function(){
			$('#id_tabel2').DataTable({
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
					url: "{{ route('adminkeuangan.penarikan-dana') }}",
					dataType:"json",
				},
				columns:[

				{data: 'invoice', name:'invoice'},	
				{data: 'jumlah', name:'jumlah'},
				{data: 'action', name: 'action',orderable: false}

				]
			})
		});


		$(document).on('click', '.tambah', function(){
			var id = $(this).attr('id');
			$('#form_result').html('');
			$.ajax({
				url:"lihat-penarikan-dana/"+id,
				dataType:"json",
				success:function(html){
					$('#hidden_id').val(html.data.id);
					document.getElementById("nama_tran1").innerHTML = html.nama_tran;
					document.getElementById("tujuan_tran1").innerHTML = html.tujuan_tran;
					document.getElementById("catatan1").innerHTML = html.catatan;
					document.getElementById("jumlah1").innerHTML = html.jumlah_debit;
					document.getElementById("nama_akun1").innerHTML = html.nama_akun_debit;
					document.getElementById("debit").innerHTML = html.debit;

					$('.modal-title').text("Validasi Pencatatan");
					$('#action_button').val("Validasi");
					$('#action').val("Tambah");
					$('#formModal').modal('show');
					$('#form_result').html(html);

					$(".js-example-placeholder-single").select2({
						dropdownParent: $('#formModal'),
						placeholder: "Pilih tujuan tranksaksi",
						allowClear: true

					});		

					$('#formModal').on('hidden.bs.modal', function(e) {
						$(this).find('#sample_form')[0].reset();
					});

				}
			})
		});

		$('#sample_form').on('submit', function(event){
			event.preventDefault();
			if($('#action').val() == 'Tambah')
			{
				$.ajax({
					url:"{{ route('adminkeuangan.tambah-penarikan-dana') }}",
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
							$('#id_tabel2').DataTable().ajax.reload();
						}
						$('#form_result').html(html);
					}
				})
			}

			var id;
			$(document).on('click', '.delete', function(){
				id = $(this).attr('id');
				$('#confirmModal').modal('show');
			});

			$('#ok_button').click(function(){
				$.ajax({
					url:"hapus-pencairan-dana/"+id,
					success:function(data)
					{
						setTimeout(function(){
							$('#confirmModal').modal('hide');
							$('#id_tabel').DataTable().ajax.reload();
						}, 500);
					}
				})
			});
		});


	</script>

	<script>
		$(document).ready(function(){

			$('#id_tabel').DataTable({
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
				ajax:{
					url: "{{ route('adminkeuangan.pencairan-dana') }}",
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
					url:"lihat-penjual/"+id,
					dataType:"json",
					success:function(html){
						$('#nama_tran').val(html.data.nama_tran);
						$('#tujuan_tran').val(html.data.tujuan_tran);
						$('#bukti').val(html.data.bukti);
						$('#catatan').val(html.data.catatan);
						$('#hidden_id').val(html.data.id);
						$('.modal-title').text("Edit Pencatatan");
						$('#action_button').val("Edit");
						$('#action').val("Edit");
						$('#formModal').modal('show');
						$('#form_result').html(html);

						$(".js-example-placeholder-single").select2({
							dropdownParent: $('#formModal'),
							placeholder: "Pilih tujuan tranksaksi",
							allowClear: true

						});		

						$('#formModal').on('hidden.bs.modal', function(e) {
							$(this).find('#sample_form')[0].reset();
						});

					}
				})
			});

			$('#sample_form').on('submit', function(event){
				event.preventDefault();
				if($('#action').val() == 'Tambah')
				{
					$.ajax({
						url:"{{ route('adminkeuangan.tambah-penarikan-dana') }}",
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
								$('#id_tabel').DataTable().ajax.reload();
							}
							$('#form_result').html(html);
						}
					})
				}

				if($('#action').val() == "Edit")
				{
					$.ajax({
						url:"{{ route('adminkeuangan.update-penjual') }}",
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
								$('#id_tabel').DataTable().ajax.reload();
							}
							$('#form_result').html(html);
						}
					});
				}
			});


			var id;
			$(document).on('click', '.delete', function(){
				id = $(this).attr('id');
				$('#confirmModal').modal('show');
			});

			$('#ok_button').click(function(){
				$.ajax({
					url:"hapus-penjual/"+id,
					success:function(data)
					{
						setTimeout(function(){
							$('#confirmModal').modal('hide');
							$('#id_tabel').DataTable().ajax.reload();
						}, 500);
					}
				})
			});



			$(document).on('click', '.lihat', function(){
				var id = $(this).attr('id');
				$.ajax({
					url:"detail-penjual/"+id,
					dataType:"json",
					success:function(html){
						$('#modalLihat').modal('show');
						$('.modal-title').text("Detai Pencatatan");
						$('#kode2').val(html.data.kode);
						$('#nama_tran2').val(html.data.nama_tran);
						$('#created_at2').val(html.data.created_at);
						$('#tujuan_tran2').val(html.data.tujuan_tran);
						$('#catatan2').val(html.data.catatan);

						var img = "/Uploads/Adm_bukti/AKKJB/" + html.data.bukti  +"";
						$('#bukti2').attr("src",img);

						var data = html.akun;
						var banyak = data.length;

						for(var i = 0; i<banyak; i++){
							var nama_akun = data[i].nama_akun;
							var posisi_akun = data[i].posisi;
							var jumlah = data[i].jumlah;

							$('#akun11'+i).val(nama_akun);
							$('#posisi11'+i).val(posisi_akun);
							$('#jumlah11'+i).val(jumlah);

						}


					}
				})
			});

		});

	</script>
	<script>

		$("#akun1").select2({
			dropdownParent: $('#formModal'),
			placeholder: "Pilih akun",
			allowClear: true
		});

		$("#nama_akun2").select2({
			dropdownParent: $('#formModal'),
			placeholder: "Pilih akun",
			allowClear: true
		});


		$('#inputGroupFile02').on('change',function(){
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


		@stop