<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Confirm_payment;
use DB;
use DataTables;
use Carbon;
use Validator;



class DanaMasukJBController extends Controller
{
	public function danaMasuk(){

		if(request()->ajax())
		{	
			
			$AKMJB = Adm_jurnal::whereIn('id_kat_jurnal', [6,7])->get();

			return datatables()->of($AKMJB)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			->addColumn('total_jumlah', function($data){
				$rp = "Rp. ";
				$total_jumlah = $rp. number_format($data->total_jumlah); 
				return $total_jumlah;
			})

			
			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.admin-keuangan.dana-masuk-jualbeli');
	}

	public function hapus($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return view('admin.admin-keuangan.dana-masuk-jualbeli');

	}

	
	public function detailDanaMasuk($id)
	{
		if(request()->ajax())
		{	

			$data2 = Adm_akun::where('id_adm_jurnal',$id)->first();

			$data = Adm_jurnal::findOrFail($id);
			$total_jumlah = $data->total_jumlah;

			$ambil = Confirm_payment::where('jumlah_transfer',$total_jumlah)->first();
			$foto_bukti = $ambil->foto_bukti;
			$invoice = $ambil->invoice;

			if($ambil->jasa == 1){
				$path = "/Uploads/Konfirmasi_Pembayaran/JualBeli/";
			}else{
				$path = "/Uploads/Konfirmasi_Pembayaran/Lelang/";
			}

			return response()->json([
				'data2' => $data2,
				'data' => $data,
				'foto_bukti' => $foto_bukti,
				'invoice' => $invoice,
				'path' => $path
			]);
		}
	}



}
