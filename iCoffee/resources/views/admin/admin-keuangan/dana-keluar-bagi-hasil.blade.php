@extends('admin.layout.master')

@section('title', 'Admin | Rincian Bagi Hasil')

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
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5>Rincian Bagi Hasil</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">

		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Tanggal Setoran</th>
                        <th>Kode Produk</th>
						<th>Kode Mitra</th>
						<th>Total Berat</th>
						<th>Total Penjualan</th>	
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Rincian Bagi Hasil</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="table-responsive col-md-12 col-sm-12">
                            <table cellpadding="10" border="0">
                                <tr>
                                    <div class="form-group">
                                        <th width="50%" style="text-align: right;">Nama Produk&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="nama_produk"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="50%" style="text-align: right;">Nama Mitra&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="nama_mitra"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="50%" style="text-align: right;">Total Unit&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="unit"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="50%" style="text-align: right;">Periode&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="periode"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="50%" style="text-align: right;">Total Investasi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="modal"></a>
                                        </th>
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
                                            <th width="40%">Keterangan&nbsp;&nbsp;:</th>
											<th width="15%"></th>
                                            <th width="20%"></th>
                                        </div>
                                    </tr>
                                    <tr>
                                        <th>Total Penjualan</th>
                                        <th></th>
                                        <th><a id="penjualan"></a></th>
                                    </tr>
                                    <tr>
                                        <th>Biaya Produksi</th>
                                        <th></th>
                                        <th><a id="biaya_produksi"></a></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"><strong>Pendapatan Bersih  :</strong></th>
                                        <th><strong><a id="pendapatan_bersih"></strong></a></th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:right;">Pendapatan Mitra/Petani (40%)</th>
                                        <th><a id="pendapatan_mitra"></a></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:right;">Pendapatan Investor (40%)</th>
                                        <th><a id="pendapatan_investor"></a></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:right;">Pendapatan iCoffee (20%)</th>
                                        <th><a id="icoffee"></a></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th><strong><a id="pendapatan_bersih2"></strong></a></th>
                                    </tr>
                                </table>
								</div>
                            </div>

                            <div class="table-responsive">
                        <div class="row">
                        <div class="col-md-12 col-sm-12" id="tabel_rincian" style="margin-top: -20%;">
				</div><br>
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

			ajax: '{{ route('adminkeuangan.dana-keluar-bagi-hasil') }}',
            

			columns:[

			{data: 'created_at', name:'created_at'},
			{data: 'kode_produk', name:'kode_produk'},
            {data: 'id_mitra', name:'id_mitra'},		
			{data: 'total_berat', name:'total_berat'},
			{data: 'total_penjualan', name:'total_penjualan'},
			{data: 'action', name: 'action',orderable: false}

			]
		});

		$(document).on('click', '.lihat', function(){
			var id = $(this).attr('id');
			$.ajax({
				url:"detail-dana-keluar-bagi-hasil/"+id,
				dataType:"json",
				success:function(data1){
             
					$('#modalLihat').modal('show');
					$('.modal-title').text("Detail Rincian Bagi Hasil");
					document.getElementById("nama_produk").innerHTML = data1.nama_produk;
					document.getElementById("nama_mitra").innerHTML = data1.nama_mitra;
					document.getElementById("unit").innerHTML = data1.unit+" Unit";
                    document.getElementById("periode").innerHTML = data1.periode+ " Tahun";
					document.getElementById("modal").innerHTML = "Rp "+data1.modal;
                    document.getElementById("biaya_produksi").innerHTML = "Rp "+data1.biaya_produksi;
                    document.getElementById("penjualan").innerHTML = "Rp "+data1.total_penjualan;
                    document.getElementById("pendapatan_bersih").innerHTML = "Rp "+data1.pendapatan_bersih;
                    document.getElementById("pendapatan_bersih2").innerHTML = "Rp "+data1.pendapatan_bersih;
                    document.getElementById("icoffee").innerHTML = "Rp "+data1.icoffee;
                    document.getElementById("pendapatan_mitra").innerHTML = "Rp "+data1.pendapatan_mitra;
                    document.getElementById("pendapatan_investor").innerHTML = "Rp "+data1.pendapatan_mitra;

					var table_header = "<table cellpadding='10' border='1' style='margin-bottom: 5%;'><tr style='background-color: #4e73df; color: white;'><div class='form-group'><th style='text-align: center;'>Nama Investor&nbsp;&nbsp;</th><th style='text-align: center;'>No Rekening&nbsp;&nbsp;</th><th style='text-align: center;'>Jumlah&nbsp;&nbsp;</th><th style='text-align: center;'>Modal&nbsp;&nbsp;</th><th style='text-align: center;'>Keuntungan&nbsp;&nbsp;</th>";
					var table_footer = "<tr><th colspan='2' style='text-align: center;'><strong>Total</strong></th><th style='text-align: center;'><strong>"+data1.unit+" Unit</strong></th><th style='text-align: center;'><strong>Rp "+data1.modal+"</strong></th><th style='text-align: center;'><strong>Rp "+data1.pendapatan_mitra+"</strong></th></tr></table></div>"
					var html = "";

					data1.list_investor.forEach(function(data2){

					var harga = data2.total;
					var	reverse1 = harga.toString().split('').reverse().join(''),
					harga_rp 	= reverse1.match(/\d{1,3}/g);
					harga_rp	= harga_rp.join(',').split('').reverse().join('');

                    
					
                    var str = data2.keuntungan;
                    str = str.toString();
                    a = str.slice(0,-2);
                    var untung = parseInt(a);

					var	reverse1 = untung.toString().split('').reverse().join(''),
					untung_rp 	= reverse1.match(/\d{1,3}/g);
					untung_rp	= untung_rp.join(',').split('').reverse().join('');
            

						html += "<tr><th style='text-align: center;'>"+data2.name+"<th style='text-align: center;'>"+data2.norek+"<th style='text-align: center;'>"+data2.qty+" Unit<th style='text-align: center;'>Rp "+harga_rp+"</th></th></th></th></th><th style='text-align: center;'>Rp "+untung_rp+"</th></br>";
					});
					
					var all = table_header +html+ table_footer;
					document.getElementById("tabel_rincian").innerHTML = all;
					
					
				}
			})
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