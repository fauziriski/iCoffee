@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Kas Masuk Penjualan')

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
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h5>Kas Masuk Penjualan</h5>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="id_tabel" class="table table-striped table-bordered" border="0" style="width:100%">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>No Tranksaksi</th>
								<th>Nama Tranksaksi</th>
								<th>Tujuan Tranksaksi</th>
								<th>Jumlah Tranksaksi</th>
								<th> </th>
							</tr>
						</thead>
					</table>
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
                                        <th width="35%" style="text-align: right;">No Jurnal&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="no_jurnal2"></a>
                                        </th>
                                    </div>
                                </tr>
                                <tr>
                                    <div class="form-group">
                                        <th width="35%" style="text-align: right;">Nama Tranksaksi&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                        <th colspan="4">
                                            <a id="nama_transaksi2"></a>
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
                                            <th width="40%">Nama Akun&nbsp;&nbsp;:</th>
											<th width="15%">Posisi&nbsp;&nbsp;:</th>
                                            <th width="20%">Jumlah&nbsp;&nbsp;:</th>
                                        </div>
                                    </tr>
                                   
                                    <tr>
                                        <div class="form-group">
                                            <th>
                                                <a id="akun_debit2"></a>
                                            </th>
											<th>
                                                <a>Debit</a>
                                            </th>
                                            <th>
                                                <a id="debit2"></a>
                                            </th>
                                        </div>
                                    </tr>
									<tr>
                                        <div class="form-group">
                                            <th>
                                                <a id="akun_kredit2"></a>
                                            </th>
											<th>
                                                <a>Kredit</a>
                                            </th>
                                            <th>
                                                <a id="kredit2"></a>
                                            </th>
                                        </div>
                                    </tr>
                                  
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
				<script src="{{asset('Jualbeli/plugins/customPlugin/rupiahFormat.js')}}"></script>

					<script type="text/javascript">				
						var harga = document.getElementById('jumlah1');
						harga.addEventListener('keyup', function(e){
							harga.value = formatRupiah(this.value, 'Rp ');
						});
		
						var harga2 = document.getElementById('jumlah22');
						harga2.addEventListener('keyup', function(e){
							harga2.value = formatRupiah(this.value, 'Rp ');
						});

					</script>
				
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
									url: "{{ route('adminkeuangan.dana-masuk-jualbeli') }}",
									dataType:"json",
								},
								columns:[

								{data: 'created_at', name:'created_at'},
								{data: 'no_transaksi', name: 'no_transaksi'},
								{data: 'nama_transaksi', name:'nama_transaksi'},
								{data: 'nama_tujuan', name:'nama_tujuan'},
								{data: 'total_jumlah', name:'total_jumlah'},
								{data: 'action',name: 'action',orderable: false},
								{data: 'bukti', name:'bukti', visible: false}

								]

							});


							$(document).on('click', '.lihat', function(){
								var id = $(this).attr('id');
								$.ajax({
									url:"detail-dana-masuk-jualbeli/"+id,
									dataType:"json",
									success:function(html){
										$('#modalLihat').modal('show');
										$('.modal-title').text("Detail Pencatatan");

										document.getElementById("no_jurnal2").innerHTML = html.no_jurnal;
										document.getElementById("nama_transaksi2").innerHTML = html.data.nama_transaksi;
										document.getElementById("created_at2").innerHTML = html.data.created_at;
										document.getElementById("tujuan_tran2").innerHTML = html.nama_tujuan;
										document.getElementById("catatan2").innerHTML = html.data.catatan;
										
										var img = "/Uploads/" + html.data.bukti  +"";
										$('#bukti2').attr("src",img);

											var debit = html.debit;
											var kredit = html.kredit;

											var	reverse = debit.toString().split('').reverse().join(''),
											debit_ribuan 	= reverse.match(/\d{1,3}/g);
											debit_ribuan	= debit_ribuan.join('.').split('').reverse().join('');

											var	reverse = kredit.toString().split('').reverse().join(''),
											kredit_ribuan 	= reverse.match(/\d{1,3}/g);
											kredit_ribuan	= kredit_ribuan.join('.').split('').reverse().join('');
											
											document.getElementById("akun_debit2").innerHTML = html.akun_debit;
											document.getElementById("akun_kredit2").innerHTML = html.akun_kredit;
											document.getElementById("debit2").innerHTML = "Rp "+debit_ribuan;
											document.getElementById("kredit2").innerHTML = "Rp "+kredit_ribuan;

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
									url:"hapus-dana-masuk-jualbeli/"+id,
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

