@extends('admin.layout.master')

@section('title', 'Arus Kas')

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
				<h5>Laporan Arus Kas</h5>
			</div>
		<!-- Card Header - Dropdown -->
        <div class="row" style="padding-top:2%;"></div>
                <div class="container-fluid">
				<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-8">
					<div class="row mb-4">
						<form action="{{ route('adminkeuangan.arus-kas-update') }}" method="POST" class="form-inline">
							{{ csrf_field() }}
							<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" required/>
							<input type="text" name="to_date" id="to_date" class="form-control ml-3" placeholder="MM/DD/YYYY" required/>
							<button type="submit" name="filter" id="filter" class="btn btn-primary ml-3">Filter</button>
						</form>
                    <a href="{{url('akses-adminkeuangan/cetak-arus-kas')}}" class="btn btn-success ml-2"><i class="fa fa-print"></i> Download PDF</a>
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
                                    <th colspan="3" style="text-align: left">AKTIVITAS OPERASIONAL</th>
                                </tr>
                            </thead>
                            <tbody>
								<tr>
                                    <th colspan="3" style="text-align: left">Penerimaan Kas Dari :</th>
                                </tr>
                                @foreach($data1 as $pendapatan)
                                <tr>
                                    <td>{{$pendapatan->nama_akun}}</td>
									<td></td>
                                    <td>Rp {{number_format($pendapatan->total)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2" style="text-align: right">Total :</th>
									<th>Rp {{number_format($total_pendapatan)}}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" style="text-align: left">Pengeluaran Kas Untuk :</th>
                                </tr>
                                @foreach($data2 as $pengeluaran)
                                <tr>
                                    <td>{{$pengeluaran->nama_akun}}</td>
                                    <td>Rp {{number_format($pengeluaran->total)}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="2" style="text-align: right">Total :</th>
									<th>Rp {{number_format($total_beban)}}</th>
                                </tr>
                                <tr class="table-primary">
                                    <th colspan="2" style="text-align: left">ARUS KAS AKTIVITAS OPERASIONAL :</th>
                                    <th>Rp {{number_format($laba)}}</td>
                                </tr>
								<tr>
                                    <th colspan="3" style="height: 15px;"></th>
                                </tr>
								<tr>
                                    <th colspan="3" style="text-align: left">AKTIVITAS INVESTASI</th>
                                </tr>
								<tr>
                                    <th colspan="3" style="text-align: left">Pengeluaran untuk :</th>
                                </tr>
                                @foreach($investasi as $keluar)
                                <tr>
                                    <td>{{$keluar->nama_akun}}</td>
									<td></td>
                                    <td>Rp {{number_format($keluar->total)}}</td>
                                </tr>
                                @endforeach
								<tr class="table-primary">
                                    <th colspan="2" style="text-align: left">ARUS KAS AKTIVITAS INVESTASI :</th>
                                    <th>Rp {{number_format($total_investasi)}}</td>
                                </tr>
								<tr>
                                    <th colspan="3" style="height: 15px;"></th>
                                </tr>
								<tr>
                                    <th colspan="3" style="text-align: left">AKTIVITAS PENDANAAN</th>
                                </tr>
								<tr>
                                    <th colspan="3" style="text-align: left">Pengeluaran untuk :</th>
                                </tr>
                                <tr>
                                    <td></td>
									<td></td>
                                    <td>Rp 0</td>
                                </tr>
								<tr class="table-primary">
                                    <th colspan="2" style="text-align: left">ARUS KAS AKTIVITAS PENDANAAN :</th>
                                    <th>Rp 0</td>
                                </tr>
								<tr>
                                    <th colspan="3" style="height: 15px;"></th>
                                </tr>
								<tr>
                                    <th colspan="2" style="text-align: left">Penurunan Kas :</th>
                                    <th>Rp {{number_format($kas)}}</td>
                                </tr>
								<tr>
                                    <th colspan="2" style="text-align: left">Saldo Kas Awal :</th>
                                    <th>Rp {{number_format($modal)}}</td>
                                </tr>
								<tr class="table-primary">
                                    <th colspan="2" style="text-align: left">Saldo Kas Akhir :</th>
                                    <th>Rp {{number_format($saldo)}}</td>
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

