@extends('admin.layout.master')

@section('title', 'Admin | Validasi Produk Lelang')

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

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Validasi Produk Lelang</h1>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga Awal</th>
						<th>Kelipatan</th>
						<th>Jumlah (Kg)</th>
						<th>Lama Lelang</th>
						<th>Status</th>
						<th>Terdaftar</th>
						<th></th>					
					</tr>
				</thead>
			</table>
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
					<input type="hidden" name="lama_lelang" id="lama_lelang2" value="" />
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
				<h5 class="modal-title">Detail Produk</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="form-group">

						<div class="table-responsive">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Kode Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="kode_produk"></a></th>
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Nama Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama_produk"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Harga Awal&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="harga"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Jumlah Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="stok"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Lama Lelang&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="lama_hari"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Detail Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="detail_produk"></a></th>
										
									</div>
								</tr>

								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Foto Produk&nbsp;&nbsp;&nbsp;:</th>
										
										<th width="25%">
											
											<div id="image">
												<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
													@for ($i = 0; $i < 4; $i++)
													<img src="" id="foto{{$i}}" width="100px" height="100px" style="margin-bottom: 5px;"/>
													@endfor
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

						ajax: '{{ route('admin.validasi-produk-lelang') }}',

						columns:[

						{data: 'kode_lelang', name:'kode_lelang'},
						{data: 'nama_produk', name:'nama_produk'},
						{data: 'harga_awal', name:'harga_awal'},
						{data: 'kelipatan', name:'kelipatan'},
						{data: 'stok', name:'stok'},
						{data: 'lama_lelang', name:'lama_lelang'},
						{data: 'status', name:'status'},
						{data: 'created_at', name:'created_at'},
						{data: 'action', name: 'action',orderable: false},
						{data: 'desc_produk', name:'desc_produk', visible: false}

						]
					});


					$(document).on('click', '.lihat', function(){
						var id = $(this).attr('id');
						$.ajax({
							url:"lihat-produk-lelang/"+id,
							dataType:"json",
							success:function(html){
								var kg = html.data.stok+" kg";
								var lama = html.data.lama_lelang+" hari";
								var rp = html.data.harga_awal;

								var	reverse = rp.toString().split('').reverse().join(''),
								ribuan 	= reverse.match(/\d{1,3}/g);
								ribuan	= ribuan.join('.').split('').reverse().join('');

								$('#modalLihat').modal('show');
								$('.modal-title').text("Detail Produk");
								document.getElementById("harga").innerHTML = "Rp. "+ribuan;
								document.getElementById("stok").innerHTML = kg;
								document.getElementById("lama_hari").innerHTML = lama;
								document.getElementById("nama_produk").innerHTML = html.data.nama_produk;
								document.getElementById("detail_produk").innerHTML = html.data.desc_produk;
								document.getElementById("kode_produk").innerHTML = html.data.kode_lelang;

								var lihat = html.data_gambar;
								var panjang = lihat.length;

								for(var i = 0; i<panjang; i++){
									var nama_gambar = lihat[i].nama_gambar;
									var kode_produk = lihat[i].kode_produk;
									var img = "/Uploads/Lelang/{" + kode_produk  + "}/" + nama_gambar +"";
									$("#foto"+i).attr("src",img);

								}

							}
						})
					});



					$(document).on('click', '.tolak', function(){
						var id = $(this).attr('id');
						$('#form_konfirmasi').html('');
						$.ajax({
							url:"produk-lelang/"+id,
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

					$(document).on('click', '.diproses', function(){
						var id = $(this).attr('id');
						$('#form_konfirmasi').html('');
						$.ajax({
							url:"produk-lelang/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('.modal-title2').text("Konfirmasi");
								$('#action_button2').val("Proses");
								$('#status2').val("3");
								$('.text2').text("Apakah anda yakin ingin diproses?")
								$('#action2').val("Proses");
								$('#modalVerifikasi').modal('show');
							}
						})
					});

					$(document).on('click', '.validasi', function(){
						var id = $(this).attr('id');
						$('#form_konfirmasi').html('');
						$.ajax({
							url:"produk-lelang/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('#lama_lelang2').val(html.data.lama_lelang);
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
							url:"produk-lelang/"+id,
							dataType:"json",
							success:function(html){
								var data = html.data_email;

								$('#hidden_id3').val(html.data.id);
								document.getElementById("email3").innerHTML = data.email;
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
								url:"{{ route('admin.tolak-produk-lelang') }}",
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
								url:"{{ route('admin.divalidasi-produk-lelang') }}",
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


						if($('#action2').val() == "Proses")
						{
							$.ajax({
								url:"{{ route('admin.proses-produk-lelang') }}",
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