@extends('admin.layout.master')

@section('title', 'Admin | Validasi Pengajuan Progres')

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
            <h5>Validasi Pengajuan Dana Progres</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">

		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Tanggal Pengajuan</th>
						<th>Id Mitra</th>
						<th>Kode</th>
						<th>Judul</th>
						<th>Deskripsi</th>
						<th>Total Pengajuan</th>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pengajuan</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="table-responsive col-md-12">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Status&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="status1"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Tanggal Pengajuan&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="terdaftar"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Kode&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="kode_produk"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Judul&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="judul"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Deskripsi&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="deskripsi"></a></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="20%" style="text-align: right;">Total&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="total"></a></th>
									</div>
								</tr>
								
						</div>

					</table>
				</div>
				<div class="table-responsive">
					<div class="container">
                        <div class="row">
                        <div class="col-md-12 col-sm-12" id="tabel_rincian">
						</div>
				</div><br>

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

			ajax: '{{ route('admin.validasi-pencairan-petani') }}',

			columns:[

			{data: 'created_at', name:'created_at'},
			{data: 'id_mitra', name:'id_mitra'},	
			{data: 'kode_produk', name:'kode_produk'},
			{data: 'judul', name:'judul'},
			{data: 'deskripsi', name:'deskripsi'},
			{data: 'total', name:'total'},
			{data: 'status', name:'status'},
			{data: 'action', name: 'action',orderable: false}

			]
		});

		$(document).on('click', '.lihat', function(){
			var id = $(this).attr('id');
			$.ajax({
				url:"lihat-validasi-pencairan-petani/"+id,
				dataType:"json",
				success:function(data1){

					var total = data1.data.total
					var	reverse = total.toString().split('').reverse().join(''),
					total_rp 	= reverse.match(/\d{1,3}/g);
					total_rp	= total_rp.join(',').split('').reverse().join('');

					$('#modalLihat').modal('show');
					$('.modal-title').text("Detail Pencairan");
					document.getElementById("kode_produk").innerHTML = data1.data.kode_produk;
					document.getElementById("terdaftar").innerHTML = data1.data.created_at;
					document.getElementById("judul").innerHTML = data1.data.judul;
					document.getElementById("deskripsi").innerHTML = data1.data.deskripsi;
					document.getElementById("status1").innerHTML = data1.status1;
					document.getElementById("total").innerHTML = "Rp "+total_rp;
					
					var table_header = "<table cellpadding='10' border='1' style='margin-top: -5%;'><tr style='background-color: #4e73df; color: white;'><div class='form-group'><th width='40%' style='text-align: center;'>Nama Produk&nbsp;&nbsp;:</th><th width='20%' style='text-align: center;'>Harga&nbsp;&nbsp;:</th><th width='10%' style='text-align: center;'>Qty&nbsp;&nbsp;:</th><th width='20%' style='text-align: center;'>Total&nbsp;&nbsp;:</th></tr></div>";
					var table_footer = "<tr><th colspan='3' style='text-align: center;'>Total Pengajuan</th><th style='text-align: center;'>Rp "+total_rp+"</th></tr></table></div>"
					var html = "";

					data1.rincian.forEach(function(data2){

					var harga = data2.harga
					var	reverse = harga.toString().split('').reverse().join(''),
					harga_rp 	= reverse.match(/\d{1,3}/g);
					harga_rp	= harga_rp.join(',').split('').reverse().join('');

					var jumlah = data2.jumlah
					var	reverse = jumlah.toString().split('').reverse().join(''),
					jumlah_rp 	= reverse.match(/\d{1,3}/g);
					jumlah_rp	= jumlah_rp.join(',').split('').reverse().join('');


						html += "<tr><th style='text-align: center;'>"+data2.produk+"</th><th style='text-align: center;'>Rp "+harga_rp+"</th><th style='text-align: center;'>"+data2.qty+"</th><th style='text-align: center;'>Rp "+jumlah_rp+"</th></tr></br>";
					});
					
					var all = table_header +html+ table_footer;
					document.getElementById("tabel_rincian").innerHTML = all;
					
					
				}
			})
		});



		$(document).on('click', '.tolak', function(){
			var id = $(this).attr('id');
			$('#form_konfirmasi').html('');
			$.ajax({
				url:"lihat-validasi-pencairan-petani/"+id,
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
				url:"lihat-validasi-pencairan-petani/"+id,
				dataType:"json",
				success:function(html){
					$('#hidden_id2').val(html.data.id);
					$('.modal-title2').text("Konfirmasi");
					$('#action_button2').val("diproses");
					$('#status2').val("4");
					$('.text2').text("Apakah anda yakin ingin diproses?")
					$('#action2').val("diproses");
					$('#modalVerifikasi').modal('show');
				}
			})
		});

		$(document).on('click', '.pesan', function(){
			var id = $(this).attr('id');
			$('#form_pesan').html('');
			$.ajax({
				url:"lihat-validasi-pencairan-petani/"+id,
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
					url:"{{ route('admin.tolak-pencairan-petani.update') }}",
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
					url:"{{ route('admin.validasi-pencairan-petani.update') }}",
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