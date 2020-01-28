@extends('admin.layout.master')

@section('title', 'Admin | Proses Lelang')

@section('content')

@section('css')
http://live.datatables.net/moxajuri/1/edit
<style>

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
			width: 300%;
			height: 200%;
			margin-left: -100%;
		}
	}
</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Proses Lelang</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Harga Awal (Rp)</th>
						<th>Jumlah (Kg)</th>
						<th>Waktu Lelang</th>
						<th></th>					
					</tr>
				</thead>
				<tbody>
					@foreach($products as $data)
					<tr>
						<td>{{ $data->kode_lelang }}</td>
						<td>{{ $data->nama_produk }}</td>
						<td>{{ $data->harga_awal }}</td>
						<td>{{ $data->stok }}</td>
						<td><p class="demo" id="{{ $data->id }}"></p></td>
						<td>
							<button type="button" name="lihat_penawaran" id="{{$data->id}}" class="lihat_penawaran btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat Penawaran</button>&nbsp;&nbsp;
							<button type="button" name="lihat_pemenang" id="{{$data->id}}" class="lihat_pemenang btn btn-success btn-sm"><i class="fa fa-trophy"></i> Lihat Pemenang</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


<script>
    // Set the date we're counting down to
    var sis = 27;

    var data = {!!json_encode($data->tanggal_berakhir)!!};
    var  u = {!!json_encode($products)!!};
    var p = u;

    

    var length = p.length;
    var panjang =  {!!json_encode($panjang)!!};
    for (i = 0; i < length; i++) {
    
    var x = setInterval(function() {
    	for (i = 0; i < length; i++) {
    		var array = p[i];
    		var id = array.id;

    		var y =  array.tanggal_berakhir;
    		var count = new Date(y).getTime();
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = count - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById(id).innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";




      // If the count down is over, write some text 
      if (distance < 0) {

      	clearInterval(x);
      	document.getElementById(id).innerHTML = "EXPIRED";
      }
  }

}, 1000);
}
</script>


@endsection