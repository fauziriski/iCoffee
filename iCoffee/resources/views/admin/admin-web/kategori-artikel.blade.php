@extends('admin.layout.master')

@section('title', 'Admin | Kategori Artikel')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Kategori Artikel</h1>
		</div>
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Kategori</button>
			</div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table
                    id="kategori_table"
                    class="table table-striped table-bordered"
                    style="width:100%">
                    <thead>
						<tr>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
							<th>Update</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
				</div>
				</div>
			</div>
		</div>
	</div>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form
                    method="post"
                    id="sample_form"
                    class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <table border="0">
                            <div class="form-group">
                                <th width="25%" style="text-align: center;">Nama Kategori
                                </th>
                                <th colspan="4"><input type="text" name="nama_kategori" id="kategori" class="form-control"/></th>
                            </div>
                        </table>
                    
                    <br/>
                    <div align="right">
                        <input type="hidden" name="action" id="action"/>
                        <input type="hidden" name="hidden_id" id="hidden_id"/>
                        <input
                            type="submit"
                            name="action_button"
                            id="action_button"
                            class="btn btn-primary"
                            value="Tambah"/>
						</div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


	<div id="confirmModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Konfirmasi</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 align="center" style="margin:0;">Apakah anda yakin ingin menghapus?</h5>
				</div>
				<div class="modal-footer">
					<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')


<script>
	$(document).ready(function(){

		$('#kategori_table').DataTable({
			dom: 'Bfrtip',
			buttons: [
							{
								extend: 'pdf',
								footer: true,
								exportOptions: {
										columns: [0,1]
									}
							},
							{
								extend: 'csv',
								footer: false,
								exportOptions: {
										columns: [0,1]
									}
							},
							{
								extend: 'excel',
								footer: false,
								exportOptions: {
										columns: [0,1]
									}
							},
							{
								extend: 'print',
								footer: false,
								exportOptions: {
										columns: [0,1]
									}
							},
							{
								extend: 'copy',
								footer: false,
								exportOptions: {
										columns: [0,1]
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
				url: "{{ route('adminweb.kategori-artikel') }}",
				dataType:"json",
			},
			columns:[

			{data: 'nama_kategori', name: 'nama_kategori'},

            {data: 'slug', name: 'slug'},

			{data: 'updated_at', name:'updated_at'},

			{data: 'action',name: 'action',orderable: false}
			]
		});

		$('#create_record').click(function(){
			$('.modal-title').text("Tambah Kategori");
			$('#action_button').val("Tambah");
			$('#action').val("Tambah");
			$('#formModal').modal('show');
		});

		$(document).on('click', '.edit', function(){
			var id = $(this).attr('id');
			$('#form_result').html('');
			$.ajax({
				url:"edit-kategori/"+id,
				dataType:"json",
				success:function(html){
					$('#kategori').val(html.data.nama_kategori);
					$('#hidden_id').val(html.data.id);
					$('.modal-title').text("Edit Kategori");
					$('#action_button').val("Simpan");
					$('#action').val("Edit");
					$('#formModal').modal('show');
				}
			})
		});

		$('#sample_form').on('submit', function(event){
			event.preventDefault();
			if($('#action').val() == 'Tambah')
			{
				$.ajax({
					url:"{{ route('adminweb.kategori-artikel.store') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
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
						if(data.success){	
							$('#formModal').modal('hide');
							swal('Berhasil', 'Data berhasil ditambahkan', 'success');
							$('#kategori_table').DataTable().ajax.reload();
							$('#formModal').on('hidden.bs.modal', function(e) {
							$(this).find('#sample_form')[0].reset();
							});	
						}			
					}
				})
			}

			if($('#action').val() == "Edit")
			{
				$.ajax({
					url:"{{ route('adminweb.kategori-artikel.update') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
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
						if(data.success){	
							$('#formModal').modal('hide');
							swal('Berhasil', 'Data berhasil diubah', 'success');
							$('#kategori_table').DataTable().ajax.reload();
							$('#formModal').on('hidden.bs.modal', function(e) {
							$(this).find('#sample_form')[0].reset();
							});	
						}			
					}
				});
			}
		});


		var id_kategori;
		$(document).on('click', '.delete', function(){
			id_kategori = $(this).attr('id');
			$('#confirmModal').modal('show');
		});

		$('#ok_button').click(function(){
			$.ajax({
				url:"hapus-kategori/"+id_kategori,
				success:function(data)
				{
					setTimeout(function(){
						$('#confirmModal').modal('hide');
						$('#kategori_table').DataTable().ajax.reload();
					}, 500);
				}
			})
		});

	});

</script>
@stop

