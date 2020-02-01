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