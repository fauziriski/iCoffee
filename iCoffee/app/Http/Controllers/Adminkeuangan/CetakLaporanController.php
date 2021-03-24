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
use PDF;

class CetakLaporanController extends Controller
{
    function labaRugi(Request $request){

        if(!empty($request->from_date))
        {
            $data1 = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(kredit) - SUM(debit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                ->where('id_kat_akun', 4)
                ->orderBy('no_akun')
                ->get()->toArray();

            $data2 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) - SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 5)
                    ->orderBy('no_akun')
                    ->get()->toArray();
                
            $jumlah1 = [];
            foreach($data1 as $jml){
                $jumlah1[] = $jml->total;
            }
            $total_pendapatan = array_sum($jumlah1);

            $jumlah2 = [];
            foreach($data2 as $jml){
                $jumlah2[] = $jml->total;
            }

            $total_beban = array_sum($jumlah2);
            $laba = $total_pendapatan - $total_beban;
           
            $periode = date('d/M/Y', strtotime($request->to_date));

            $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.laba-rugi', compact('data1','data2','total_pendapatan','total_beban','laba','periode'));
            return $pdf->download('laporan-laba-rugi');


        }else{
            
            $year = Carbon::now()->format('Y');
            $periode = Carbon::now()->format('d/M/Y');
            $data1 = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(kredit) - SUM(debit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                ->where('id_kat_akun', 4)
                ->orderBy('no_akun')
                ->get()->toArray();

            $data2 = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(debit) - SUM(kredit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                ->where('id_kat_akun', 5)
                ->orderBy('no_akun')
                ->get()->toArray();
                
                $jumlah1 = [];
                foreach($data1 as $jml){
                    $jumlah1[] = $jml->total;
                }
                $total_pendapatan = array_sum($jumlah1);

                $jumlah2 = [];
                foreach($data2 as $jml){
                    $jumlah2[] = $jml->total;
                }
                $total_beban = array_sum($jumlah2);
                $laba = $total_pendapatan - $total_beban;

                $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.laba-rugi', compact('data1','data2','total_pendapatan','total_beban','laba','periode'));
                return $pdf->download('laporan-laba-rugi');
        }

    }

    function perubahanModal(Request $request){
        if(!empty($request->from_date))
        {
            $data1 = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(kredit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                 ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                ->where('id_kat_akun', 3)->where('nama_akun', 'LIKE', '%modal%')
                ->orderBy('no_akun')
                ->get()->toArray();

                $data2 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                     ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 4)
                    ->orderBy('no_akun')
                    ->get()->toArray();
    
                $data3 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) - SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                     ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 5)
                    ->orderBy('no_akun')
                    ->get()->toArray();
                    
                    $jumlah1 = [];
                    foreach($data2 as $jml){
                        $jumlah1[] = $jml->total;
                    }
                    $total_pendapatan = array_sum($jumlah1);
    
                    $jumlah2 = [];
                    foreach($data3 as $jml){
                        $jumlah2[] = $jml->total;
                    }
                    $total_beban = array_sum($jumlah2);
                    $laba = $total_pendapatan - $total_beban;

                    $jumlah3 = [];
                    foreach($data1 as $jml){
                        $jumlah3[] = $jml->total;
                    }  

                    $modal = array_sum($jumlah3);           
                    $saldo = $modal + $laba;

                    $periode = date('d/M/Y', strtotime($request->to_date));

                    $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.perubahan-modal', compact('saldo','modal','laba','periode'));
                    return $pdf->download('laporan-perubahan-modal');
        }else{
            
            $year = Carbon::now()->format('Y');
            $periode = Carbon::now()->format('d/M/Y');

            $data1 = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(kredit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                ->where('id_kat_akun', 3)->where('nama_akun', 'LIKE', '%modal%')
                ->orderBy('no_akun')
                ->get()->toArray();

                $data2 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 4)
                    ->orderBy('no_akun')
                    ->get()->toArray();
    
                $data3 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) - SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 5)
                    ->orderBy('no_akun')
                    ->get()->toArray();
                    
                    $jumlah1 = [];
                    foreach($data2 as $jml){
                        $jumlah1[] = $jml->total;
                    }
                    $total_pendapatan = array_sum($jumlah1);
    
                    $jumlah2 = [];
                    foreach($data3 as $jml){
                        $jumlah2[] = $jml->total;
                    }
                    $total_beban = array_sum($jumlah2);
                    $laba = $total_pendapatan - $total_beban;

                    $jumlah3 = [];
                    foreach($data1 as $jml){
                        $jumlah3[] = $jml->total;
                    }  

                    $modal = array_sum($jumlah3);           
                    $saldo = $modal + $laba;

                    $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.perubahan-modal', compact('saldo','modal','laba','periode'));
                    return $pdf->download('laporan-perubahan-modal');


        }
    }
    
    function neraca(Request $request){
        if(!empty($request->from_date))
        {
            $year = Carbon::now()->format('Y');

            $aktiva = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(debit) - SUM(kredit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                ->where('id_kat_akun', 1)
                ->orderBy('no_akun')
                ->get()->toArray();

                $liabilitas = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 2)
                    ->orderBy('no_akun')
                    ->get()->toArray();
         
                $data1 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 3)->where('nama_akun', 'LIKE', '%modal%')
                    ->orderBy('no_akun')
                    ->get()->toArray();

                $data2 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 4)
                    ->orderBy('no_akun')
                    ->get()->toArray();
    
                $data3 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) - SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereBetween('akt_akun_jurnal.created_at', array($request->from_date, $request->to_date))
                    ->where('id_kat_akun', 5)
                    ->orderBy('no_akun')
                    ->get()->toArray();
                    
                    $jumlah1 = [];
                    foreach($data2 as $jml){
                        $jumlah1[] = $jml->total;
                    }
                    $total_pendapatan = array_sum($jumlah1);
    
                    $jumlah2 = [];
                    foreach($data3 as $jml){
                        $jumlah2[] = $jml->total;
                    }
                    $total_beban = array_sum($jumlah2);
                    $laba = $total_pendapatan - $total_beban;

                    $jumlah3 = [];
                    foreach($data1 as $jml){
                        $jumlah3[] = $jml->total;
                    }  

                    $modal = array_sum($jumlah3);           
                    $saldo = $modal + $laba;
                         
                    $aktiva1 = [];
                    foreach($aktiva as $jml){
                        $aktiva1[] = $jml->total;
                    }
                    $total_aktiva = array_sum($aktiva1);

                    $liabilitas1 = [];
                    foreach($liabilitas as $jml){
                        $liabilitas1[] = $jml->total;
                    }
                    $total_hutang = array_sum($liabilitas1);

                    $periode = date('d/M/Y', strtotime($request->to_date));

                $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.neraca', compact('aktiva','saldo','total_aktiva','total_hutang','periode'));
                return $pdf->download('laporan-neraca');

        }else{
            
            $year = Carbon::now()->format('Y');
            $periode = Carbon::now()->format('d/M/Y');

            $aktiva = DB::table('akt_akun')
            ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                DB::raw('SUM(debit) - SUM(kredit) as total'))
                ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                ->where('id_kat_akun', 1)
                ->orderBy('no_akun')
                ->get()->toArray();

                $liabilitas = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 2)
                    ->orderBy('no_akun')
                    ->get()->toArray();
         
                $data1 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 3)->where('nama_akun', 'LIKE', '%modal%')
                    ->orderBy('no_akun')
                    ->get()->toArray();

                $data2 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(kredit) - SUM(debit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 4)
                    ->orderBy('no_akun')
                    ->get()->toArray();
    
                $data3 = DB::table('akt_akun')
                ->select('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun',
                    DB::raw('SUM(debit) - SUM(kredit) as total'))
                    ->join('akt_akun_jurnal', 'akt_akun_jurnal.id_akt_akun', '=', 'akt_akun.id')
                    ->groupBy('akt_akun.id', 'akt_akun.id_kat_akun', 'akt_akun.no_akun', 'akt_akun.nama_akun')
                    ->whereYear('akt_akun_jurnal.created_at', '=',$year)
                    ->where('id_kat_akun', 5)
                    ->orderBy('no_akun')
                    ->get()->toArray();
                    
                    $jumlah1 = [];
                    foreach($data2 as $jml){
                        $jumlah1[] = $jml->total;
                    }
                    $total_pendapatan = array_sum($jumlah1);
    
                    $jumlah2 = [];
                    foreach($data3 as $jml){
                        $jumlah2[] = $jml->total;
                    }
                    $total_beban = array_sum($jumlah2);
                    $laba = $total_pendapatan - $total_beban;

                    $jumlah3 = [];
                    foreach($data1 as $jml){
                        $jumlah3[] = $jml->total;
                    }  

                    $modal = array_sum($jumlah3);           
                    $saldo = $modal + $laba;
                         
                    $aktiva1 = [];
                    foreach($aktiva as $jml){
                        $aktiva1[] = $jml->total;
                    }
                    $total_aktiva = array_sum($aktiva1);

                    $liabilitas1 = [];
                    foreach($liabilitas as $jml){
                        $liabilitas1[] = $jml->total;
                    }
                    $total_hutang = array_sum($liabilitas1);

                $pdf = PDF::loadView('admin.admin-keuangan.cetak-pdf.neraca', compact('aktiva','saldo','total_aktiva','total_hutang','periode'));
                return $pdf->download('laporan-neraca');
        }
    }

    function arusKas(){

    }
}
