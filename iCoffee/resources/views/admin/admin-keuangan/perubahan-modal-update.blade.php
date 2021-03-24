@extends('admin.layout.master')

@section('title', 'Perubahan Modal')

@section('content')

@section('css')

<style>

    table {
        border-collapse: collapse;
    }


</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h5>Laporan Perubahan Modal</h5>
			</div>
				<!-- Card Header - Dropdown -->
            <div class="row" style="padding-top:2%;"></div>
                <div class="container-fluid">
				<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-8">
					<div class="row mb-4">
                    <form action="{{ route('adminkeuangan.perubahan-modal-update') }}" method="POST" class="form-inline">
					{{ csrf_field() }}
					<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" required/>
					<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" required/>
					<button type="submit" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
                    </form>
                    <form action="{{ route('adminkeuangan.cetak-perubahan-modal-update') }}" method="POST" class="form-inline">
					{{ csrf_field() }}
                    <input type="text" name="from_date" value="{{$from_date}}" hidden/>
					<input type="text" name="to_date" value="{{$to_date}}" hidden/>
                    <button type="submit" class="btn btn-success ml-2"><i class="fa fa-print"></i> Download PDF</a>
                    </form>
				</div>
                </div>
                </div>
                </div>
           
			<!-- Card Body -->
			<div class="card-body">
            <div class="container">
				<div class="table-responsive">
                        <table class="table table-bordered border-primary" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Modal</th>
                                    <th>Saldo Laba</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Saldo, {{$periode}}</td>
                                    <td>Rp {{number_format($modal)}}</td>
                                    <td></td>
                                    <td>Rp {{number_format($modal)}}</td>
                                </tr>    
                                <tr>
                                    <td>Laba/Rugi</td>
                                    <td></td>
                                    <td>Rp {{number_format($laba)}}</td>
                                    <td>Rp {{number_format($laba)}}</td>
                                </tr>
                                <tr class="table-primary">
                                    <th>Saldo, {{$periode}}</th>
                                    <th>Rp {{number_format($modal)}}</th>
                                    <th>Rp {{number_format($laba)}}</th>
                                    <th>Rp {{number_format($saldo)}}</th>
                                </tr>
                            </tbody>
                        </table>
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

