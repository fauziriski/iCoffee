@extends('admin.layout.master')

@section('title', 'Laba-Rugi')

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
				<h5>Laporan Laba Rugi</h5>
			</div>
		<!-- Card Header - Dropdown -->
        <div class="row" style="padding-top:2%;"></div>
                <div class="container-fluid">
				<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-8">
					<div class="row mb-4">
						<form action="{{ route('adminkeuangan.laba-rugi-update') }}" method="POST" class="form-inline">
							{{ csrf_field() }}
							<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" required/>
							<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" required/>
							<button type="submit" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
						</form>
                    <a href="{{url('akses-adminkeuangan/cetak-laba-rugi')}}" class="btn btn-success ml-2"><i class="fa fa-print"></i> Download PDF</a>
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
                                    <th colspan="4" style="text-align: left">Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data1 as $pendapatan)
                                <tr>
                                    <td>{{$pendapatan->nama_akun}}</td>
                                    <td>Rp
                                        {{number_format($pendapatan->total)}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <th colspan="2" style="text-align: left">Total Pendapatan :</th>
                                    <th>Rp
                                        {{number_format($total_pendapatan)}}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="4" style="text-align: left">Beban Pengeluaran</th>
                                </tr>
                                @foreach($data2 as $pengeluaran)
                                <tr>
                                    <td>{{$pengeluaran->nama_akun}}</td>
                                    <td>Rp
                                        {{number_format($pengeluaran->total)}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <th colspan="2" style="text-align: left">Total Beban Pengeluaran :</th>
                                    <th>Rp{{number_format($total_beban)}}</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="text-align: left">Total Laba :</th>
                                    <th>Rp{{number_format($laba)}}</td>
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

