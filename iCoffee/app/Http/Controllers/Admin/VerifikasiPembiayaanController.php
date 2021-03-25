<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invest_confirm;
use App\invest_order;
use App\Invest_product;
use App\Invest_product_image;
use App\Account;
use App\User;
use App\Akt_jurnal;
use App\Akt_akun_jurnal;
use App\Akt_tujuan;
use App\Akt_kat_akun;
use App\Akt_akun;
use DB;
use DataTables;
use Carbon;

class VerifikasiPembiayaanController extends Controller
{
	public function dataPembiayaan()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Invest_confirm::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';

				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';
				}
				
				return $button;
			})

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}else{
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}

				return $status;
			})

			->addColumn('created_at', function($data){
				$created_at =  Carbon::parse($data->created_at)->format('l, d F Y H:i');  
				return $created_at;
			})

			->addColumn('nominal', function($data){
				$rp = "Rp. ";
				$nominal = $rp. number_format($data->nominal); 
				return $nominal;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-pembiayaan');
	}

	public function lihatPembiayaan($id)
	{
		if(request()->ajax())
		{
			$data = Invest_confirm::findOrFail($id);

			$id_pengguna = $data->id_investor;
			$data2 = User::where('id',$id_pengguna)->first();

			$id_order = $data->id_order;
			$order = invest_order::whereId($id_order)->first();
			$id_bank = $order->id_bank;

			$id_produk = $order->id_produk;
			$produk = Invest_product::whereId($id_produk)->first();
	
			$bank = Account::where('id',$id_bank)->first();
			$nama_bank = $bank->bank_name;

			$data_gambar = Invest_product_image::where('id_produk',$id_produk)->get();


			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
					
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'data2' => $data2,
				'order' => $order,
				'produk' => $produk,
				'data_gambar' => $data_gambar,
				'nama_bank' => $nama_bank,
				'status' => $status,


			]);
		}
	}

	public function tolakPembiayaan(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);
		
		Invest_confirm::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiPembiayaan(Request $request)
	{

		$ambil = Invest_confirm::where('id',$request->hidden_id2)->first();
		$biaya= $ambil->nominal;
		$id_order = $ambil->id_order;
		$bank_pengirim = $ambil->bank;
		$nama_pengirim = $ambil->nama;
		$no_rekening_pengirim = $ambil->norek;
		$foto_bukti = $ambil->gambar;

		$order = Invest_order::where('id',$id_order)->first();
		$id_bank = $order->id_bank;
		$id_produk = $order->id_produk;	
		$qty = $order->qty;

		// $bank = Account::where('id',$id_bank)->first();
		$nama_bank = "syariah";

		$akun = Akt_akun::where('nama_akun', 'LIKE', "%$nama_bank%")->first();
		$id_akt_akun = $akun->id;

		$tujuan = Akt_tujuan::where('nama_tujuan', 'LIKE', "%$nama_bank%")->first();
		$id_tujuan = $tujuan->id;

		$produk= Invest_product::where('id',$id_produk)->first();
		$nama_produk = $produk->nama_produk;
		$kontrak = $produk->periode;
		$profit_periode = $produk->profit_periode;
		$roi = $produk->roi;

		$nama_tran =  "Pembelian produk investasi ".$nama_produk;
		$tujuan_tran = "Bank ".$nama_bank;
		$catatan = "Pembiayaan produk investasi ".$nama_produk." dengan biaya investasi Rp.".number_format($biaya)." Sebanyak ".$qty." Unit, kontrak selama ".$kontrak." tahun, bagi hasil ".$profit_periode." tahun, dengan return ".$roi." %/tahun";
		$nama_akun_debit = "Bank ".$bank_pengirim."/".$nama_pengirim."-".$no_rekening_pengirim;
		$nama_akun_kredit = "Pembelian Produk Investasi";

		$noTrans = Akt_jurnal::noTrans();
		$noJurnal = Akt_akun_jurnal::noJurnal();

		// $simpan = Akt_jurnal::create([
		// 	'id_kat_jurnal' => 3,
		// 	'nama_tran' => $nama_tran,
		// 	'bukti' => $foto_bukti,
		// 	'catatan' => $catatan,
		// 	'no_tran' => $noTrans,
		// 	'total_jumlah' => $biaya,
		// 	'tujuan_tran' => $tujuan_tran			
		// ]);

		// Akt_akun::create([
		// 	'id_adm_jurnal' => $simpan->id,
		// 	'no_jurnal' =>$noJurnal,
		// 	'akun_debit' => $nama_akun_debit,
		// 	'akun_kredit' => $nama_akun_kredit,
		// 	'debit' => $biaya,
		// 	'kredit' => 0
		// ]);

		$simpan = Akt_jurnal::create([
			'id_kat_jurnal' => 2,
			'id_akt_tujuan' => $id_tujuan,
			'no_transaksi' => $noTrans,
			'nama_transaksi' => $nama_tran,
			'bukti' => $foto_bukti,
			'catatan' => $catatan,
			'total_jumlah' => $biaya,
				
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => $id_akt_akun,
			'debit' => $biaya,
			'kredit' => 0
		]);

		Akt_akun_jurnal::create([
			'id_akt_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'id_akt_akun' => 46,
			'debit' => 0,
			'kredit' => $biaya
		]);

		$form_data = array(
			'status' => $request->status,
		);

		$form_data2 = array(
			'status' => $request->status,
		);

		$data_produk = Invest_product::where('id',$id_produk)->first();
		$stok = $data_produk->stok;
		$kurang_stok = $stok - $qty;
		
		$form_data3 = array(
			'stok' => $kurang_stok,
		);
		

		Invest_confirm::whereId($request->hidden_id2)->update($form_data);
		Invest_order::where('id',$id_order)->update($form_data2);
		Invest_product::where('id',$id_produk)->update($form_data3);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}