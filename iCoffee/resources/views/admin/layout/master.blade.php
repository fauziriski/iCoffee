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
	<link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="{{asset('admin/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
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

</head>
<body>
	@include('admin.layout.sidebar')
	@include('admin.layout.navbar')
	@yield('content')


	<!-- Page Wrapper -->
	<div id="wrapper">

	</div>
	@include('admin.layout.footbar')


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
<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('admin/assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{asset('admin/assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('admin/assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{asset('admin/assets/js/demo/chart-pie-demo.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script>
	$(document).ready(function() {
		$('#example').DataTable(

		{     

			"aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
			"iDisplayLength": 5

		} 
		);
	} );


	function checkAll(bx) {
		var cbs = document.getElementsByTagName('input');
		for(var i=0; i < cbs.length; i++) {
			if(cbs[i].type == 'checkbox') {
				cbs[i].checked = bx.checked;
			}
		}
	}
</script>

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 7, 2020 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo1").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      document.getElementById("demo2").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      document.getElementById("demo3").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      document.getElementById("demo4").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      document.getElementById("demo5").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

      document.getElementById("demo6").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo1").innerHTML = "EXPIRED";
        document.getElementById("demo2").innerHTML = "EXPIRED";
        document.getElementById("demo3").innerHTML = "EXPIRED";
        document.getElementById("demo4").innerHTML = "EXPIRED";
        document.getElementById("demo5").innerHTML = "EXPIRED";
        document.getElementById("demo6").innerHTML = "EXPIRED";
      }
    }, 1000);
    </script>

</body>

</html>