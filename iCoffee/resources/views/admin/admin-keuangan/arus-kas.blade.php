@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Arus Kas')

@section('content')

<body id="page-top">
	<div class="container-fluid">

		<div class="card shadow mb-4">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h5>Laporan Arus Kas</h5>
				<div class="dropdown no-arrow">			
					<button class="btn btn-success btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-filter"></i> Pencarian Tanggal</button>		
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"  style="width: 200%;">
						<div class="container">
							<p class="mt-2"><strong>Tanggal Awal</strong></p>
							<input type="text" name="from_date" id="from_date" class="form-control" placeholder="MM/DD/YYYY" />
							<p class="mt-2"><strong>Tanggal Ahkir</strong></p>
							<input type="text" name="to_date" id="to_date" class="form-control" placeholder="MM/DD/YYYY" />
							<input type="submit" name="filter" id="filter" class="btn btn-primary mt-3" value="Tampilkan" />
						</div>
					</div>
				</div>
			</div>

				<div class="card-body mt-3">
					<div class="table-responsive">
						<table cellpadding="5" border="0" style="width: 100%;">
							<tr cellpadding="1">
								<th colspan="3" style="text-align: center;">
									<h5>PT. ICOFFEE</h5>
								</th>
							</tr>
							<tr>
								<th colspan="3" style="text-align: center;">
									<h5><strong>Laporan Arus Kas</strong></h5>
								</th>
							</tr>
							<tr>
								<th colspan="3" style="text-align: center;">
									<h5>Periode 02 February 2020 s.d 29 February 2020</h5>
								</th>
							</tr>
						</table>
						<table cellpadding="10" class="table mt-5" border="0" style="width:100%">
							<tr>
								<td><strong>A. </strong></td>
								<td><strong>ARUS KAS DARI AKTIVITAS OPERASIONAL</strong></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Operasional :</td>
								<td></td>
							</tr>
							@foreach($ambil6 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS MASUK DARI AKTIVITAS OPERASIONAL :</strong></td>
								<td>@money($total6)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Operasional :</td>
								<td></td>
							</tr>
							@foreach($ambil1 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS OPERASIONAL :</strong></td>
								<td>@money($total1)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td><strong>B. </strong></td>
								<td><strong>ARUS KAS DARI AKTIVITAS JUAL/BELI</strong></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>1.&nbsp;&nbsp; Arus Kas Masuk - Jual/Beli :</td>
								<td></td>
							</tr>
							@foreach($ambil7 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS MASUK DARI AKTIVITAS JUAL/BELI :</strong></td>
								<td>@money($total7)</td>
							</tr>
							<tr rowspan="2">
								<td colspan="3"></td>
							</tr>
							<tr>
								<td></td>
								<td>2.&nbsp;&nbsp; Arus Kas Keluar - Jual/Beli :</td>
								<td></td>
							</tr>
							@foreach($ambil2 as $key)	
							<tr>
								<td></td>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
								<td>@money($key->total)</td>
							</tr>
							@endforeach
							<tr>
								<td></td>
								<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS JUAL/BELI :</strong></td>
								<td>@money($total2)</td>
							</tr>
							<tr>
								<tr>
									<td colspan="3"></td>
								</tr>

								<tr>
									<td><strong>C. </strong></td>
									<td><strong>ARUS KAS DARI AKTIVITAS LELANG</strong></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1.&nbsp;&nbsp; Arus Kas Masuk - Lelang :</td>
									<td></td>
								</tr>
								@foreach($ambil8 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS MASUK DARI AKTIVITAS LELANG :</strong></td>
									<td>@money($total8)</td>
								</tr>
								<tr rowspan="2">
									<td colspan="3"></td>
								</tr>
								<tr>
									<td></td>
									<td>2.&nbsp;&nbsp; Arus Kas Keluar - Lelang :</td>
									<td></td>
								</tr>
								@foreach($ambil3 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS LELANG :</strong></td>
									<td>@money($total3)</td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>

								<tr>
									<td><strong>D. </strong></td>
									<td><strong>ARUS KAS DARI AKTIVITAS INVESTASI</strong></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1.&nbsp;&nbsp; Arus Kas Masuk - Investasi :</td>
									<td></td>
								</tr>
								@foreach($ambil9 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS MASUK DARI AKTIVITAS INVESTASI :</strong></td>
									<td>@money($total9)</td>
								</tr>
								<tr rowspan="2">
									<td colspan="3"></td>
								</tr>
								<tr>
									<td></td>
									<td>2.&nbsp;&nbsp; Arus Kas Keluar - Investasi :</td>
									<td></td>
								</tr>
								@foreach($ambil4 as $key)	
								<tr>
									<td></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{$key->nama_akun}}</td>
									<td>@money($key->total)</td>
								</tr>
								@endforeach
								<tr>
									<td></td>
									<td><strong>TOTAL KAS KELUAR DARI AKTIVITAS INVESTASI :</strong></td>
									<td>@money($total4)</td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="3"></td>
								</tr>
							</table>
						</div>
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
           $(function(){  
                $("#from_date").datepicker();  
                $("#to_date").datepicker();  
           }); 

		$('#filter').click(function () {
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();
			if (from_date != '' && to_date != '') {
				$.ajax({
					url: "{{ route('adminkeuangan.update-aruskas') }}",
					method: "POST",
					data: {
						from_date: from_date,
						to_date: to_date,
						"_token": "{{ csrf_token() }}"
					},
					success: function (data, html) {
						if (data.error) {
							swal('Tidak ada', 'Tanggal inputan tidak ada', 'error');
						}
					}
				});
			} else {
				swal('Gagal', 'Silahkan pilih tanggal', 'error');
			}
		});
	});  

	</script>

	@stop

