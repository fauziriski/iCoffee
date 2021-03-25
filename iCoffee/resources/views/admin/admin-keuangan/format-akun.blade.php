@extends('admin.layout.master')

@section('title', 'Admin Keuangan | Daftar Akun')

@section('content')


<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Daftar Akun</h1>
		</div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Akun</button>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="id_tabel" class="table table-striped table-bordered" border="1" style="width:100%">
						<thead>
							<tr>
								<th>No Akun</th>
								<th>Nama Akun</th>
								<th>Kategori Akun</th>
								<th>Saldo Normal</th>
								<th> </th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

<div id="formModal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Tambah Pencatatan</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body mt-3">
						<span id="form_result"></span>
						<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
							@csrf
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive">	
											<table cellpadding="10" border="1">
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Kategori Akun</th>	
														<th colspan="4"><select class="form-control" name="id_kategori" id="id_kategori" style="width: 100%">
															<option value="" selected>---- Pilih Kategori -----</option>
															@foreach($kategori as $key)
															<option value="{{$key->id}}">{{$key->nama_kategori}}</option>
															@endforeach
														</select></th>
													</div>	
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">Nama Akun</th>	
														<th colspan="4"><input type="text" name="nama_akun" id="nama_akun" class="form-control" style="width: 100%" /></th>
													</div>
												</tr>
												<tr>
													<div class="form-group">
														<th width="25%" style="text-align: center;">No Akun</th>	
														<th colspan="4"><input type="text" name="no_akun" id="no_akun" class="form-control" style="width: 100%" /></th>
													</div>
												</tr>
												</table>
										</div>
									</div>
								</div>
								<br />
								<div align="right">
									<input type="hidden" name="action" id="action" value="" />
									<input type="hidden" name="hidden_id" id="hidden_id" />
									<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Tambah" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



				@endsection
				@section('js')


				<script>
					$(document).ready(function(){

						$('#id_tabel').DataTable({
							paging:   false,
							dom: 'Bfrtip',
							buttons: [
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1,2,3]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3]
									}
							}           
							],  

							oLanguage: {
								"sProcessing":   "Sedang memproses ...",
								"sLengthMenu":   "Tampilkan _MENU_ entri",
								"sZeroRecords":  "Tidak ditemukan data yang sesuai",
								"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
								"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
								"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
								"sInfoPostFix":  "",
								"sSearch":       "Cari:",
								"sUrl":          "",
								"oPaginate": {
									"sFirst":    "Pertama",
									"sPrevious": "Sebelumnya",
									"sNext":     "Selanjutnya",
									"sLast":     "Terakhir"
								}
							},
							processing: true,
							serverSide: true,
							ajax:{
								url: "{{ route('adminkeuangan.format-akun') }}",
								dataType:"json",
							},
							columns:[

							{data: 'no_akun', name:'no_akun'},
							{data: 'nama_akun', name: 'nama_akun'},
							{data: 'nama_kategori', name:'nama_kategori'},
							{data: 'saldo_normal', name:'saldo_normal'},
							{data: 'action',name: 'action',orderable: false}

							]

						});

						$('#create_record').click(function(){
								$('.modal-title').text("Tambah Akun");
								$('#action_button').val("Tambah");
								$('#action').val("Tambah");
								$('#formModal').modal('show');
							});
							
							$('#sample_form').on('submit', function(event){
								event.preventDefault();
								if($('#action').val() == 'Tambah')
								{
									$.ajax({
										url:"{{ route('adminkeuangan.tambah-format-akun') }}",
										method:"POST",
										data: new FormData(this),
										contentType: false,
										cache:false,
										processData: false,
										dataType:"json",
										success: function (data)
										 {
												var html = '';
												if(data.errors)
												{
														html = '<div class="alert alert-danger">';
													for(var count = 0; count < data.errors.length; count++)
													{
														html += '<p>' + data.errors[count] + '</p>';
													}
													html += '</div>';
												}
												$('#form_result').html(html);
												if(data.success)
												{	
													$('#formModal').modal('hide');
													swal('Berhasil', 'Data berhasil ditambahkan', 'success');
													$('#id_tabel').DataTable().ajax.reload();
													$('#formModal').on('hidden.bs.modal', function(e) {
													$(this).find('#sample_form')[0].reset();
													});	
												}			
										}
									})
								}
							});

							
						$(document).on('click', '.delete', function () {
							var id = $(this).attr('id');
							swal({
								title: "Apakah anda yakin ingin menghapus ?",
								type: "warning",
								confirmButtonClass: "btn-danger",
								confirmButtonText: "Ya",
								showCancelButton: true
							}, function () {
								$.ajax({
									type: "GET",
									url:"hapus-format-akun/"+id,
									dataType: "json",
									success: function (data) {
										swal('Berhasil', 'Data berhasil dihapus', 'success');
										$('#id_tabel').DataTable().ajax.reload();
									}
								});
							});
						});
				
				

					});

				</script>


					@stop

