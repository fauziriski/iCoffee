@extends('admin.layout.master')

@section('title', 'Admin | Validasi Progres Mitra')

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
            <h5>Validasi Progres Mitra</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">

		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Nama Mitra</th>
						<th>Judul Progres</th>
						<th>Tanggal</th>
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
					<input type="hidden" name="id_mitra" id="id_mitra2" />
					<input type="hidden" name="total_pengajuan" id="total_pengajuan2" />
					<input type="hidden" name="action" id="action2" />
					<div class="text2">
						<h5 class="mt-3" align="center" style="margin:0;">Apakah anda yakin ingin diproses?</h5>
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
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Progres</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="table-responsive col-md-6">
							<table cellpadding="10" border="0">
								<tr>
								<div class="form-group">
									<th width="10%" style="text-align: right;">Foto Produk&nbsp;&nbsp;&nbsp;:</th>
									<th width="25%">
										<div id="image">
											<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
												<img src="" id="foto_produk" width="100px" height="100px"/>
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
											</th>
										</tr>
										<tr>
											<div class="form-group">
												<th width="15%" style="text-align: right;">Kode Produk&nbsp;&nbsp;&nbsp;:</th>	
												<th width="25%"><a id="kode_produk"></a></th>
											</div>
										</tr>
										<tr>
											<div class="form-group">
												<th width="15%" style="text-align: right;">Nama Produk&nbsp;&nbsp;&nbsp;:</th>	
												<th width="25%"><a id="nama_produk"></a></th>
											</div>
										</tr>
										<tr>
											<div class="form-group">
												<th width="15%" style="text-align: right;">Periode Kontrak&nbsp;&nbsp;&nbsp;:</th>	
												<th width="25%"><a id="periode_kontrak"></a></th>
											</div>
										</tr>
									</table>
								</div>


									<div class="table-responsive col-md-6 mt-5">
										<div class="row">
											<table cellpadding="10" border="0">
												<tr>
													<div class="form-group">
														<th width="10%"style="text-align: right;">Status&nbsp;&nbsp;&nbsp;:</th>
														<th width="25%"><a id="status"></a></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="10%"style="text-align: right;">Tanggal Progres&nbsp;&nbsp;&nbsp;:</th>		
														<th width="25%"><a id="tanggal_progres"></a></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="15%" style="text-align: right;">Nama Mitra&nbsp;&nbsp;&nbsp;:</th>	
														<th width="25%"><a id="nama_mitra"></a></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">	
														<th width="10%"style="text-align: right;">Judul Progres&nbsp;&nbsp;&nbsp;:</th>		
														<th width="25%"><a id="judul_progres"></a></th>
													</div>
												</tr>
												<tr>
												<div class="form-group">
													<th width="10%" style="text-align: right;">Deskripsi&nbsp;&nbsp;&nbsp;:</th>	
													<th width="25%"><a id="deskripsi"></a></th>
												</div>
												</tr>
																						
											</table>
										</div>
									</div>
								</div>
							</div>

				<div class="row">
					<div class="container">
						<div class="table-responsive col-md-12">
							<table cellpadding="10" border="0">
							<tr>
								<div class="form-group">
									<th width="15%" style="text-align: right;">Dokumen Progres&nbsp;&nbsp;&nbsp;:</th>
									<th width="25%">
										<div id="image">
											<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
												<img src="" id="foto_progres" class="img-thumbnail" width="250" height="250"/>
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
											</th>

											<th width="25%">
													<iframe
													id="Geeks3"
													width="350"
													height="250"
													src=""
													frameborder="0"
													allowfullscreen="allowfullscreen">
													</iframe> 							
												</div>
												</div>
											</th>
										</div>
									</tr>
									</table>
							
						</div><br>

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
										columns: [0,1,2,3,4,5,6,7]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6,7]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6,7]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6,7]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6]
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

			ajax: '{{ route('admin.validasi-progres-mitra') }}',

			columns:[

			{data: 'kode_produk', name:'kode_produk'},
			{data: 'nama_produk', name:'nama_produk'},	
			{data: 'nama', name:'nama'},
			{data: 'judul', name:'judul'},
			{data: 'waktu', name:'waktu'},
			{data: 'status1', name:'status1'},
			{data: 'action', name: 'action',orderable: false}

			]
		});

		$(document).on('click', '.lihat', function(){
			var id = $(this).attr('id');
			$.ajax({
				url:"lihat-validasi-progres-mitra/"+id,
				dataType:"json",
				success:function(data1){

					$('#modalLihat').modal('show');
					$('.modal-title').text("Detail Progres");
					document.getElementById("kode_produk").innerHTML = data1.data.kode_produk;
					document.getElementById("nama_produk").innerHTML = data1.produk.nama_produk;
					var periode = data1.produk.periode+" Tahun";
					document.getElementById("periode_kontrak").innerHTML = periode;
					document.getElementById("status").innerHTML = data1.status;
					document.getElementById("tanggal_progres").innerHTML = data1.data.created_at;
					document.getElementById("nama_mitra").innerHTML = data1.mitra.nama;
					document.getElementById("judul_progres").innerHTML = data1.data.judul;
					document.getElementById("deskripsi").innerHTML = data1.data.deskripsi;
					
					var img = "/Uploads/Investasi/Produk/" + data1.data.kode_produk  + "/" + data1.produk.gambar +"";
								$('#foto_produk').attr("src",img);

					var img2 = "/Uploads/Investasi/Produk/" + data1.data.kode_produk  + "/" + data1.file_foto.nama +"";
					$('#foto_progres').attr("src",img2);

					var url = "/Uploads/Investasi/Produk/" + data1.data.kode_produk  + "/" + data1.file_vidio.nama +"";
               		 $("#Geeks3").attr('src', url);
						$("#modalLihat").on('hide.bs.modal', function() { 
							$("#Geeks3").attr('src', ''); 
						});  
           
					
					
				}
			})
		});



		$(document).on('click', '.tolak', function(){
			var id = $(this).attr('id');
			$('#form_konfirmasi').html('');
			$.ajax({
				url:"lihat-validasi-progres-mitra/"+id,
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
				url:"lihat-validasi-progres-mitra/"+id,
				dataType:"json",
				success:function(html){
					$('#hidden_id2').val(html.data.id);
					$('.modal-title2').text("Konfirmasi");
					$('#action_button2').val("diproses");
					$('#status2').val("3");
					$('.text2').text("Apakah anda yakin ingin diproses?")
					$('#action2').val("diproses");
					$('#modalVerifikasi').modal('show');
				}
			})
		});

		$(document).on('click', '.validasi', function () {
			var id = $(this).attr('id');
			$('#form_konfirmasi').html('');
			$.ajax({
				url:"lihat-validasi-progres-mitra/"+id,
				dataType: "json",
				success: function (html) {
					$('#hidden_id2').val(html.data.id);
					$('#id_mitra2').val(html.data.id_mitra);
					$('#total_pengajuan2').val(html.data.total);
					$('.modal-title2').text("Konfirmasi");
					$('#action_button2').val("divalidasi");
					$('#status2').val("2");
					$('.text2').text("Apakah anda yakin ingin divalidasi?")
					$('#action2').val("divalidasi");
					$('#modalVerifikasi').modal('show');
				}
			})
		});


		$(document).on('click', '.pesan', function(){
			var id = $(this).attr('id');
			$('#form_pesan').html('');
			$.ajax({
				url:"lihat-validasi-progres-mitra/"+id,
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
			if($('#action2').val() == 'Tolak')
			{
				$.ajax({
					url:"{{ route('admin.tolak-progres-mitra.update') }}",
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


			if($('#action2').val() == "diproses")
			{
				$.ajax({
					url:"{{ route('admin.proses-progres-mitra.update') }}",
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

			if($('#action2').val() == "divalidasi")
			{
				$.ajax({
					url:"{{ route('admin.validasi-progres-mitra.update') }}",
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