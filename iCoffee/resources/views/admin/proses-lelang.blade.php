@extends('admin.layout.master')

@section('title', 'Admin | Proses Lelang')

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

	.modal-lg {
		width: 700%; /* New width for small modal */
	}

</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proses Lelang</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga Awal (Rp)</th>
						<th>Jumlah (Kg)</th>
						<th>Waktu Lelang</th>
						<th></th>					
					</tr>
				</thead>				
			</table>
		</div>
	</div>
</div>



<div id="modalLihatPenawaran" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="form-group">

						<div class="table-responsive">
							<table id="penawaran" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Penawaran</th>			
									</tr>
								</thead>
								<tbody>

								</tbody>			
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
										<th width="13%" style="text-align: right;">Nama Pemenang&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama_pemenang"></a></th>
										
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Harga Tawaran&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="penawaran2"></a></th>
										
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Nama Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama_produk2"></a></th>
										
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Harga Awal&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="harga_awal2"></a></th>
										
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Berat Produk&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="stok2"></a></th>
										

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

						ajax: '{{ route('admin.proses-lelang') }}',


						columns:[

						{data: 'kode_lelang', name:'kode_lelang'},
						{data: 'nama_produk', name:'nama_produk'},
						{data: 'harga_awal', name:'harga_awal'},
						{data: 'stok', name:'stok'},
						{
							'data': null,
							'render': function (data, type, row) {
								return '<p id="'+ data.id +'"></p>'

							}
						},
						{data: 'action', name: 'action',orderable: false},
						{data: 'desc_produk', name:'desc_produk', visible: false},
						{data: 'gambar', name:'gambar', visible: false},
						{data: 'tanggal_berakhir', name:'tanggal_berakhir', visible: false}


						]

					});

					$(document).on('click', '.lihat_pemenang', function(){
						var id = $(this).attr('id');
						$.ajax({
							url:"lihat-pemenang/"+id,
							dataType:"json",
							success:function(html){
								var pemenang = html.pemenang;
								var produk = html.produk;
								var kg = html.produk.stok+" kg";
								var rp = html.produk.harga_awal;
								var tawaran = pemenang.penawaran;

								var	reverse = rp.toString().split('').reverse().join(''),
								ribuan 	= reverse.match(/\d{1,3}/g);
								ribuan	= ribuan.join('.').split('').reverse().join('');

								var	reverse2 = tawaran.toString().split('').reverse().join(''),
								ribuan2 	= reverse2.match(/\d{1,3}/g);
								ribuan2	= ribuan2.join('.').split('').reverse().join('');

								$('#modalLihat').modal('show');
								$('.modal-title').text("Pemenang Lelang Sementara");
								document.getElementById("nama_pemenang").innerHTML = pemenang.nama;
								document.getElementById("penawaran2").innerHTML = "Rp. "+ribuan2;
								document.getElementById("nama_produk2").innerHTML = produk.nama_produk;
								document.getElementById("harga_awal2").innerHTML = "Rp. "+ribuan;
								document.getElementById("stok2").innerHTML = kg;

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


					$(document).on('click','.lihat_penawaran', function(){
						var id = $(this).attr('id');
						$('#modalLihatPenawaran').modal('show');
						$('#penawaran').DataTable({
							dom: 'Bfrtip',
							buttons: [
							'csv', 'excel', 'pdf'
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

							ajax: '{!! url('akses-admin/data-proses-lelang') !!}'+'/'+id,


							columns: [
							{ data: 'nama', name: 'nama' },
							{ data: 'penawaran', name: 'penawaran' }
							]

						});
						$('#modalLihatPenawaran').on('hidden.bs.modal', function () {
							$('#penawaran').dataTable().fnDestroy();
						});
					});
				});




			</script>

			<script>

				var  u = {!!json_encode($status)!!};
				var p = u;

				var length = p.length;
				for (i = 0; i < length; i++) {

					var x = setInterval(function() {
						for (i = 0; i < length; i++) {
							var array = p[i];
							var id = array.id;

							var y =  array.tanggal_berakhir;
							var count = new Date(y).getTime();

							var now = new Date().getTime();

							var distance = count - now;


							var days = Math.floor(distance / (1000 * 60 * 60 * 24));
							var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
							var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
							var seconds = Math.floor((distance % (1000 * 60)) / 1000);


							document.getElementById(id).innerHTML = days + "d " + hours + "h "
							+ minutes + "m " + seconds + "s ";


							if (distance < 0) {

								clearInterval(x);
								document.getElementById(id).innerHTML = "EXPIRED";
							}
						}

					}, 1000);
				}
			</script>

			@stop