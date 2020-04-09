<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Joint_account;
use App\Pengajuan_dana;
use Carbon;


class  VerifikasiProgresController extends Controller
{
	public function dataPencairanPetani()
	{
		if(request()->ajax())
		{	
			$konfirmasi = Pengajuan_dana::All();

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
					$status = '<button type="button" class="btn btn-info btn-sm py-0 btn-block">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0 btn-block">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0 btn-block">ditolak</button>';
				}

				return $status;
			})

			->addColumn('total', function($data){
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

		return view('admin.validasi-progres');
	}


	public function lihatPencairanPetani($id)
	{
		if(request()->ajax())
		{
			$data = Pengajuan_dana::findOrFail($id);
			$user_id = $data->user_id;

			$ambil = Joint_account::where('user_id',$user_id)->first();
			$saldo_pengguna = $ambil->saldo;

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "4") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">diproses</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'saldo_pengguna' => $saldo_pengguna,
				'status' => $status,

			]);

		}
	}

	public function tolakPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}