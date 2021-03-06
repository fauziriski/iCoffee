@extends('admin.layout.master')

@section('title', 'Admin | Validasi Pembeli')

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
            <h5>Validasi Pembayaran Jual-Beli</h5>
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
                        <th>Invoice</th>
                        <th>Nama Pengirim</th>
                        <th>Jumlah Transfer</th>
                        <th>No Rek</th>
                        <th>Nama Bank</th>
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
					<input type="hidden" name="foto_bukti2" id="foto_bukti2" />
					<input type="hidden" name="jumlah_transfer2" id="jumlah_transfer2" />
					<input type="hidden" name="invoice2" id="invoice2" />
					<input type="hidden" name="nama_pemilik_pengirim2" id="nama_pemilik_pengirim2" />
					<input type="hidden" name="nama_bank_pengirim2" id="nama_bank_pengirim2" />
					<input type="hidden" name="no_rekening_pengirim2" id="no_rekening_pengirim2" />
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
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pencatatan</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="table-responsive col-md-6">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Invoice&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="invoice"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Nama Pembeli&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama_pemilik_pengirim"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Email Pembeli&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="email"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">No Telepon&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="no_telp"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">No Rekening&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="no_rekening_pengirim"></a></th>
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Jumlah Transfer&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="jumlah_transfer"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Nama Bank&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama_bank_pengirim"></a></th>
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="35%" style="text-align: right;">Status&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="status"></a></th>
									</div>	
								</tr>
							</table>
						</div>


						<div class="table-responsive col-md-6 mt-3">
							<div class="row">
								<table cellpadding="10" border="0">
									<tr>
										<div class="form-group">
											<th width="10%"style="text-align: right;">Total Produk&nbsp;&nbsp;&nbsp;:</th>
											<th width="25%"><a id="stok"></a></th>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th width="10%"style="text-align: right;">Total Biaya Produk&nbsp;&nbsp;&nbsp;:</th>		
											<th width="25%"><a id="total_bayar"></a></th>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th width="10%"style="text-align: right;">Total Biaya Ongkir&nbsp;&nbsp;&nbsp;:</th>		
											<th width="25%"><a id="total_ongkir"></a></th>
										</div>
									</tr>
									<tr>
										<div class="form-group">	
											<th width="10%"style="text-align: right;">Total harus dibayar&nbsp;&nbsp;&nbsp;:</th>		
											<th width="25%"><a id="total_dibayar"></a></th>
										</div>
									</tr>
										<tr>
									<div class="form-group">
										<th width="10%" style="text-align: right;">Tujuan Transfer&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="pay"></a></th>
									</div>
								</tr>
									<tr>
										<div class="form-group">
											<th width="10%" style="text-align: right;">Foto Bukti&nbsp;&nbsp;&nbsp;:</th>	
											<th width="25%">
												<div id="image">
													<a href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
														<img src="" id="bukti2" width="100px" height="100px"/>
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
										columns: [0,1,2,3,4,5,6]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4,5,6]
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

						ajax: '{{ route('admin.validasi-pembeli') }}',

						columns:[

						{data: 'invoice', name:'invoice'},
						{data: 'nama_pemilik_pengirim', name:'nama_pemilik_pengirim'},
						{data: 'jumlah_transfer', name:'jumlah_transfer'},
						{data: 'no_rekening_pengirim', name:'no_rekening_pengirim'},
						{data: 'nama_bank_pengirim', name:'nama_bank_pengirim'},
						{data: 'created_at', name:'created_at'},
						{data: 'status', name:'status'},
						{data: 'action', name: 'action',orderable: false},
						{data: 'email', name:'email', visible: false},
						{data: 'no_telp', name:'no_telp', visible: false},
						{data: 'foto_bukti', name:'foto_bukti', visible: false},
						{data: 'invoice', name:'invoice', visible: false}



						]
					});

					$(document).on('click', '.lihat', function(){
						var id = $(this).attr('id');
						$.ajax({
							url:"lihat-validasi-pembeli/"+id,
							dataType:"json",
							success:function(html){

								var rp = html.data.jumlah_transfer;
								var total_bayar = html.total_bayar;
								var total_ongkir = html.total_ongkir;
								var dibayar = html.total_dibayar;

								var	reverse = rp.toString().split('').reverse().join(''),
								ribuan 	= reverse.match(/\d{1,3}/g);
								ribuan	= ribuan.join('.').split('').reverse().join('');

								var	reverse2 = total_bayar.toString().split('').reverse().join(''),
								totalb 	= reverse2.match(/\d{1,3}/g);
								totalb	= totalb.join('.').split('').reverse().join('');

								var	reverse3 = total_ongkir.toString().split('').reverse().join(''),
								totalo 	= reverse3.match(/\d{1,3}/g);
								totalo	= totalo.join('.').split('').reverse().join('');

								var	reverse4 = dibayar.toString().split('').reverse().join(''),
								totald 	= reverse4.match(/\d{1,3}/g);
								totald	= totald.join('.').split('').reverse().join('');

								$('#modalLihat').modal('show');
								$('.modal-title').text("Detail Pembayaran");
								document.getElementById("invoice").innerHTML = html.data.invoice;
								document.getElementById("nama_pemilik_pengirim").innerHTML = html.data.nama_pemilik_pengirim;
								document.getElementById("email").innerHTML = html.data.email;
								document.getElementById("status").innerHTML = html.status;
								document.getElementById("no_telp").innerHTML = html.data.no_telp;
								document.getElementById("no_rekening_pengirim").innerHTML = html.data.no_rekening_pengirim;
								document.getElementById("jumlah_transfer").innerHTML = "Rp. "+ribuan;
								document.getElementById("nama_bank_pengirim").innerHTML = html.data.nama_bank_pengirim;
								document.getElementById("stok").innerHTML = html.jumlah+" Kg";
								document.getElementById("total_bayar").innerHTML = "Rp. "+totalb;
								document.getElementById("pay").innerHTML = "Bank "+html.pay;
								document.getElementById("total_ongkir").innerHTML = "Rp. "+totalo;
								document.getElementById("total_dibayar").innerHTML = "Rp. "+totald;

								var img = "/Uploads/" + html.data.foto_bukti +"";
								$('#bukti2').attr("src",img);

							}
						})
					});



					$(document).on('click', '.tolak', function(){
						var id = $(this).attr('id');
						$('#form_konfirmasi').html('');
						$.ajax({
							url:"lihat-validasi-pembeli/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('.modal-title2').text("Konfirmasi");
								$('#action_button2').val("Tolak");
								$('#status2').val("2");
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
							url:"lihat-validasi-pembeli/"+id,
							dataType:"json",
							success:function(html){
								$('#hidden_id2').val(html.data.id);
								$('#foto_bukti2').val(html.data.foto_bukti);
								$('#jumlah_transfer2').val(html.data.jumlah_transfer);
								$('#invoice2').val(html.data.invoice);
								$('#nama_bank_pengirim2').val(html.data.nama_bank_pengirim);
								$('#nama_pemilik_pengirim2').val(html.data.nama_pemilik_pengirim);
								$('#no_rekening_pengirim2').val(html.data.no_rekening_pengirim);
								$('.modal-title2').text("Konfirmasi");
								$('#action_button2').val("validasi");
								$('#status2').val("3");
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
							url:"lihat-validasi-pembeli/"+id,
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
								url:"{{ route('admin.tolak-pembeli.update') }}",
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
								url:"{{ route('admin.validasi-pembeli.update') }}",
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