<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
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


class  VerifikasiBagiHasilController extends Controller
{
	public function dataBagiHasil()
	{
		if(request()->ajax())
		{	
			$konfirmasi = Balance_withdrawal::All();

			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm py-0 mb-1"><i class="fa fa-clock"></i> diproses</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>'; 
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';

				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "4") {
					$status = '<span class="badge badge-secondary">sedang diproses</span>';
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})

			->addColumn('jumlah', function($data){
				$rp = "Rp. ";
				$jumlah = $rp. number_format($data->jumlah); 
				return $jumlah;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-bagi-hasil');
	}


	public function lihatBagiHasil($id)
	{
		if(request()->ajax())
		{
			$data = Balance_withdrawal::findOrFail($id);
			$user_id = $data->user_id;

			$ambil = Joint_account::where('user_id',$user_id)->first();
			$saldo_pengguna = $ambil->saldo;

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "4") {
					$status = '<button type="button" class="btn btn-secondary btn-sm py-0">sedang diproses</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'saldo_pengguna' => $saldo_pengguna,
				'status' => $status,

			]);

		}
	}

	public function tolakBagiHasil(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiBagiHasil(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Balance_withdrawal::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}