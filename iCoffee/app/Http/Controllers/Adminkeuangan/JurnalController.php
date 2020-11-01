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

class JurnalController extends Controller
{
    function index(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
       $data = DB::table('adm_akun')
         ->whereBetween('created_at', array($request->from_date, $request->to_date))
         ->get();
         
      }
      else
      {

       $data = DB::table('adm_akun')
       ->join('adm_jurnal', 'adm_akun.id_adm_jurnal', '=', 'adm_jurnal.id')
       ->get();
       
      }
      
      return datatables()->of($data)
		
			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			// ->addColumn('debit', function($data){
			// 	$rp = "Rp. ";
			// 	$debit = $rp. number_format($data->debit); 
			// 	return $debit;
      // })
      
			// ->addColumn('kredit', function($data){
			// 	$rp = "Rp. ";
			// 	$kredit = $rp. number_format($data->kredit); 
			// 	return $kredit;
      // })
           
			->make(true);
      
     }
     return view('admin.admin-keuangan.jurnal');
    }
}

