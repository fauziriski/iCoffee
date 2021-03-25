<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_akun;
use App\Akt_kat_akun;
use DB;
use DataTables;
use Carbon;

class NeracaSaldoController extends Controller
{
        function index(Request $request)
        {
    
         if(request()->ajax())
         {
            //     SELECT akt_akun.id,
            //    akt_akun.id_kat_akun,
            //    akt_akun.no_akun,
            //    akt_akun.nama_akun,
            //    SUM(akt_akun_jurnal.debit) AS sum_debit,
            //    SUM(akt_akun_jurnal.kredit) AS sum_kredit
            //     FROM akt_akun
            //     LEFT JOIN akt_akun_jurnal ON akt_akun_jurnal.id_akt_akun = akt_akun.id
            //     GROUP BY akt_akun.id

            if(!empty($request->from_date))
            {
                $data1 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->orderBy('no_akun')
                    ->get()->toArray();
            }
            else
            {
                $data1 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) as total_debit'), DB::raw('SUM(kredit) as total_kredit'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->orderBy('no_akun')
                    ->get()->toArray();
           
            }
            
            return datatables()->of($data1)
            ->addColumn('total_debit', function($data){
				if($data->id_kat_akun == 1 || 5 ){
                    $kosong = NULL;
                    $total_debit = $data->total_debit - $data->total_kredit;
                    if($total_debit < 0){
                        return $kosong;
                    }
                    return $total_debit;
                }else{
                    $total_debit = NULL;
                    return $total_debit;
                }
			})

            ->addColumn('total_kredit', function($data){
				if($data->id_kat_akun == 2 || 3 || 4){
                    $kosong = NULL;
                    $total_kredit = $data->total_kredit - $data->total_debit;
                    if($total_kredit < 0){
                        return $kosong;
                    }
                    return $total_kredit;
                }else{
                    $total_kredit = NULL;
                    return $total_kredit;
                }
			})

            ->rawColumns(['total_debit','total_kredit'])
			->make(true);

        }
         return view('admin.admin-keuangan.neraca-saldo');
        
        }

}