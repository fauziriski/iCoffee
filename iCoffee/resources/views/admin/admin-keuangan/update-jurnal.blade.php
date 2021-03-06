@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Laporan Jurnal')

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
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h5>Laporan Jurnal</h5>
			</div>
			<!-- Card Header - Dropdown -->
            <div class="row" style="padding-top:2%;"></div>
                <div class="col-md-12 ml-3">
					<div class="row">
               		 <input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" />
					<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" />
					<button type="button" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
				</div>
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
							</tr>
						</thead>
					</table>
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


				@endsection
				@section('js')
				
					<script>
						$(document).ready(function(){

							$('#id_tabel').DataTable({
								"paging":   false,
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
									url: "{{ route('adminkeuangan.update-jurnal') }}",
									dataType:"json"
								},
								columns:[

								{data: 'kode', name: 'kode'},
								{data: 'nama_tran', name:'nama_tran'},
								{data: 'created_at', name:'created_at'},
								{data: 'tujuan_tran', name:'tujuan_tran'},
								{data: 'total_jumlah', name:'total_jumlah'},

								]

							});

                            // $('#filter').click(function () {
                            //     var from_date = $('#from_date').val();
                            //     var to_date = $('#to_date').val();
                            //     if (from_date != '' && to_date != '') {
                            //         $('#id_tabel').DataTable().destroy();
                            //         load_data(from_date, to_date);
                            //     } else {
                            //         alert('Both Date is required');
                            //     }
                            // });

                            // $('#refresh').click(function () {
                            //     $('#from_date').val('');
                            //     $('#to_date').val('');
                            //     $('#id_tabel').DataTable().destroy();
                            //     load_data();
                            // });

                            });
                            

							$(document).on('click', '.lihat', function(){
								var id = $(this).attr('id');
								$.ajax({
									url:"detail-administrasi/"+id,
									dataType:"json",
									success:function(html){
										$('#modalLihat').modal('show');
										$('.modal-title').text("Detai Pencatatan");
										document.getElementById("kode2").innerHTML = html.data.kode;
										document.getElementById("nama_tran2").innerHTML = html.data.nama_tran;
										document.getElementById("created_at2").innerHTML = html.data.created_at;
										document.getElementById("tujuan_tran2").innerHTML = html.data.tujuan_tran;
										document.getElementById("catatan2").innerHTML = html.data.catatan;
										
										var img = "/Uploads/Adm_bukti/AKKA/" + html.data.bukti  +"";
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

					

					</script>

					<script>
							$(document).ready(function(){  
							$.datepicker.setDefaults({  
									dateFormat: 'yy-mm-dd'   
							});  
							$(function(){  
									$("#from_date").datepicker();  
									$("#to_date").datepicker();  
							}); 

							$('#filter').click(function () {
								var from_date = $('#from_date').val();
								var to_date = $('#to_date').val();
								if (from_date != '' && to_date != '') {
									$.ajax({
										url: "{{ route('adminkeuangan.update-jurnal') }}",
										method: "POST",
										data: {
											from_date: from_date,
											to_date: to_date,
											"_token": "{{ csrf_token() }}"
										},
										success: function (data, html) {
											if (data.error) {
												swal('Tidak ada', 'Tanggal inputan tidak ada', 'error');
											}
										}
									});
								} else {
									swal('Gagal', 'Silahkan pilih tanggal', 'error');
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

					</srcipt>	

                    
						@stop

