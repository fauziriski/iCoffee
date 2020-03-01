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
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Validasi Pencairan Dana</h1>
		</div>

		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Invoice</th>
						<th>Nama Rekening</th>
						<th>No Rek</th>
						<th>Nama Bank</th>
						<th>Jumlah Pencairan</th>
						<th>Waktu Terdaftar</th>
						<th>Status</th>
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

			ajax: '{{ route('admin.validasi-pencairan') }}',

			columns:[

			{data: 'invoice', name:'invoice'},
			{data: 'pemilik_rekening', name:'pemilik_rekening'},	
			{data: 'jumlah', name:'jumlah'},
			{data: 'bank', name:'bank'},
			{data: 'no_rekening', name:'no_rekening'},
			{data: 'created_at', name:'created_at'},
			{data: 'status', name:'status'},
			{data: 'action', name: 'action',orderable: false},
			{data: 'email', name:'email', visible: false}



			]
		});

		$(document).on('click', '.lihat', function(){
			var id = $(this).attr('id');
			$.ajax({
				url:"lihat-validasi-pencairan/"+id,
				dataType:"json",
				success:function(html){

					var rp = html.data.jumlah;
					var saldoo = html.saldo_pengguna;

					var	reverse = rp.toString().split('').reverse().join(''),
					ribuan 	= reverse.match(/\d{1,3}/g);
					ribuan	= ribuan.join('.').split('').reverse().join('');

					var	reverse2 = saldoo.toString().split('').reverse().join(''),
					saldo 	= reverse2.match(/\d{1,3}/g);
					saldo	= saldo.join('.').split('').reverse().join('');

					$('#modalLihat').modal('show');
					$('.modal-title').text("Detail Penarikan");
					document.getElementById("terdaftar").innerHTML = html.data.created_at;
					document.getElementById("invoice").innerHTML = html.data.invoice;
					document.getElementById("pemilik_rekening").innerHTML = html.data.pemilik_rekening;
					document.getElementById("email").innerHTML = html.data.email;
					document.getElementById("no_rekening").innerHTML = html.data.no_rekening;
					document.getElementById("bank").innerHTML = html.data.bank;
					document.getElementById("jumlah").innerHTML = "Rp. "+ribuan;
					document.getElementById("saldo_pengguna").innerHTML = "Rp. "+saldo;

				}
			})
		});



		$(document).on('click', '.tolak', function(){
			var id = $(this).attr('id');
			$('#form_konfirmasi').html('');
			$.ajax({
				url:"lihat-validasi-pencairan/"+id,
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


		$(document).on('click', '.diproses', function(){
			var id = $(this).attr('id');
			$('#form_konfirmasi').html('');
			$.ajax({
				url:"lihat-validasi-pencairan/"+id,
				dataType:"json",
				success:function(html){
					$('#hidden_id2').val(html.data.id);
					$('.modal-title2').text("Konfirmasi");
					$('#action_button2').val("validasi");
					$('#status2').val("4");
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
				url:"lihat-validasi-pencairan/"+id,
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
					url:"{{ route('admin.tolak-pencairan.update') }}",
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
					url:"{{ route('admin.validasi-pencairan.update') }}",
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