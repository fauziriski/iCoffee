@extends('admin.layout.master')

@section('title', 'Admin Web | Artikel Blog')

@section('content')

@section('css')

<style>

	@media (min-width: 360px) {
		.modal-img {
			width: 100%;
			height: 100%;

		}
	}

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
			width: 400%;
			height: 200%;
			margin-left: -150%;
		}
	}

	.select2-selection__rendered {
		line-height: 32px !important;
	}

	.select2-selection {
		height: 37px !important;
	}

	table{border-collapse:collapse}
	th{border:1px solid blue}

	input.form-control {
		width: auto;
	}

</style>

@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Artikel Blog</h1>
		</div>
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<a href="{{url('akses-adminweb/tambah-artikel')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-square"></i> Tambah Artikel</a>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-striped table-bordered" border="0" style="width:100%">
						<thead>
							<tr>
                                <th width="1%">No</th>
								<th width="15%">Judul</th>
								<th width="3%">Gambar</th>
                                <th width="10%">Kategori</th>
								<th width="15%">Tanggal Publish</th>
								<th width="10%"> </th>
							</tr>
						</thead>
                        <tbody>
                                @foreach ($artikel as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->judul}}</td>
                                    @if($item->gambar==null)
                                    <td>Gambar Tidak Ada</td>
                                    @else
                                    <td><img src="{{ asset('uploads/'.$item->gambar) }}" width="85px" height="55px" style="margin-left:5px"></td>
                                    @endif
                                    <td>{{$item->kategori_artikel->nama_kategori}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                    <a href="{{ route('adminweb.artikel.edit',$item->id) }}" class="edit btn btn-info btn-sm py-0 mb-1"><i class="fa fa-edit"></i>ubah</a>                     
                                    <a href="#" name="hapus" value="{{$item->id}}" type="button" class="delete btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-trash"></i> hapus </a>   

                                        </form>
                                     </td>
                                </tr>
                                @endforeach

                        </tbody>
					</table>
				</div>
			</div>
		</div>


  
@endsection
@section('js')
<script>
    $(function () {
        $('#example2').DataTable()
        $('#example1').DataTable({
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
										columns: [0,1]
									}
							}           
							],

                            
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>




<script>
    $(document).ready(function() {
        $('a[name="hapus"]').on('click', function() {
            var id = $(this).attr('value');
            swal({
                title: "Apakah Anda Yakin!?",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Hapus",
                showCancelButton: true,
            }, function() {
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: 'hapus-artikel/'+encodeURI(id),
                    dataType: "json",
                    success: function (data) {
                            swal(
                            'Berhasil',
                            'Hapus Alamat Berhasil',
                            'success'
                        );
                        location.reload();
                    }         
                });
            });
        });
    });

</script>
@stop
