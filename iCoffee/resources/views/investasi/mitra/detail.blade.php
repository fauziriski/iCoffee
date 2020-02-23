@extends('investasi.mitra.layout.master')

@section('title', 'Mitra Investasi | Beranda')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">{{$produk->nama_produk}}</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
		</div>

		<!-- Content Row -->
		<div class="row">

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Stok</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$qty}}/{{$produk->stok}}</div>
									</div>
									<div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar-animated bg-success" role="progressbar" style="width: {{$qty/$produk->stok*100}}%" aria-valuenow="{{$qty}}" aria-valuemin="0" aria-valuemax="{{$produk->stok}}"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-mug-hot fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-warning shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Investor</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$investor}}</div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-user fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dana Masuk</div>
								<div class="h6 mb-0 font-weight-bold text-gray-800">@money($total)</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-coins fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pending Requests Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dana Keluar</div>
								<div class="h6 mb-0 font-weight-bold text-gray-800">Rp. 3,000,000.00</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		

		<!-- Content Row -->

		<div class="row">

			<!-- Area Chart -->
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-success">Produk Detail</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <img  class="img-fluid" src="{{ asset('Uploads/Investasi/Produk/{'.$produk->kode_produk.'}/'.$produk->gambar) }}">
                            </div>
                            <div class="col-lg-8 col-sm-12">
                                <h5>{{$produk->nama_produk}} <span class="badge badge-success">Verified</span></h5>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <p>Harga: @money($produk->harga)</p>
										<p>Stok: {{$produk->stok}} Unit</p>
										<p>Kategori: Robusta</p>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
										<p>ROI: {{$produk->roi}}%/Tahun</p>
										<p>Periode: {{$produk->periode}} Tahun</p>
										<p>Periode Bagi Hasil: {{$produk->profit_periode}} Tahun</p>
									</div>
									
								</div>
								<p class="text-justify">{{$produk->detail_produk}}</p>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>

		<!-- Content Row -->
		<div class="row">

			<!-- Content Column -->
			<div class="col-lg-7 mb-4">

				<!-- Project Card Example -->
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-success">Projects</h6>
					</div>
					<div class="card-body">
						<div class="card-body">
							<div class="chart-area">
							  	<canvas id="myAreaChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-5 mb-4">

				<!-- Riwayat Order -->
				<div class="card">
					<div class="card-header py-3 bg-success d-flex flex-row align-items-center justify-content-between">
					  <h6 class="m-0 font-weight-bold text-light">Riwayat Order</h6>
					</div>
					@for($i= 0; $i <count($dana);$i++)
						<div class="customer-message align-items-center ml-3 mt-2">
							<a class="font-weight-bold text-success">
							<div class="text-truncate message-title">Telah Berhasil membeli {{$dana[$i]->qty}} Unit Produk Investasi anda!</div>
							<div class="small text-gray-500 message-time font-weight-bold">{{$nama[$i]->name}} · {{$dana[$i]->created_at}} WIB</div>
							</a>
						</div>
					@endfor
					  <div class="card-footer text-center">
						<a class="m-0 small text-success card-link" href="#">View More <i
							class="fas fa-chevron-right"></i></a>
					  </div>
					</div>
				  </div>

			</div>
		</div>

	</div>
	<!-- /.container-fluid -->
	

@endsection
@section('js')
<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#1cc88a';

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
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "#f2fcf3",
      borderColor: "#1cc88a",
      pointRadius: 3,
      pointBackgroundColor: "#1cc88a",
      pointBorderColor: "#1cc88a",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }],
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
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
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
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>

@endsection