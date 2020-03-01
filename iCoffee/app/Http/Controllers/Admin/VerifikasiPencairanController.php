<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Balance_withdrawal;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Joint_account;
use Carbon;


class  VerifikasiPencairanController extends Controller
{
	public function dataPencairan()
	{
		if(request()->ajax())
		{	
			$konfirmasi = Balance_withdrawal::All();

			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm"><i class="fa fa-clock"></i> Diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>'; 
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = "belum divalidasi";
				}elseif ($data->status == "4") {
					$status = "diproses";
				}elseif ($data->status == "3") {
					$status = "divalidasi";
				}else{
					$status = "ditolak";
				}

				return $status;
			})

			->addColumn('jumlah', function($data){
				$rp = "Rp. ";
				$jumlah = $rp. number_format($data->jumlah); 
				return $jumlah;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $waktu;
			})

			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-pencairan-dana');
	}


	public function lihatPencairan($id)
	{
		if(request()->ajax())
		{
			$data = Balance_withdrawal::findOrFail($id);
			$user_id = $data->user_id;

			$ambil = Joint_account::where('user_id',$user_id)->first();
			$saldo_pengguna = $ambil->saldo;

			return response()->json([
				'data' => $data,
				'saldo_pengguna' => $saldo_pengguna

			]);

		}
	}

	public function tolakPencairan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiPencairan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}