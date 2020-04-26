@extends('admin.layout.master')

@section('title', 'Admin | Beranda')

@section('content')

@section('css')
<style>
.ui-datepicker {
	width: 490px;
	height: 300px;
	background: #4E73DF;
	border: 1px solid #555;
	color: #EEE;
}


</style>
@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
		</div>

		<!-- Content Row -->
		<div class="row">

			<!-- Pemasukan (Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-primary mb-1">Jumlah Produk Jual Beli</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-th-large fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<!-- Pemasukan Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-success mb-1">Jumlah Produk Lelang</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-th-large fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Pemasukan Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-info shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-info mb-1">Jumlah Produk Investasi</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
									<div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-th-large fa-2x text-gray-300"></i>
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
								<div class="text-sm font-weight-bold text-warning mb-1">Total Produk Terpasang</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">17</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chart-pie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
	

			<!-- Pemasukan Hari ini Card Example -->
			<div class="col-xl-3 col-md-6 mb-4">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-sm font-weight-bold text-primary mb-1">Jumlah Tranksaksi Hari Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
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
								<div class="text-sm font-weight-bold text-success mb-1">Jumlah Tranksaksi Bulan Ini</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">17</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
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
								<div class="text-sm font-weight-bold text-info mb-1">Jumlah Tranksaksi Tahun Ini</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
									<div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
									</div>
								</div>
							</div>
							<div class="col-auto">
								<i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
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
								<div class="text-sm font-weight-bold text-warning mb-1">Seluruh Tranksaksi</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">42</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-chart-pie fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Content Row -->

		<div class="row">

			<!-- Area Chart -->
			<div class="col-xl-4 col-lg-7">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Grafik Tranksaksi</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myBarChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-7">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Grafik Produk Kategori Terlaris</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myPieChart"></canvas>
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

	@endsection

	@section('js')

	<script src="{{asset('admin/assets/vendor/chart.js/Chart.min.js') }}"></script>
	<script src="{{asset('admin/assets/js/demo/chart-bar-demo.js') }}"></script> 
	<script src="{{asset('admin/assets/js/demo/chart-pie-demo.js') }}"></script> 

	<script>
    $(function () {
        $('#datetimepicker12').datepicker({
			inline: true, sideBySide: true
		});
    });
</script>

@stop

