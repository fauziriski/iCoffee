<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_kat_akun;
use App\Akt_akun;
use DB;
use DataTables;
use Carbon;
use Validator;


class FormatAkunController extends Controller
{

	public function dataAkun(){

		if(request()->ajax())
		{	
			$akun = DB::table('akt_kat_akun')
			->join('akt_akun', 'akt_kat_akun.id', '=', 'akt_akun.id_kat_akun')
			->orderBy('no_akun')
			->get();
			
			return datatables()->of($akun)
			->addColumn('action', function($data){
				$button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})
			->rawColumns(['action'])
			->make(true);
		}

		$kategori = Akt_kat_akun::All();

		return view('admin.admin-keuangan.format-akun',compact('kategori'));
	}

	public function tambah(Request $request)
	{	
		$rules = array(	
			'id_kategori' =>  'required',
			'no_akun' =>  ['required','unique:akt_akun'],
			'nama_akun' => 'required'		
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$simpan = Akt_akun::create([
			'id_kat_akun' => $request->id_kategori,
			'no_akun' => $request->no_akun,
			'nama_akun' => $request->nama_akun,		
		]);


		return response()->json(['success' => 'Data berhasil ditambah.']);
	}


	public function hapus($id)
	{

		$data = Akt_akun::findOrFail($id);
		$data->delete();
		return response()->json();

	}


}
