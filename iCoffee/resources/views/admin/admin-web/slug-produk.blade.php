@extends('admin.layout.master')

@section('title', 'Admin Web | Slug Produk')

@section('content')

@section('css')


@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h5 class="h3 mb-0 text-gray-800">Slug Produk</h5>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="example1" class="table table-striped table-bordered" border="0" style="width:100%">
						<thead>
							<tr>
                                <th width="1%">No</th>
								<th width="15%">Publish</th>
								<th width="25%">Nama Produk</th>
                                <th width="40%">Hyperlink</th>
							</tr>
						</thead>
                        <tbody>
                                @foreach ($produk as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->updated_at->diffForHumans()}}</td>
                                    <td>{{$item->nama_produk}}</td>
                                    <td>  
                                  
									<input type="text" id="copy_{{ $item->id }}" value="https://icoffee.id/jual-beli/produk/{{$item->slug}}" style="width:70%;">
                        			<button value="copy" onclick="copyToClipboard('copy_{{ $item->id }}')" class="success btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-link"></i> Copy</button>  
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
    function copyToClipboard(id) {
        document.getElementById(id).select();
        document.execCommand('copy');
    }
</script>
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

                            
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })

</script>


@stop
