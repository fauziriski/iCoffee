<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Confirm_payment;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use App\Top_up;
use App\Joint_account;
use App\Auction_Order;
use App\Auction_product;
use Carbon;


class  VerifikasiPembayaranLelangController extends Controller
{
	public function dataOrderLelang()
	{
		if(request()->ajax())
		{	
			$jasa = "2";
			$konfirmasi = Confirm_payment::where('jasa',$jasa);
			
			return datatables()->of($konfirmasi)
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
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}elseif ($data->status == "4") {
					$status = '<span class="badge badge-success">penjual menerima</span>';
				}elseif ($data->status == "5") {
					$status = '<span class="badge badge-success">dikirim</span>';
				}elseif ($data->status == "6") {
					$status = '<span class="badge badge-success">terkirim</span>';
				}elseif ($data->status == "7") {
					$status = '<span class="badge badge-warning">komplain</span>';
				}elseif ($data->status == "8") {
					$status = '<span class="badge badge-success">konfirmasi diproses</span>';
				}elseif ($data->status == "9") {
					$status = '<span class="badge badge-danger">batalkan pesanan</span>';
				}elseif ($data->status == "10") {
					$status = '<span class="badge badge-primary">komplain diterima</span>';
				}elseif ($data->status == "11") {
					$status = '<span class="badge badge-danger">komplain ditolak</span>';
				}else{
					$status = '<span class="badge badge-danger">ditolak</span>';
				}
				return $status;
			})

			// blm bayar 1
			// sudah dibbayar 2
			// proses penjual 3
			// penjual menerima 4 menolak 0
			// dikriim 5
			// terkirim 6
			// komplin 7
			// konfirmasi diproses 8
			// batalkan pesanan pembeli 9
			// komplain dterima 1
			
			->addColumn('jumlah_transfer', function($data){
				$rp = "Rp. ";
				$jumlah_transfer = $rp. number_format($data->jumlah_transfer); 
				return $jumlah_transfer;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i');  
				return $waktu;
			})

			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-pembeli-lelang');
	}


	public function lihatOrderLelang($id)
	{
		if(request()->ajax())
		{
			$data = Confirm_payment::findOrFail($id);
			$invoice = $data->invoice;
			$total_bayar = Auction_Order::where('invoice',$invoice)->select('sub_total')->sum('sub_total');
			$jumlah = Auction_Order::where('invoice',$invoice)->select('jumlah')->sum('jumlah');
			$ambil = Auction_Order::where('invoice',$invoice)->first();
			$pay = $ambil->payment;

			$qty = Auction_Order::where('invoice',$invoice)->get();
			$jml = count($qty);

			for($i=0; $i < $jml; $i++){
				$ongkir[] = $qty[$i]; 
				$ongkir1 = explode(': ',$ongkir[$i]->shipping);
				$ongkir2[] =  $ongkir1[0];
			}	

			$collection = collect($ongkir2);
			$total_ongkir = $collection->pipe(function ($collection) {
				return $collection->sum();
			});

			$total_dibayar = $total_bayar+$total_ongkir;

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}elseif ($data->status == "4") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">penjual menerima</button>';
				}elseif ($data->status == "5") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">dikirim</button>';
				}elseif ($data->status == "6") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">terkirim</button>';
				}elseif ($data->status == "7") {
					$status = '<button type="button" class="btn btn-warning btn-sm py-0">komplain</button>';
				}elseif ($data->status == "8") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">konfirmasi diproses</button>';
				}elseif ($data->status == "9") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">batalkan pesanan</button>';
				}elseif ($data->status == "10") {
					$status = '<button type="button" class="btn btn-primary btn-sm py-0">komplain diterima</button>';
				}elseif ($data->status == "11") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">komplain ditolak</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">ditolak</button>';
				}
			}

			return response()->json([
				'data' => $data,
				'jumlah' => $jumlah,
				'total_bayar' => $total_bayar,
				'pay' => $pay,
				'total_ongkir' => $total_ongkir,
				'total_dibayar' => $total_dibayar,
				'status' => $status,
			]);

		}
	}

	public function tolakOrderLelang(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiOrderLelang(Request $request)
	{
		$ambil = Auction_Order::where('invoice',$request->invoice2)->first();
		$bank = $ambil->payment;
		$total_bayar = Auction_Order::where('invoice',$request->invoice2)->select('sub_total')->sum('sub_total');
		$kg = Auction_Order::where('invoice',$request->invoice2)->select('jumlah')->sum('jumlah');
		$qty = Auction_Order::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$ongkir[] = $qty[$i]; 
			$ongkir1 = explode(': ',$ongkir[$i]->shipping);
			$ongkir2[] =  $ongkir1[0];
		}	

		$collection = collect($ongkir2);
		$total_ongkir = $collection->pipe(function ($collection) {
			return $collection->sum();
		});

		$jumlah = $total_bayar+$total_ongkir;
		$catatan = "Pembelian kopi lelang sebanyak ".$kg."Kg dengan total harga Rp.".number_format($total_bayar)." dan total ongkos kirim sebesar Rp.".$total_ongkir;
		$tujuan_tran = "Bank ".$bank;
		$nama_akun_debit = "Bank ".$request->nama_bank_pengirim2."/".$request->nama_pemilik_pengirim2."-".$request->no_rekening_pengirim2;
		$nama_akun_kredit = "Pembelian Produk Lelang";
		$qty = Auction_Order::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$produk[] = $qty[$i]; 
		}

		for($i=0; $i < $jml; $i++){

			$shop_produk = Auction_product::where('id',$produk[$i]->id_produk)->where('id_pelelang', $produk[$i]->id_penjual)->get();
			$nama[] = $shop_produk[$i]->nama_produk;
			$produks= implode(",", $nama);
			$nama_tran = "Pembelian produk lelang ".$produks;

		}

		$noTrans = Adm_jurnal::noTrans();
		$noJurnal = Adm_akun::noJurnal();
		$data_val = Confirm_payment::whereId($request->hidden_id2)->where('jasa',2)->first();
		$foto_bukti = $data_val->foto_bukti;

		$simpan = Adm_jurnal::create([
			'id_kat_jurnal' => 7,
			'nama_tran' => $nama_tran,
			'bukti' => $foto_bukti,
			'catatan' => $catatan,
			'no_tran' => $noTrans,
			'total_jumlah' => $jumlah,
			'tujuan_tran' => $tujuan_tran			
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'akun_debit' => $nama_akun_debit,
			'akun_kredit' => $nama_akun_kredit,
			'debit' => $jumlah,
			'kredit' => 0
		]);


		$form_data = array(
			'status' => $request->status,
		);

		$form_status = array(
			'status' => '3',
		);

		Auction_Order::where('invoice',$request->invoice2)->update($form_status);
		Confirm_payment::whereId($request->hidden_id2)->update($form_data);

		$qty = Auction_Order::where('invoice',$request->invoice2)->get();
		$jml = count($qty);

		for($i=0; $i < $jml; $i++){
			$produk[] = $qty[$i]; 

		}

		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

//top-up

	public function dataTopUp()
	{
		if(request()->ajax())
		{	
			$jasa = "3";
			$konfirmasi = Confirm_payment::where('jasa',$jasa);
			
			return datatables()->of($konfirmasi)
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0 mb-1"><i class="fa fa-envelope"></i> pesan</button>'. '&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm py-0 mb-1"><i class="fa fa-check"></i> validasi</button>'. '&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-times"></i> tolak</button>';
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm py-0"><i class="fa fa-envelope"></i> pesan</button>';

				}
				
				return $button;
			})

		

			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = '<span class="badge badge-info">belum divalidasi</span>';
				}elseif ($data->status == "2") {
					$status = '<span class="badge badge-danger">validasi ditolak</span>';
				}elseif ($data->status == "3") {
					$status = '<span class="badge badge-success">sudah divalidasi</span>';
				}elseif ($data->status == "4") {
					$status = '<span class="badge badge-success">penjual menerima</span>';
				}elseif ($data->status == "5") {
					$status = '<span class="badge badge-success">dikirim</span>';
				}elseif ($data->status == "6") {
					$status = '<span class="badge badge-success">terkirim</span>';
				}elseif ($data->status == "7") {
					$status = '<span class="badge badge-warning">komplain</span>';
				}elseif ($data->status == "8") {
					$status = '<span class="badge badge-success">konfirmasi diproses</span>';
				}elseif ($data->status == "9") {
					$status = '<span class="badge badge-danger">batalkan pesanan</span>';
				}elseif ($data->status == "10") {
					$status = '<span class="badge badge-primary">komplain diterima</span>';
				}elseif ($data->status == "11") {
					$status = '<span class="badge badge-danger">komplain ditolak</span>';
				}else{
					$status = '<span class="badge badge-danger">ditolak</span>';
				}

				return $status;
			})

			->addColumn('jumlah_transfer', function($data){
				$rp = "Rp. ";
				$jumlah_transfer = $rp. number_format($data->jumlah_transfer); 
				return $jumlah_transfer;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i');  
				return $waktu;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-top-up');
	}


	public function lihatTopUp($id)
	{
		if(request()->ajax())
		{
			$data = Confirm_payment::findOrFail($id);
			$invoice = $data->invoice;
			$ambil = Top_up::where('invoice',$invoice)->first();
			$jumlah = $ambil->jumlah;

			if($data->status !== NULL){
				if ($data->status == "1") {
					$status = '<button type="button" class="btn btn-info btn-sm py-0">belum divalidasi</button>';
				}elseif ($data->status == "2") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">validasi ditolak</button>';
				}elseif ($data->status == "3") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">sudah divalidasi</button>';
				}elseif ($data->status == "4") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">penjual menerima</button>';
				}elseif ($data->status == "5") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">dikirim</button>';
				}elseif ($data->status == "6") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">terkirim</button>';
				}elseif ($data->status == "7") {
					$status = '<button type="button" class="btn btn-warning btn-sm py-0">komplain</button>';
				}elseif ($data->status == "8") {
					$status = '<button type="button" class="btn btn-success btn-sm py-0">konfirmasi diproses</button>';
				}elseif ($data->status == "9") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">batalkan pesanan</button>';
				}elseif ($data->status == "10") {
					$status = '<button type="button" class="btn btn-primary btn-sm py-0">komplain diterima</button>';
				}elseif ($data->status == "11") {
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">komplain ditolak</button>';
				}else{
					$status = '<button type="button" class="btn btn-danger btn-sm py-0">ditolak</button>';
				}

			return response()->json([
				'data' => $data,
				'jumlah' => $jumlah,
				'status' => $status,
			]);
			}
		}
	}

	public function tolakTopUp(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function validasiTopUp(Request $request)
	{

		$total_bayar = Top_up::where('invoice',$request->invoice2)->select('jumlah')->sum('jumlah');
		$top = Top_up::where('invoice',$request->invoice2)->first();
		$bank = $top->payment;

		$catatan = "Pengisian saldo top-up sebesar Rp.".number_format($total_bayar);
		$tujuan_tran = "Bank ".$bank;
		$nama_tran =  "Pengisian saldo top-up";
		$nama_akun_debit = "Bank ".$request->nama_bank_pengirim2."/".$request->nama_pemilik_pengirim2."-".$request->no_rekening_pengirim2;
		$nama_akun_kredit = "Pengisian Saldo Top-Up";

		$noTrans = Adm_jurnal::noTrans();
		$noJurnal = Adm_akun::noJurnal();
		$data_val = Confirm_payment::whereId($request->hidden_id2)->where('jasa',3)->first();
		$foto_bukti = $data_val->foto_bukti;

		$simpan = Adm_jurnal::create([
			'id_kat_jurnal' => 7,
			'nama_tran' => $nama_tran,
			'bukti' => $foto_bukti,
			'catatan' => $catatan,
			'no_tran' => $noTrans,
			'total_jumlah' => $total_bayar,
			'tujuan_tran' => $tujuan_tran			
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $simpan->id,
			'no_jurnal' =>$noJurnal,
			'akun_debit' => $nama_akun_debit,
			'akun_kredit' => $nama_akun_kredit,
			'debit' => $total_bayar,
			'kredit' => 0
		]);


		$form_data = array(
			'status' => $request->status,
		);
		
			$form_status = array(
				'status' => '3',
			);


			$ambil = Top_up::where('invoice',$request->invoice2)->first();
			$user_id = $ambil->user_id;
			$saldo1 = $ambil->jumlah;

			$ambil2 = Joint_account::where('user_id',$user_id)->first();
			$saldo2 = $ambil2->saldo;

			$masuk = $saldo2 + $saldo1;


			$form_saldo = array(
				'saldo' => $masuk,
			);

			Joint_account::where('user_id',$user_id)->update($form_saldo);
			Top_up::where('invoice',$request->invoice2)->update($form_status);


		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}
}
