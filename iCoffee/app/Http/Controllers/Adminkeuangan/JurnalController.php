<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_akun;
use DB;
use DataTables;
use Carbon;
use Validator;

class JurnalController extends Controller
{
    function index(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {

       $data = DB::table('akt_akun_jurnal')
       ->join('akt_jurnal', 'akt_akun_jurnal.id_akt_jurnal', '=', 'akt_jurnal.id')
       ->join('akt_akun', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
       ->select(
        'akt_akun_jurnal.debit',
        'akt_akun_jurnal.kredit',
        'akt_jurnal.created_at',
        'akt_jurnal.no_transaksi',
        'akt_akun_jurnal.no_jurnal',
        'akt_akun.no_akun',
        'akt_akun.nama_akun'
        )
         ->whereBetween('akt_jurnal.created_at', array($request->from_date, $request->to_date))
         ->orderBy('akt_jurnal.created_at')
         ->get();
       
      }
      else
      {

       $data = DB::table('akt_akun_jurnal')
       ->join('akt_jurnal', 'akt_akun_jurnal.id_akt_jurnal', '=', 'akt_jurnal.id')
       ->join('akt_akun', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')   
       ->select(
         'akt_akun_jurnal.debit',
         'akt_akun_jurnal.kredit',
         'akt_jurnal.created_at',
         'akt_jurnal.no_transaksi',
         'akt_akun_jurnal.no_jurnal',
         'akt_akun.no_akun',
         'akt_akun.nama_akun'
         )
         ->orderBy('akt_jurnal.created_at')
         ->get();
       
      }
      
      return datatables()->of($data)
		
			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})
           
			->make(true);
      
     }
     return view('admin.admin-keuangan.jurnal');
    }
}

