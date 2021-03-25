<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_jurnal;
use App\Akt_kat_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
use App\Akt_akun_jurnal;
use DB;
use DataTables;
use Carbon;
use Validator;

class TranksaksiKasController extends Controller
{
    function index(Request $request)
    {

     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
       $data = DB::table('akt_tujuan')
        ->join('akt_jurnal', 'akt_tujuan.id', '=', 'akt_jurnal.id_akt_tujuan')
         ->whereBetween('akt_jurnal.created_at', array($request->from_date, $request->to_date))
         ->orderBy('akt_jurnal.created_at')
         ->get();
         
      }
      else
      {
        // $year = Carbon::now()->format('Y');
        // $month = Carbon::now()->format('m');
        
       $data = DB::table('akt_tujuan')
       ->join('akt_jurnal', 'akt_tujuan.id', '=', 'akt_jurnal.id_akt_tujuan')
       ->orderBy('akt_jurnal.created_at')
       ->get();
      }
      
      return datatables()->of($data)
      ->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0"><i class="fa fa-eye"></i> Lihat Detail</button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

      ->rawColumns(['action','created_at'])
			->make(true);
      
     }
     return view('admin.admin-keuangan.tranksaksi-kas');
    }

    public function detailTransaksi($id)
	{

		if(request()->ajax())
		{	
			$data2 = Akt_akun_jurnal::where('id_akt_jurnal',$id)->get();
			$data = Akt_jurnal::findOrFail($id);
			$nama_tujuan = $data->akt_tujuan->nama_tujuan;

			foreach($data2 as $a){
				$ambil1[] = $a->id_akt_akun;
				$ambil2[] = $a->debit;
				$ambil3[] = $a->kredit;
				$ambil4[] = $a->no_jurnal;
			}

			$d = $ambil1[0];
			$k = $ambil1[1];
			$debit = $ambil2[0];
			$kredit = $ambil3[1];
			$no_jurnal = $ambil4[0];
			$akun1 = Akt_akun::whereId($d)->first();
			$akun2 = Akt_akun::whereId($k)->first();

			return response()->json([
				'data' => $data,
				'data2' => $data2,
				'nama_tujuan' => $nama_tujuan,
				'akun_debit' => $akun1->nama_akun,
				'akun_kredit' => $akun2->nama_akun,
				'debit' => $debit,
				'kredit' => $kredit,
				'no_jurnal' => $no_jurnal,
				'akun1' => $akun1->id,
				'akun2' => $akun2->id,
			]);
		}
	}
}
