<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Joint_account;
use App\Pengajuan_dana;
use App\Rincian_pengajuan;
use App\Mitra;
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
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm py-0 mb-1"><i class="fa fa-clock"></i> diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}elseif ($data->status == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp&nbsp' .
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
					$status = '<span class="badge badge-info">belum divalidasi</span>'; 
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-secondary">sedang diproses</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})


			->addColumn('total', function($data){
				$rp = "Rp. ";
				$total = $rp. number_format($data->total); 
				return $total;
			})


			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
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

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status1 = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "3") {
					$status1 = '<button type="button" class="btn btn-secondary btn-sm py-0">sedang diproses</button>';
				}elseif ($data->status == "2") {
					$status1 = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}else{
					$status1 = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}
			}

			$rincian = Rincian_pengajuan::where('pengajuan_dana_id',$id)->get();

			return response()->json([
				'data' => $data,
				'status1' => $status1,
				'rincian' => $rincian

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

	public function prosesPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

	public function validasiPencairanPetani(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);


		$up = Mitra::where('id_mitra',$request->id_mitra)->first();
		$up->update([
			'saldo' => $request->total_pengajuan
		]);

		Pengajuan_dana::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}


}