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
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
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
					$status = '<button type="button" class="btn btn-info btn-sm py-0 btn-block">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0 btn-block">sudah divalidasi</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0 btn-block">validasi ditolak</button>';
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

	// 	$form_data = array(
	// 		'status' => $request->status,
	// 	);

	// 	Invest_confirm::whereId($request->hidden_id2)->update($form_data);
	// 	return response()->json(['success' => 'Berhasil Ditolak']);
	// }

		$ambil = Invest_confirm::where('id',$request->hidden_id2)->first();
		$biaya= $ambil->nominal;
		$id_order = $ambil->id_order;
		$bank_pengirim = $ambil->bank;
		$nama_pengirim = $ambil->nama;
		$no_rekening_pengirim = $ambil->norek;
		$new_name = $ambil->gambar;

		$order = Invest_order::where('id',$id_order)->first();
		$id_bank = $order->id_bank;
		$id_produk = $order->id_produk;	
		$qty = $order->qty;

		$bank = Account::where('id',$id_bank)->first();
		$nama_bank = $bank->bank_name;

		$produk= Invest_product::where('id',$id_produk)->first();
		$nama_produk = $produk->nama_produk;
		$kontrak = $produk->periode;
		$profit_periode = $produk->profit_periode;
		$roi = $produk->roi;

		$nama_tran =  "Beli produk Investasi";
		$tujuan_tran = "Bank ".$nama_bank." iCoffee";
		$catatan = "pembiayaan produk investasi ".$nama_produk." dengan biaya investasi Rp.".number_format($biaya)." Sebanyak ".$qty." Unit, kontrak selama ".$kontrak." tahun, bagi hasil ".$profit_periode." tahun, dengan return ".$roi." %/tahun";
		$nama_akun_debit = $bank_pengirim."/".$nama_pengirim."-".$no_rekening_pengirim;
		$nama_akun_kredit = "Pembelian produk investasi";

		$id = "3";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-I".$jml_id;

		$nama_akun = "Pembelian produk investasi";
		$data_produk = Invest_product::where('id',$id_produk)->first();
		$stok = $data_produk->stok;
		$kurang_stok = $stok - $qty;
		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '3',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new_name,
			'nama_tran' => $nama_tran,
			'total_jumlah' => $biaya	
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_debit,
			'posisi' => 'Debit',
			'jumlah' => $biaya
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_kredit,
			'posisi' => 'Kredit',
			'jumlah' => $biaya
		]);

		$form_data = array(
			'status' => $request->status,
		);

		$form_data2 = array(
			'status' => $request->status,
		);

		$form_data3 = array(
			'stok' => $kurang_stok,
		);
		

		Invest_confirm::whereId($request->hidden_id2)->update($form_data);
		Invest_order::where('id',$id_order)->update($form_data2);
		Invest_product::where('id',$id_produk)->update($form_data3);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

}