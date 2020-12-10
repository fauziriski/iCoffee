<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>@yield('title')</title>

	<!-- Custom fonts for this template-->
	<link href="{{asset('investasi/mitra/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="{{asset('investasi/mitra/css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css') }}"/>
	
	<style type="text/css">
		table{
			width:100%;
		}
		#example_filter{
			float:right;
		}
		#example_paginate{
			float:right;
		}
		label {
			display: inline-flex;
			margin-bottom: .5rem;
			margin-top: .5rem;
		}


	</style>
	@livewireStyles
	@yield('css')

</head>
<body>
	@section('sidebar')
	@include('investasi.mitra.layout.sidebar')
	@show

	@section('navbar')
	@include('investasi.mitra.layout.navbar')
	@show

	@yield('content')

	@include('sweetalert::alert')
	<!-- Page Wrapper -->
	<div id="wrapper">

	</div>
	


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="login.html">Logout</a>
			</div>
		</div>
	</div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{asset('investasi/mitra/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="{{asset('investasi/js/bootstrap.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('investasi/mitra/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{asset('investasi/mitra/vendor/chart.js/Chart.min.js')}}"></script>
{{-- <script src="{{asset('investasi/mitra/js/demo/chart-area-demo.js')}}"></script>   --}}

<!-- Custom scripts for all pages-->
<script src="{{asset('investasi/mitra/js/sb-admin-2.min.js') }}"></script>
<script src="{{asset('investasi/mitra/js/medium-lightbox.js') }}"></script>


<!------ Include the above in your HEAD tag ---------->

<script type="text/javascript" src="{{asset('DataTables/datatables.min.js') }}"></script>
@livewireScripts
@yield('js')




</body>

</html>