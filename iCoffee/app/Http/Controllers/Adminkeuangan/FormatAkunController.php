<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_kat_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use DB;
use DataTables;



class FormatAkunController extends Controller
{
	public function dataPelanggan(){

		// $kategori = Adm_kat_akun::All();
		// $hitung_kategori = count($kategori);


		// for($i=0; $i < $hitung_kategori; $i++){
		// 	$lihat_nama[] = $kategori[$i]->nama_kat;
			
			
		// 	$sub1[] = Adm_sub1_akun::Where('id_kat_akun', $kategori[$i]->id)->get();

		// 	$hitung_sub1[] = count($sub1);

		// 	for($j=0; $j < $hitung_sub1; $j++){
		// 		$lihat_sub1[] = $sub1[$i][$j]->nama_sub;

		// 		$sub2[] = Adm_sub2_akun::Where('id_kat_akun', $kategori[$i]->id)->Where('id_sub1_akun', $sub1[$i][$j]->id)->get();

		// 		$hitung_sub2  = count($sub2);

		// 		for($k=0; $k < $hitung_sub2; $k++){

		// 			$lihat_nama[] = $sub2[$i][$j][$k]->nama_sub;

		// 		}
		// 	}

		// }

		// dd($sub2);




		return view('admin.admin-keuangan.format-akun');
	}

	public function dataAdmin(){

		if(request()->ajax())
		{	

			$admin = Model_has_role::with('user')->whereRoleId(2)->get()->pluck('user');

			return datatables()->of($admin)
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>';
				$button .= '&nbsp;&nbsp;';
				$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.super-admin.data-administrator');
	}

	public function hapusPengguna($id)
	{

		$data = User::findOrFail($id);
		$data->delete();
		return view('admin.super-admin.data-pelanggan');

	}


}
