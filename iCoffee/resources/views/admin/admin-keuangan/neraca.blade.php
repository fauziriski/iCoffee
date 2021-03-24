@extends('admin.layout.master')

@section('title', 'Laporan Neraca')

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
				<h5>Laporan Neraca</h5>
			</div>
			<!-- Card Header - Dropdown -->
            <div class="row" style="padding-top:2%;"></div>
                <div class="container-fluid">
				<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-8">
					<div class="row mb-4">
						<form action="{{ route('adminkeuangan.neraca-update') }}" method="POST" class="form-inline">
							{{ csrf_field() }}
							<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" required/>
							<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" required/>
							<button type="submit" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
						</form>
                    <a href="{{url('akses-adminkeuangan/cetak-neraca')}}" class="btn btn-success ml-2"><i class="fa fa-print"></i> Download PDF</a>
				</div>
             </div>
			 </div>
 		</div>
           
				<!-- Card Body -->
				<div class="card-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="table-responsive">
									<table class="table table-bordered border-primary">
										<thead>
											<tr>
												<th colspan="2" style="text-align: center">AKTIVA</th>
											</tr>
										</thead>
										<tbody>
											@foreach($aktiva as $lancar)
											<tr>
												<td>{{$lancar->nama_akun}}</td>
												<td>Rp
													{{number_format($lancar->total)}}</td>
											</tr>
											@endforeach
											<tr>
												<th colspan="2"></th>
											</tr>
											<tr class="table-primary">
												<th style="text-align: center">TOTAL AKTIVA :</th>
												<th>Rp
													{{number_format($total_aktiva)}}</th>
											</tr>
										</tbody>
									</table>
									</div>
									</div>

									<div class="col-md-6">
										<div class="table-responsive">
											<table class="table table-bordered border-primary">
												<thead>
													<tr>
														<th colspan="2" style="text-align: center">PASIVA</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<th colspan="2">Liabilitas</th>	
													</tr>
													<tr>
														<td>Hutang</td>
														<td>Rp {{number_format($total_hutang)}}</td>
													</tr>
													<tr>
														<th>Total Hutang</th>
														<th>Rp {{number_format($total_hutang)}}</th>
													</tr>
													<tr>
														<th colspan="2"></th>
													</tr>
													<tr>
														<th colspan="2">Ekuitas</th>	
													</tr>
													<tr>
														<td>Laba Ditahan</td>
														<td>Rp {{number_format($saldo)}}</td>
													</tr>
													<tr>
														<th>Total Ekuitas</th>
														<th>Rp {{number_format($saldo)}}</th>
													</tr>
													<tr>
														<th colspan="2"></th>
													</tr>
													<tr class="table-primary">
														<th style="text-align: center">TOTAL PASIVA :</th>
														<th>Rp {{number_format($saldo)}}</th>
													</tr>
												</tbody>
											</table>
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
				
                });
                
		    	</script>
			@stop

