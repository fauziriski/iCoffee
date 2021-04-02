<?php

namespace App\Http\Controllers\Admin;

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
use App\Mitra;
use Carbon;

class VerifikasiLaporanPenjualanController extends Controller
{
    public function dataLaporan()
	{
		if(request()->ajax())
		{	
			$konfirmasi = Riwayat_penjualan::All();

			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat rincian</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat rincian</button>'. '&nbsp' .
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

			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-laporan-penjualan');
	}


	public function lihatLaporan($id)
	{
		if(request()->ajax())
		{
			$data = Riwayat_penjualan::findOrFail($id);
			$data2 = Mitra::where('id_mitra', $data->id_mitra)->first();
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

			$rincian = Laporan_penjualan::where('kode_produk',$data->kode_produk)->get();

			return response()->json([
				'data' => $data,
				'data2' => $data2,
				'status1' => $status1,
				'rincian' => $rincian

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
