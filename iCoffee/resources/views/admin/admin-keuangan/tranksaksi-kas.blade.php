@extends('admin.layout.master')

@section('title', 'Tranksaksi Kas')

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
				<h5>Tranksaksi Kas</h5>
			</div>
			<!-- Card Header - Dropdown -->
            <div class="row" style="padding-top:2%;"></div>
                <div class="col-md-12 ml-3">
					<div class="row">
               		 <input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" />
					<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" />
					<button type="button" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
					<button type="button" name="refresh" id="refresh" class="btn btn-danger ml-2">Reset</button>
				</div>
                </div>
           
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="order_table" class="table table-striped table-bordered" border="0" style="width:100%">
						<thead>
							<tr>
								<th>Tanggal</th>
								<th>No Tranksaksi</th>
								<th>Nama Tranksaksi</th>
								<th>Tujuan Tranksaksi</th>
								<th>Jumlah Tranksaksi</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		</div>
	
				@endsection
				@section('js')
				
				<script>
						$(document).ready(function(){
						$.datepicker.setDefaults({
							dateFormat: 'yy-mm-dd'
						});
						$(function () {
							$("#from_date").datepicker();
							$("#to_date").datepicker();
						});

					load_data();

					function load_data(from_date = '', to_date = '')
					{
					$('#order_table').DataTable({
						"paging":   false,
								dom: 'Bfrtip',
								buttons: [
							{
								extend: 'pdfHtml5',
								footer: false,
								// messageTop: 'Laporan jurnal.',
								download: 'open',
								customize: function ( doc ) {
									doc.content.splice( 1, 0, {
										margin: [ 0, 0, 0, 12 ],
										alignment: 'center',
										image: 'data:image/png;base64,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'
									} );
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
							processing: true,
							serverSide: true,
							ajax: {
								url:'{{ route("adminkeuangan.tranksaksi-kas.index") }}',
								data:{from_date:from_date, to_date:to_date}
							},
							columns: [
								{data: 'created_at', name:'created_at'},
								{data: 'no_transaksi', name: 'no_transaksi'},
								{data: 'nama_transaksi', name:'nama_transaksi'},
								{data: 'nama_tujuan', name:'nama_tujuan'},
								{data: 'total_jumlah', name:'total_jumlah', render: $.fn.dataTable.render.number( '\,', '.', 0, 'Rp ' ).display}
							]
							});
							}

							$('#filter').click(function(){
							var from_date = $('#from_date').val();
							var to_date = $('#to_date').val();
							if(from_date != '' &&  to_date != '')
							{
								$('#order_table').DataTable().destroy();
								load_data(from_date, to_date);
							}
							else
							{
								swal('Gagal', 'Silahkan pilih tanggal', 'error');
							}
							});

							$('#refresh').click(function(){
								$('#from_date').val('');
								$('#to_date').val('');
								$('#order_table').DataTable().destroy();
								load_data();
							});
						});
					</script>
					@stop

