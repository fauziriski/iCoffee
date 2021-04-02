<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
use App\Joint_account;
use App\Pengajuan_dana;
use App\Rincian_pengajuan;
use App\Riwayat_penjualan;
use App\Laporan_penjualan;
use App\Invest_product;
use App\invest_order;
use App\Mitra;
use Carbon;

class DanaKeluarBagiHasilController extends Controller
{
    public function dataLaporan()
	{
		if(request()->ajax())
		{	

            $bagi_hasil = Riwayat_penjualan::where('status',2)->get();

			return datatables()->of($bagi_hasil)
			->addColumn('action', function($data){
				
				if ($data->status == "2") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat rincian</button>';					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat rincian</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';

				}
				
				return $button;
			})



			->addColumn('total_penjualan', function($data){
				$rp = "Rp. ";
				$total = $rp. number_format($data->total_penjualan); 
				return $total;
			})

            ->addColumn('total_berat', function($data){
				$total_berat = number_format($data->total_berat)." Kg"; 
				return $total_berat;
			})


			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i'); 
				return $waktu;
			})

			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.admin-keuangan.dana-keluar-bagi-hasil');
	}


	public function lihatLaporan($id)
	{
		if(request()->ajax())
		{
			$data = Riwayat_penjualan::findOrFail($id);
			$data2 = Mitra::where('id_mitra', $data->id_mitra)->first();
            $data3 = Invest_product::where('kode_produk', $data->kode_produk)->first();
            $date = $data3->created_at;
            $tahun = $date->format('Y');
            $data4 = invest_order::where('id_produk', $data3->id)->whereYear('created_at', '=',$tahun)->get();
            $modal_awal = [];
                foreach($data4 as $jml){
                     $modal_awal[] = $jml->total;
                 }  
            $jml_qty = [];
                foreach($data4 as $jmlh){
                      $jml_qty[] = $jmlh->qty;
                  }  
                   
            $nama_mitra = $data2->nama;
            $nama_produk = $data3->nama_produk;  
            $periode = $data3->periode;  
            $produksi = Pengajuan_dana::where('id_mitra',$data->id_mitra)
                    ->where('status',2)
                    ->where('kode_produk',$data->kode_produk)
                    ->whereYear('created_at', '=',$tahun)
                    ->first();

            // $rincian = Laporan_penjualan::where('kode_produk',$data->kode_produk)->get();

            $modal = array_sum($modal_awal);
            $unit = array_sum($jml_qty);
            $biaya_produksi = $produksi->total;
            $total_penjualan = $data->total_penjualan;
            $total_berat = $data->total_berat;
            $saldo_sisa = $modal - $biaya_produksi;
            $pendapatan= $total_penjualan - $modal;

            $pendapatan_bersih = $pendapatan + $saldo_sisa;
            $icoffee = $pendapatan_bersih * 0.20;
            $bagi_dua= $pendapatan_bersih - $icoffee;
            $pendapatan_mitra = $bagi_dua / 2;
            $pendapatan_investor = $pendapatan_mitra / $unit;

            $harga_produk = $data3->harga;
            $persen = $pendapatan_investor/$harga_produk*100;
            
            $list_investor = DB::table('invest_orders')
                                ->where('id_produk', $data3->id)
                                ->whereYear('invest_orders.created_at', '=',$tahun)
                                ->join('investor_banks', 'investor_banks.investor_id', '=', 'invest_orders.id_investor')
                                ->select('invest_orders.id','invest_orders.qty','invest_orders.total', 'investor_banks.name', 'investor_banks.bank_name', 'investor_banks.norek',
                                        DB::raw("total*'$persen' as keuntungan"))
                                ->groupBy('invest_orders.id','invest_orders.qty','invest_orders.total', 'investor_banks.name', 'investor_banks.bank_name', 'investor_banks.norek')
                                ->get()->toArray();
                                // ->sum(DB::raw("total + keuntungan as tf"))
                                // DB::raw('SUM(kredit) - SUM(debit) as total'))

			return response()->json([
				'nama_produk' => $nama_produk,
                'nama_mitra' => $nama_mitra,
                'unit' => $unit,
                'periode' => $periode,
                'modal' => number_format($modal),
                'biaya_produksi' => number_format($biaya_produksi),
                'total_penjualan' => number_format($total_penjualan),
                'total_berat' => number_format($total_berat),
                'pendapatan' => number_format($pendapatan),
                'pendapatan_bersih' => number_format($pendapatan_bersih),
                'icoffee' => number_format($icoffee),
                'pendapatan_mitra' => number_format($pendapatan_mitra),
                'pendapatan_investor' => number_format($pendapatan_investor),           
                'list_investor' => $list_investor
			]);

		}
	}

	public function tolakLaporan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Riwayat_penjualan::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}


	public function validasiLaporan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

        $data = Riwayat_penjualan::whereId($request->hidden_id2)->first();
		$data3 = Mitra::where('id_mitra', $data->id_mitra)->first();
        $data2 = Invest_product::where('kode_produk',$data->kode_produk)->first();
        $nama_bank = "syariah";
		$akun = Akt_akun::where('nama_akun', 'LIKE', "%$nama_bank%")->first();
		$id_akt_akun = $akun->id;
        $tujuan = Akt_tujuan::where('nama_tujuan', 'LIKE', "%$nama_bank%")->first();
		$id_tujuan = $tujuan->id;
        $noTrans = Akt_jurnal::noTrans();
		$noJurnal = Akt_akun_jurnal::noJurnal();
        $nama_tran =  "Pendapatan Penjualan Hasil Panen ".$data2->nama_produk;
        $catatan = "Pendapatan Penjualan Hasil Panen ".$data2->nama_produk." dari mitra ".$data3->nama." dengan total berat penjualan ".$data->total_berat." Kg dengan total penjualan Rp ".number_format($data->total_penjualan)."";
        $foto_bukti = $data->gambar;

		$simpan = Akt_jurnal::create([
			'id_kat_jurnal' => 3,
			'id_akt_tujuan' => $id_tujuan,
			'no_transaksi' => $noTrans,
			'nama_transaksi' => $nama_tran,
			'bukti' => $foto_bukti,
			'catatan' => $catatan,
			'total_jumlah' => $data->total_penjualan,
				
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $id_akt_akun,
			'debit' => $data->total_penjualan,
			'kredit' => 0
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => 47,
			'debit' => 0,
			'kredit' => $data->total_penjualan,
		]);

		Riwayat_penjualan::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}
