@extends('admin.layout.master')

@section('title', 'Admin | Data Hak Akses')

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
            <h5>Data Hak Akses</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table
                    id="example1"
                    class="table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
							<th>Nama</th>
                            <th>Tanggal Terdaftar</th>
                            <th>Role</th>
                            <th>Hak Akses</th>
							<th> </th>
                        </tr>
                    </thead>
                    <tbody>
                                @foreach ($datas as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td> 
                                    <td>{{$item->created_at->diffForHumans() }}</td>   
                                    <td>{{str_replace(array('[',']','"'),'', $item->roles()->pluck('name')) }}</td>
                                    <td>{{ str_replace(array('[',']','"'),'', $item->permissions()->pluck('name')) }}</td>
                                  
                                 
                                    <td>
                                          <a href="{{ route('superadmin.edit-akses',$item->id) }}" class="edit role btn btn-primary btn-sm py-0 mb-1"> ganti hak akses</a>                       
                                        </form>
                                     </td>
                                </tr>
                                @endforeach

                        </tbody>
                </table>
            </div>
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
    });

   
  
</script>
@stop