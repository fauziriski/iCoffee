<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Confirm_payment;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_arus_kas;
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
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				
				return $button;
			})


			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = "belum divalidasi";
				}elseif ($data->status == "2") {
					$status = "ditolak";
				}elseif ($data->status == "3") {
					$status = "divalidasi";
				}elseif ($data->status == "4") {
					$status = "penjual menerima";
				}elseif ($data->status == "5") {
					$status = "dikirim";
				}elseif ($data->status == "6") {
					$status = "terkirim";
				}elseif ($data->status == "7") {
					$status = "komplain";
				}elseif ($data->status == "8") {
					$status = "konfirmasi diproses";
				}elseif ($data->status == "9") {
					$status = "batalkan pesanan pembeli";
				}elseif ($data->status == "10") {
					$status = "komplain diterima";
				}elseif ($data->status == "11") {
					$status = "komplain ditolak";
				}else{
					$status = "ditolak";
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
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
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

			return response()->json([
				'data' => $data,
				'jumlah' => $jumlah,
				'total_bayar' => $total_bayar,
				'pay' => $pay,
				'total_ongkir' => $total_ongkir,
				'total_dibayar' => $total_dibayar

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

		$catatan = "pembelian kopi lelang sebanyak ".$kg."Kg dengan total harga Rp.".number_format($total_bayar)." dan total ongkos kirim sebesar Rp.".$total_ongkir;
		$tujuan_tran = "Bank ".$bank." iCoffee";


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
			$nama_tran = "Beli produk lelang : ".$produks;

		}


		$id = "5";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-L".$jml_id;

		$bukti = $request->foto_bukti2;
		$timestamps = date('YmdHis');
		$new_name = $kode.$timestamps. '.' . $bukti;

		$nama_akun = "Pembelian Produk Lelang";

		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '5',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new_name,
			'nama_tran' => $nama_tran,
			'total_jumlah' => $request->jumlah_transfer2	
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_debit,
			'posisi' => 'Debit',
			'jumlah' => $request->jumlah_transfer2
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_kredit,
			'posisi' => 'Kredit',
			'jumlah' => $request->jumlah_transfer2
		]);


		$form_data = array(
			'status' => $request->status,
		);


		$jumlah = Adm_akun::where('nama_akun',$nama_akun)->select('jumlah')->get();
		$total = 0;
		for($i=0;$i<count($jumlah);$i++){
			$total += $jumlah[$i]->jumlah;
		}

		$data1 = Adm_arus_kas::where('nama_akun',$nama_akun)->select('nama_akun')->get();
		$data = count($data1);

		if($data == '0'){
			$id = Adm_arus_kas::create([
				'kode' => 'AKM-L',
				'nama_akun' => $nama_akun,
				'total' => $total
			]);
		}else{
			$form = array(	
				'kode' => 'AKM-L',
				'nama_akun' => $nama_akun,
				'total' => $total
			);
			Adm_arus_kas::where('nama_akun',$nama_akun)->update($form);
		}

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
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="validasi" id="'.$data->id.'" class="validasi btn btn-success btn-sm"><i class="fa fa-check"></i> Validasi</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';
					
				}else{
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>';

				}
				
				return $button;
			})



			->addColumn('status', function($data){
				if ($data->status == "1") {
					$status = "belum divalidasi";
				}elseif ($data->status == "2") {
					$status = "ditolak";
				}elseif ($data->status == "3") {
					$status = "divalidasi";
				}elseif ($data->status == "4") {
					$status = "penjual menerima";
				}elseif ($data->status == "5") {
					$status = "dikirim";
				}elseif ($data->status == "6") {
					$status = "terkirim";
				}elseif ($data->status == "7") {
					$status = "komplain";
				}elseif ($data->status == "8") {
					$status = "konfirmasi diproses";
				}elseif ($data->status == "9") {
					$status = "batalkan pesanan pembeli";
				}elseif ($data->status == "10") {
					$status = "komplain diterima";
				}elseif ($data->status == "11") {
					$status = "komplain ditolak";
				}else{
					$status = "ditolak";
				}

				return $status;
			})

			->addColumn('jumlah_transfer', function($data){
				$rp = "Rp. ";
				$jumlah_transfer = $rp. number_format($data->jumlah_transfer); 
				return $jumlah_transfer;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
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

			return response()->json([
				'data' => $data,
				'jumlah' => $jumlah
			]);
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

		// $ambil = Top_up::where('invoice',$request->invoice2)->first();
		// $bank = $ambil->payment;

		$jumlah = Top_up::where('invoice',$request->invoice2)->select('jumlah')->sum('jumlah');

		$catatan = "pembelian saldo awal untuk mengikuti lelang sebesar Rp.".number_format($jumlah);
		// $tujuan_tran = "Bank ".$bank." iCoffee";

		$tujuan_tran = "Bank iCoffee BCA";
		$nama_tran =  "Pengisian saldo lelang : Rp.".number_format($jumlah);
		$nama_akun_debit = "Bank ".$request->nama_bank_pengirim2."/".$request->nama_pemilik_pengirim2."-".$request->no_rekening_pengirim2;
		$nama_akun_kredit = "Pengisian saldo top-up";

		$id = "7";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-L".$jml_id;

		$bukti = $request->foto_bukti2;
		$timestamps = date('YmdHis');
		$new_name = $kode.$timestamps. '.' . $bukti;

		$nama_akun = "Pengisian saldo top-up";

		$id = Adm_jurnal::create([
			'id_kat_jurnal' => '7',
			'kode' => $kode,
			'catatan' => $catatan,
			'tujuan_tran' => $tujuan_tran,
			'bukti' =>  $new_name,
			'nama_tran' => $nama_tran,
			'total_jumlah' => $request->jumlah_transfer2	
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_debit,
			'posisi' => 'Debit',
			'jumlah' => $request->jumlah_transfer2
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $nama_akun_kredit,
			'posisi' => 'Kredit',
			'jumlah' => $request->jumlah_transfer2
		]);

		$form_data = array(
			'status' => $request->status,
		);
		

		$jumlah = Adm_akun::where('nama_akun',$nama_akun)->select('jumlah')->get();
		$total = 0;
		for($i=0;$i<count($jumlah);$i++){
			$total += $jumlah[$i]->jumlah;
		}

		$data1 = Adm_arus_kas::where('nama_akun',$nama_akun)->select('nama_akun')->get();
		$data = count($data1);

		if($data == '0'){
			$id = Adm_arus_kas::create([
				'kode' => 'AKM-L',
				'nama_akun' => $nama_akun,
				'total' => $total
			]);
		}else{
			$form = array(	
				'kode' => 'AKM-L',
				'nama_akun' => $nama_akun,
				'total' => $total
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
			Adm_arus_kas::where('nama_akun',$nama_akun)->update($form);
		}

		Confirm_payment::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}
}
