<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kelompok_tani;
use DB;
use DataTables;
use Carbon;

class MitraKelompokController extends Controller
{
	public function kelompokTani()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Kelompok_tani::latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
				'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>';;
				$button .= '&nbsp;&nbsp;';
				if ($data->status == "1") {
					$button .= 
					'<button type="button" name="verifikasi" id="'.$data->id.'" class="verifikasi btn btn-success btn-sm py-0"><i class="fa fa-check"></i> validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0"><i class="fa fa-times"></i> tolak</button>';

				}
				return $button;
			})

			->addColumn('jumlah_petani', function($data){
				$petani = " petani";
				$jumlah_petani = $data->jumlah_petani.$petani;
				return $jumlah_petani;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})
			
			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})

			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.kelompok-tani');
	}

	public function validasiKelompok($id)
	{
		if(request()->ajax())
		{
			$data = Kelompok_tani::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function tolakKelompok(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Kelompok_tani::whereId($request->hidden_id)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}
}
