@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Laporan Jurnal Umum')

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
				<h5>Laporan Jurnal Umum</h5>
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
								<th>No Jurnal</th>
								<th>No Tranksaksi</th>
								<th>Nama Tranksaksi</th>
								<th>Debit</th>
								<th>Kredit</th>
							</tr>
						</thead>
							<tfoot>
								<tr>
									<th colspan="4" style="text-align:right">TOTAL JUMLAH:</th>
									<th></th>
									<th></th>
								</tr>
						</tfoot>
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
						"footerCallback" : function (row, data, start, end, display) {
							var api = this.api(),data;
							var intVal = function (i) {
								return typeof i === 'string'
									? i.replace(/[\$,]/g, '') * 1
									: typeof i === 'number'
										? i
										: 0;
							};

							// Jumlah Kredit
							total = api.column(5).data().reduce(function (a, b) {
									return intVal(a) + intVal(b);
								}, 0);

							pageTotal1 = api.column(5, {page: 'current'}).data().reduce(function (a, b) {
									return intVal(a) + intVal(b);
								}, 0);

								var numFormat1 = $.fn.dataTable.render.number( '\,', '.', 0, 'Rp ' ).display;
								$( api.column( 5 ).footer() ).html( numFormat1( pageTotal1 ) );

							//jumlah debit

							total = api.column(4).data().reduce(function (a, b) {
									return intVal(a) + intVal(b);
								}, 0);

							pageTotal2 = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
									return intVal(a) + intVal(b);
								}, 0);
								var numFormat2 = $.fn.dataTable.render.number( '\,', '.', 0, 'Rp ' ).display;
								$( api.column( 4 ).footer() ).html( numFormat2( pageTotal2 ) );

							
						},

						"paging":   false,
								dom: 'Bfrtip',
								buttons: [
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1,2,3,4]
									},
									messageTop: 'Laporan jurnal.',
									download: 'open',
									 image: 'data:images/logo.png'
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
								url:'{{ route("adminkeuangan.jurnal.index") }}',
								data:{from_date:from_date, to_date:to_date}
							},
							columns: [
								{data: 'created_at', name:'created_at'},
								{data: 'no_jurnal', name: 'no_jurnal'},
								{data: 'no_tran', name: 'no_tran'},
								{data: 'nama_tran', name:'nama_tran'},
								{data: 'debit', name:'debit', render: $.fn.dataTable.render.number( '\,', '.', 0, 'Rp ' ).display},
								{data: 'kredit', name:'kredit', render: $.fn.dataTable.render.number( '\,', '.', 0, 'Rp ' ).display}
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

