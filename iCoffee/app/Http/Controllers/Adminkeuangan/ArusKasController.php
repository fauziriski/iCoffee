<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_jurnal;
use App\Adm_kat_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Adm_arus_kas;
use DB;
use DataTables;
use Carbon;
use Validator;

class ArusKasController extends Controller
{
	public function lihat(){

		// arus kas keluar
		$kode1 = "AKK-A";
		$ambil1 = Adm_arus_kas::where('kode',$kode1)->get();
		$total1 = Adm_arus_kas::where('kode',$kode1)->select('total')->sum('total');

		$kode2 = "AKK-JB";
		$ambil2 = Adm_arus_kas::where('kode',$kode2)->get();
		$total2 = Adm_arus_kas::where('kode',$kode2)->select('total')->sum('total');

		$kode3 = "AKK-L";
		$ambil3 = Adm_arus_kas::where('kode',$kode3)->get();
		$total3 = Adm_arus_kas::where('kode',$kode3)->select('total')->sum('total');

		$kode4 = "AKK-I";
		$ambil4 = Adm_arus_kas::where('kode',$kode4)->get();
		$total4 = Adm_arus_kas::where('kode',$kode4)->select('total')->sum('total');

		//arus kas masuk
		$kode6 = "AKM-A";
		$ambil6 = Adm_arus_kas::where('kode',$kode6)->get();
		$total6 = Adm_arus_kas::where('kode',$kode6)->select('total')->sum('total');

		$kode7 = "AKM-JB";
		$ambil7 = Adm_arus_kas::where('kode',$kode7)->get();
		$total7 = Adm_arus_kas::where('kode',$kode7)->select('total')->sum('total');

		$kode8 = "AKM-L";
		$ambil8 = Adm_arus_kas::where('kode',$kode8)->get();
		$total8 = Adm_arus_kas::where('kode',$kode8)->select('total')->sum('total');

		$kode9 = "AKM-I";
		$ambil9 = Adm_arus_kas::where('kode',$kode9)->get();
		$total9 = Adm_arus_kas::where('kode',$kode9)->select('total')->sum('total');



		return view('admin.admin-keuangan.arus-kas',compact(
			'ambil1','total1',
			'ambil2','total2',
			'ambil3','total3',
			'ambil4','total4',
			'ambil6','total6',
			'ambil7','total7',
			'ambil8','total8',
			'ambil9','total9',
		));
	}

	public function update(Request $request)
	{
		$from_date = $request->from_date;
		$to_date = $request->to_date;
		$cek_tanggal = Adm_jurnal::whereBetween('created_at',[$from_date, $to_date])->get();

		//Arus Kas Keluar Administrasi
		if(empty($cek_tanggal) || !isset($cek_tanggal[0])) {
			return response()->json(['error' => "Tanggal tidak ada"]);
		}else{
			$AKKA = Adm_jurnal::whereBetween('created_at',[$from_date, $to_date])->where('id_kat_jurnal','2')->get();
			foreach($AKKA as $data){
				$jml[]= $data->total_jumlah;
				$id_jurnal[]= $data->id;
				$total_jumlah = array_sum($jml);
			}

			$akun = Adm_akun::whereIn('id_adm_jurnal',$id_jurnal)
				->where('posisi','Kredit')
				->select('nama_akun', DB::raw('SUM(jumlah) as total_jumlah'))
                ->groupBy('nama_akun')
				->get()
				->toArray();		

			return view('admin.admin-keuangan.laporan-arus-kas',compact(
				'akun','total_jumlah'
			));
			
		}

		

	}
}
