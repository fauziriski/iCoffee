<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mitra_koperasi;
use DB;
use DataTables;

class MitraKoperasiController extends Controller
{
	public function mitraKoperasi()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Mitra_koperasi::latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';;
				$button .= '&nbsp;&nbsp;';
				if ($data->status == "belum divalidasi") {
					$button .= 
					'<button type="button" name="verifikasi" id="'.$data->id.'" class="verifikasi btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';

				}
				return $button;
			})
			
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.mitra-koperasi');
	}

	public function validasiKoperasi($id)
	{
		if(request()->ajax())
		{
			$data = Mitra_koperasi::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function tolakKoperasi(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Mitra_koperasi::whereId($request->hidden_id)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}
	
}
