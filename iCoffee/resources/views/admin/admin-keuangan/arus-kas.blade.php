@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Arus Kas')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<div class="card">
			<div class="card-header float-center"><h5>Laporan Arus Kas</h5></div>
			<div class="card-body">

				<div class="table-responsive">
					<table class="table" border="1" style="width:100%">
						<thead>
							<tr>
								<th width="10%">No</th>
								<th width="60%">Keterangan</th>
								<th width="30%">Jumlah Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($kategori as $key)
							<tr>
								<td>1</td>

								
								<td>{{$key->nama_kat}}</td>
							

								<td>aaa</td>
							</tr>
								@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

@endsection



