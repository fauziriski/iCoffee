@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Beranda')

@section('content')

@section('css')
<style>
.ui-datepicker {
	width: 450px;
	height: 300px;
	background: #4E73DF;
	border: 1px solid #555;
	color: #EEE;
}


</style>
@stop

<body id="page-top">
<div class="container-fluid">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h5 class="h5 mb-0 text-gray-800">Dashboard</h5>
			</div>
			<!-- Card Body -->

			
                <div class="col-md-6 ml-3">		
				<div class="row">
					<form action="{{ route('adminkeuangan.beranda.update') }}" method="POST" class="form-inline">
						{{ csrf_field() }}
						<select style="cursor:pointer;margin-top:1.5em;margin-bottom:1.5em;" class="form-control" id="tag_select" name="bulan">
							<option value="0" selected disabled> Pilih Bulan</option>
							<option value="01"> Januari</option>
							<option value="02"> Februari</option>
							<option value="03"> Maret</option>
							<option value="04"> April</option>
							<option value="05"> Mei</option>
							<option value="06"> Juni</option>
							<option value="07"> Juli</option>
							<option value="08"> Agustus</option>
							<option value="09"> September</option>
							<option value="10"> Oktober</option>
							<option value="11"> November</option>
							<option value="12"> Desember</option>
						</select>
					<div class="form-group">
					<button type="submit" class="btn btn-primary ml-3">Filter</button>
					</div>
					</form>
				</div>
			</div>
			
			

			<div class="card-body mb-5">

			<div class="row">
			<!-- Pemasukan Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-primary mb-1">Kas Penjualan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($masuk_jb)}}</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-arrow-alt-circle-down fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pengeluaran Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-success mb-1">Kas Masuk Pembiayaan</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($masuk_investasi)}}</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-arrow-alt-circle-down fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pengeluaran Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-info shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-info mb-1">Kas Masuk Mitra</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($masuk_mitra)}}</div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-arrow-alt-circle-down fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pending Requests Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-warning shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-warning mb-1">Total Kas Masuk</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($total_masuk)}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-wallet fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		


		<!-- Content Row -->

		<div class="row">

<!-- Pemasukan Hari ini Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-primary shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-sm font-weight-bold text-primary mb-1">Kas Keluar Penjualan</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($keluar_pen)}}</div>
				</div>
				<div class="col-auto">
					<i class="fa fa-arrow-alt-circle-up fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Pengeluaran Hari ini Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-success shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-sm font-weight-bold text-success mb-1">Kas Keluar Operasional</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($keluar_op)}}</div>
				</div>
				<div class="col-auto">
					<i class="fa fa-arrow-alt-circle-up fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Pengeluaran Hari ini Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-info shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-sm font-weight-bold text-info mb-1">Kas Keluar Mitra</div>
					<div class="row no-gutters align-items-center">
						<div class="col-auto">
						<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($keluar_mit)}}</div>
						</div>
					</div>
				</div>
				<div class="col-auto">
					<i class="fa fa-arrow-alt-circle-up fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
	<div class="card border-left-warning shadow h-100 py-2">
		<div class="card-body">
			<div class="row no-gutters align-items-center">
				<div class="col mr-2">
					<div class="text-sm font-weight-bold text-warning mb-1">Total Kas Keluar</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{number_format($total_keluar)}}</div>
				</div>
				<div class="col-auto">
					<i class="fas fa-wallet fa-2x text-gray-300"></i>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


		<!-- Content Row -->

		<div class="row">

			<!-- Area Chart -->
				<!-- Area Chart -->
				<div class="col-xl-8 col-lg-7">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Grafik Area</h6>
					
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myAreaChart"></canvas>
						</div>
						<div class="text-center small mt-3">
							<span class="mr-2">
								<i class="fas fa-stop" style="color:#DAA520"></i> Arus Kas Masuk
							</span>&nbsp;&nbsp;
							<span class="mr-2">
								<i class="fas fa-stop" style="color:#ADD8E6"></i> Arus Kas Keluar
							</span><br>
						</div>
					</div>
				</div>
			</div>

			

			<!-- Pie Chart -->
			<div class="col-xl-4 col-lg-5">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Kalender</h6>			
						</div>
					<!-- Card Body -->
					<div class="card-body">
					<div style="overflow:hidden;">
						<div class="form-group">
							<div class="row">
								<div class="col-md-8">
									<div id="datetimepicker12"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

	@endsection

	@section('js')
	<script type="text/javascript" src="{{asset('investasi/js/Chart.js')}}"></script>

	<script>
    $(function () {
        $('#datetimepicker12').datepicker({
			inline: true, sideBySide: true
		});
    });
</script>


<script>
			// Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#858796';

		function number_format(number, decimals, dec_point, thousands_sep) {
		// *     example: number_format(1234.56, 2, ',', ' ');
		// *     return: '1 234,56'
		number = (number + '').replace(',', '').replace(' ', '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
		}

		// Area Chart Example
		var ctx = document.getElementById("myAreaChart");
		var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
			datasets: [{
			yAxisID: 'Kas Masuk',
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.05)",
			borderColor: "rgb(253, 215, 3)",
			pointRadius: 3,
			pointBackgroundColor: "rgb(253, 215, 3)",
			pointBorderColor: "rgb(253, 215, 3)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgb(218, 165, 32)",
			pointHoverBorderColor: "rgb(218, 165, 32)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			data: <?php echo json_encode($pemasukan); ?>
			},
			{
			yAxisID: 'Kas Keluar',
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.05)",
			borderColor: "rgb(173, 216, 230)",
			pointRadius: 3,
			pointBackgroundColor: "rgb(173, 216, 230)",
			pointBorderColor: "rgb(173, 216, 230)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgb(70, 130, 180)",
			pointHoverBorderColor: "rgb(70, 130, 180)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			data: <?php echo json_encode($pengeluaran); ?>
			
			}]
		},
		options: {
			maintainAspectRatio: false,
			layout: {
			padding: {
				left: 10,
				right: 25,
				top: 25,
				bottom: 0
			}
			},
			scales: {
            yAxes: [{
                id: 'Kas Keluar',
                type: 'linear'
            }, {
                id: 'Kas Masuk',
                type: 'linear'
            }]
			},
			legend: {
			display: false
			},
			tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			titleMarginBottom: 10,
			titleFontColor: '#6e707e',
			titleFontSize: 14,
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			intersect: false,
			mode: 'index',
			caretPadding: 10,
			callbacks: {
				label: function(tooltipItem, chart) {
				var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
				return datasetLabel + number_format(tooltipItem.yLabel);
				}
			}
			}
		}
		});

	</script>


@stop

