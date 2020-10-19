@extends('admin.layout.master')

@section('title', 'Admin | Data Role')

@section('content')

@section('css')


@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5>Jenis Produk</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table
                    id="table_id"
                    class="table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
							<th>Nama</th>
							<th>Email</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Role</th>
							<th> </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Role</h5>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body mt-3">
						<span id="form_result"></span>
						<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
							@csrf							
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive col-md-12 col-sm-12">
											<table cellpadding="10" border="0">
													<div class="form-group">
														<th width="25%" style="text-align: center;">Pilih Role  </th>	
														<th colspan="4">
														<select class="form-control" style="width: 100%" name="role_baru" id="role_baru">
														<option value="" selected>----- Pilih Role -----</option>
															@foreach($list as $key)
															<option value="{{$key->id}}">{{$key->name}}</option>
															@endforeach
														</select></th>
													</div>	
												</tr>
										</table>
									</div>
								</div>
								<br />
								<div align="right">
									<input type="hidden" name="action" id="action" value="" />
									<input type="hidden" name="hidden_id" id="hidden_id" value=""/>
									<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Simpan" />
								</div>
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
					$('#table_id').DataTable({
						dom: 'Bfrtip',
						buttons: [
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1,2,3,4]
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

						ajax: '{{ route('superadmin.data-role') }}',

						columns:[

						{data: 'name', name:'name'},
                        {data: 'email', name:'email'},
                        {data: 'created_at', name:'created_at'},
						{data: 'role', name:'role'},
						{data: 'action', name: 'action',orderable: false}

						]
                    });

					$(document).on('click', '.edit', function(){
								var id = $(this).attr('id');
								$('#form_result').html('');
								$.ajax({
									url:"edit-role/"+id,
									dataType:"json",
									success:function(html){
										$('#hidden_id').val(html.data.model_id);
										$('.modal-title').text("Edit Role");
										$('#action_button').val("Simpan");
										$('#action').val("Simpan");
										$('#ModalEdit').modal('show');
										$('#form_result').html(html);
												
										$('#ModalEdit').on('hidden.bs.modal', function(e) {
											$(this).find('#sample_form')[0].reset();
											
										});

									}
								})
							});

							
							$('#sample_form').on('submit', function(event){
								event.preventDefault();
								if($('#action').val() == "Simpan")
								{
									$.ajax({
										url:"{{ route('superadmin.update-role') }}",
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
													$('#ModalEdit').modal('hide');
													swal('Berhasil', 'Data berhasil diubah', 'success');
													$('#table_id').DataTable().ajax.reload();
													$('#ModalEdit').on('hidden.bs.modal', function(e) {
													$(this).find('#sample_form')[0].reset();			
													});				
												}
											
										}
									});
								}
							});
						});
							
                    
               


			</script>

			@stop