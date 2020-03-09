<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Investor;
use App\User;
use DB;
use DataTables;
use Carbon;

class ValidasiInvestorController extends Controller
{
	public function dataInvestor()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Investor::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';

				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';
				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0 btn-block">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0 btn-block">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0 btn-block">validasi ditolak</button>';
				}

				return $status;
			})

			->addColumn('created_at', function($data){
				$created_at =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $created_at;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-investor');
	}

	public function idInvestor($id)
	{
		if(request()->ajax())
		{
			$data = Investor::findOrFail($id);
			$id_pengguna = $data->id_pengguna;
			$data2 = User::where('id',$id_pengguna)->first();
			
			return response()->json([
				'data' => $data,
				'data2' => $data2,
			]);
		}
	}

	public function tolakInvestor(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Investor::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiInvestor(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Investor::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}


}

