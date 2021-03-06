@extends('admin.layout.master')

@section('title', 'Admin | Jenis Produk')

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
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5>Jenis Produk</h5>
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
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Terdaftar</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
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
										<th width="13%" style="text-align: right;">Harga Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="harga"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Stok Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="stok"></a></th>
										
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
													<img src="" id="foto{{$i}}" width="100px" height="100px" style="margin-bottom: 5px;" />
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

						ajax: '{{ route('admin.jenis-produk') }}',

						columns:[

						{data: 'kode_produk', name:'kode_produk'},
						{data: 'nama_produk', name:'nama_produk'},
						{data: 'harga', name:'harga'},
						{data: 'stok', name:'stok'},
						{data: 'created_at', name:'created_at'},
						{data: 'action', name: 'action',orderable: false},
						{data: 'detail_produk', name:'detail_produk', visible: false},
						{data: 'gambar', name:'gambar', visible: false}

						]
					});

					$(document).on('click', '.lihat', function(){
						var id = $(this).attr('id');
						$.ajax({
							url:"lihat-produk/"+id,
							dataType:"json",
							success:function(html){
								var kg = html.data.stok+" kg";
								var rp = html.data.harga;

								var	reverse = rp.toString().split('').reverse().join(''),
								ribuan 	= reverse.match(/\d{1,3}/g);
								ribuan	= ribuan.join('.').split('').reverse().join('');
								

								$('#modalLihat').modal('show');
								$('.modal-title').text("Detail Produk");
								document.getElementById("nama_produk").innerHTML = html.data.nama_produk;
								document.getElementById("harga").innerHTML = "Rp. "+ribuan;
								document.getElementById("stok").innerHTML = kg;
								document.getElementById("detail_produk").innerHTML = html.data.detail_produk;
								document.getElementById("kode_produk").innerHTML = html.data.kode_produk;

								var lihat = html.data_gambar;
								var panjang = lihat.length;

								for(var i = 0; i<panjang; i++){
									var nama_gambar = lihat[i].nama_gambar;
									var kode_produk = lihat[i].kode_produk;
									var img = "/Uploads/Produk/"+ kode_produk +"/"+ nama_gambar +"";
									$("#foto"+i).attr("src",img);

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
							url:"hapus-produk/"+id,
							dataType: "json",
							success: function (data) {
								swal('Berhasil', 'Data berhasil dihapus', 'success');
								$('#table_id')
									.DataTable()
									.ajax
									.reload();
							}
						});
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