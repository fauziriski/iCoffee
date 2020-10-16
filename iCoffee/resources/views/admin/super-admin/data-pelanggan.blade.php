@extends('admin.layout.master')

@section('title', 'Super Admin | Data Pelanggan')

@section('content')


<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Data Pelanggan</h1>
		</div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Pelanggan</button>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="id_tabel" class="table table-striped table-bordered" border="0" style="width:100%">
				<thead>
					<tr>
						<th>Nama Pengguna</th>
						<th>Email Pengguna</th>
						<th>Daftar Pada</th>
						<th>Aksi</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna</h5>
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
					<table cellpadding="10" border="0">
						<tr>
                        		<div class="form-group">
								<th width="12%" style="text-align: right;">Nama Pelanggan&nbsp;&nbsp;&nbsp;:</th>	
								
								<th width="25%"><input type="text" name="name" id="name" class="form-control"/></th>
							</div>
						</tr>
						<tr>
							<div class="form-group">
								<th width="12%" style="text-align: right;">Email&nbsp;&nbsp;&nbsp;:</th>	
								
								<th width="25%"><input type="email" name="email" id="email" class="form-control"/></th>
							</div>
						</tr>
						<tr>
							<div class="form-group">
								<th width="12%" style="text-align: right;">Password&nbsp;&nbsp;&nbsp;:</th>
						
                                <th width="25%"><input type="password" name="password" id="password" class="form-control"/></th>
							</div>
                        </tr>
                        <tr>
							<div class="form-group">
								<th width="12%" style="text-align: right;">Confirm Password&nbsp;&nbsp;&nbsp;:</th>
							
                                <th width="25%"><input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/></th>
							</div>	
                        </tr>
							
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


<div id="modalLihat" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pelanggan</h5>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="form-group">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Nama Pelanggan&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="nama"></a></th>
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">No Hp&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="no_hp"></a></th>
									</div>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Provinsi&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="provinsi"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Kota/Kab&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="kota"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Kecamatan&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="kecamatan"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Kode Pos&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="kode_pos"></a></th>
										
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="13%" style="text-align: right;">Alamat&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><a id="alamat"></a></th>
										
									</div>
								</tr>
								</table>
								</div>
								</div>
							

						<br />
					<div align="right">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
</div>


@endsection
@section('js')


<script>
	$(document).ready(function(){
//read
$('#id_tabel').DataTable({
	dom:'Bfrtip', buttons:[{ extend: 'pdf', footer: true, exportOptions: { columns: [0,1,2] } }, { extend: 'csv', footer: false, exportOptions: { columns: [0,1,2] } }, { extend: 'excel', footer: false, exportOptions: { columns: [0,1,2] } }, { extend: 'print', footer: false, exportOptions: { columns: [0,1,2] } }, { extend: 'copy', footer: false, exportOptions: { columns: [0,1,2] } }],

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

	ajax: '{{ route('superadmin.data-pelanggan') }}',

	columns:[

	{data: 'name', name: 'name'},

	{data: 'email', name:'email'},

	{data: 'created_at', name:'created_at'},

	{data: 'action',name: 'action',orderable: false}
	]
});

$('#create_record').click(function(){
			$('.modal-title').text("Tambah Pelanggan");
			$('#action_button').val("Tambah");
			$('#action').val("Tambah");
			$('#formModal').modal('show');
		});

		$(document).on('click', '.edit', function(){
			var id = $(this).attr('id');
			$('#form_result').html('');
			$.ajax({
				url:"edit-pelanggan/"+id,
				dataType:"json",
				success:function(html){
					$('#name').val(html.data.name);
					$('#hidden_id').val(html.data.id);
					$('#email').val(html.data.email);
					$('.modal-title').text("Edit Pelanggan");
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
					url:"{{ route('superadmin.pelanggan.store') }}",
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
						$('#form_result').html(html);
						if(data.success){	
							$('#formModal').modal('hide');
							swal('Berhasil', 'Data berhasil ditambah', 'success');
							$('#id_tabel').DataTable().ajax.reload();
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
					url:"{{ route('superadmin.pelanggan.update') }}",
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
						$('#form_result').html(html);
						if(data.success){	
							$('#formModal').modal('hide');
							swal('Berhasil', 'Data berhasil diubah', 'success');
							$('#id_tabel').DataTable().ajax.reload();
							$('#formModal').on('hidden.bs.modal', function(e) {
							$(this).find('#sample_form')[0].reset();
							});	
						}
					}
				});
			}
		});


$(document).on('click', '.lihat', function () {
    var id = $(this).attr('id');
    $.ajax({
        url: "lihat-pelanggan/" + id,
        dataType: "json",
        success: function (html) {


            $('#modalLihat').modal('show');
            $('.modal-title').text("Detail Pelanggan");
			document.getElementById("nama").innerHTML = html.data.nama;
			document.getElementById("no_hp").innerHTML = html.data.no_hp;
			document.getElementById("provinsi").innerHTML = html.provinsi;
			document.getElementById("kota").innerHTML = html.kota;
			document.getElementById("kecamatan").innerHTML = html.data.kecamatan;
			document.getElementById("kode_pos").innerHTML = html.data.kode_pos;
			document.getElementById("alamat").innerHTML = html.data.address;

        }
    })
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
            url: "hapus-pelanggan/" + id,
            dataType: "json",
            success: function (data) {
                swal('Berhasil', 'Data berhasil dihapus', 'success');
                $('#id_tabel')
                    .DataTable()
                    .ajax
                    .reload();
            }
        });
    });
});

});


	

</script>
@stop