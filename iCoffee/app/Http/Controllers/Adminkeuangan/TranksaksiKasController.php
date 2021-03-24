<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_jurnal;
use App\Akt_kat_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
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
			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

            ->rawColumns(['created_at'])
			->make(true);
      
     }
     return view('admin.admin-keuangan.tranksaksi-kas');
    }
}
