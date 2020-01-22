@extends('admin.layout.master')

@section('title', 'Admin | Jenis Produk')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Jenis Produk</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Tgl Pasang</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- <div id="modalLihat" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<span id="form_lihat"></span>
				<div class="form-group">
					<div class="form-group">
						<label class="control-label col-md-4" >Foto : </label>
						<div class="col-md-12">
							<c id="store_image1"></c>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Nama Perorangan : </label>
							<div class="col-md-12">
								<input type="text" id="nama_koperasi1" class="form-control" disabled/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Deskripsi : </label>
							<div class="col-md-12">
								<textarea type="text" id="deskripsi1" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4" >Alamat : </label>
							<div class="col-md-12">
								<textarea type="text" id="alamat1" class="form-control" disabled></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<label>Kartu Keluarga &nbsp;&nbsp;&nbsp;&nbsp;: </label>
							<span id="kk"></span>
						</div>
						<div class="col-md-6">
							<label>Surat Nikah &nbsp;: </label>
							<span id="surat_nikah"></span>
						</div>	
						<br />

					</div>
				</div>
			</div>
		</div> -->


		<div id="confirmModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>Konfirmasi</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<h5 align="center" style="margin:0;">Apakah anda yakin ingin menghapus produk?</h5>
					</div>
					<div class="modal-footer">
						<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
				{data: 'action', name: 'action',orderable: false}

				]
			});

			
			var id_produk;
			$(document).on('click', '.delete', function(){
				id_produk = $(this).attr('id');
				$('#confirmModal').modal('show');
			});

			$('#ok_button').click(function(){
				$.ajax({
					url:"hapus-produk/"+id_produk,
					success:function(data)
					{
						setTimeout(function(){
							$('#confirmModal').modal('hide');
							$('#table_id').DataTable().ajax.reload();
						}, 500);
					}
				})
			});

		});

	</script>
	@stop