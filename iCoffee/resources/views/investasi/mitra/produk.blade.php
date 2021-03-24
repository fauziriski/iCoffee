@extends('investasi.mitra.layout.master')

@section('title', 'Investasi | Mitra Investasi')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Produk Investasi</h1>
			<a href="/mitra/pasang-investasi" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i>  Tambah Produk</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Profit (%/Tahun)</th>
						<th>Periode</th>
						<th>Periode Return</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
@endsection
@section('js')
	<script>
			$(document).ready(function(){
				$('#table_id').DataTable({

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

					ajax: '{{ route('investasi.mitra.produk') }}',

					columns:[

					{data: 'nama_produk', name:'nama_produk'},
					{data: 'harga', name:'harga'},
					{data: 'stok', name:'stok'},
					{data: 'roi', name:'roi'},
					{data: 'periode', name:'periode'},
					{data: 'profit_periode', name:'profit_periode'},
					{data: 'proses', name:'proses'},
					{data: 'action', name: 'action',orderable: false},

					]
				});
			});
	</script>
@endsection