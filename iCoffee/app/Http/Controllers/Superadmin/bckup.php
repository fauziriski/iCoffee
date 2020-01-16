@extends('admin.layout.master')

@section('title', 'Super Admin | Data Customer')

@section('content')

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Data Pengguna</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>  Download Excel</a>
		</div>
		
		<div class="table-responsive">
			<table id="table_id" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Nama Pengguna</th>
						<th>Email Pengguna</th>
						<th>Begabung</th>	
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user as $data)
					<tr>
						<td>{{$data->name}}</td>
						<td>{{$data->email}}</td>
						<td>{{$data->created_at}}</td>
						<td><button type="button" name="edit" id="{{$data->id}}" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>&nbsp;&nbsp;

							<button type="button" name="delete" id="{{$data->id}}" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
						</tr>
						@endforeach
					</tbody>	
				</table>
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
					<h4 align="center" style="margin:0;">Apakah anda yakin ingin menghapus?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>


	@endsection
	@section('js')


	<script>
		$(document).ready(function(){
			$('#table_id').DataTable({
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
				dataType:"json",

			});

			
			var user_id;

			$(document).on('click', '.delete', function(){
				user_id = $(this).attr('id');
				$('#confirmModal').modal('show');
			});

			$('#ok_button').click(function(){
				$.ajax({
					url:"hapus-pengguna/"+user_id,
					success:function(data)
					{
						setTimeout(function(){
							$('#confirmModal').modal('hide');
							$('#table_id').DataTable().ajax.reload();
						}, 500);
					}
				})
			});

		});


	</script>
	@stop










	<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Model_has_role;
use DB;



class KelolaPenggunaController extends Controller
{
	public function dataPelanggan(){

			
			// $role = DB::table('model_has_roles')->where('role_id', '3')->get();
			// $pengguna = array();
			// foreach ($role as $data) {
			// 	$pengguna[] = DB::table('users')->where('id', $data->model_id)->get();
			// }

			// $pengguna = array('role' => $pengguna);
			// return json_encode($pengguna);
			$model_id = Model_has_role::select('model_id')->where('role_id', 3)->get();
			
			foreach ($model_id as $model_ids) {
				$pelanggan[] = User::where('id', $model_ids->model_id)->get();
			}

			dd($pelanggan);

			
		return view('admin.super-admin.data-pelanggan');
	}

	public function hapusPengguna($id)
	{

		$data = User::findOrFail($id);
		$data->delete();
		return view('admin.super-admin.data-pelanggan');

	}


}



		// $role = DB::table('model_has_roles')->where('role_id', '3')->get();
			// $pengguna = array();
			// foreach ($role as $data) {
			// 	$pengguna[] = DB::table('users')->where('id', $data->model_id)->get();
			// }

			// $pengguna = array('role' => $pengguna);
			// return json_encode($pengguna);