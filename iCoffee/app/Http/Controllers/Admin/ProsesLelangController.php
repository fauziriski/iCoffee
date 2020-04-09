<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Auction_product;
use App\Auction_image;
use App\Auction_winner;
use App\Auction_process;
use App\User;

class ProsesLelangController extends Controller
{
	public function prosesLelang()
	{
		if(request()->ajax())
		{	

			$status_validasi = "2";
			$status = Auction_product::where('status', $status_validasi)->get();

			return datatables()->of($status)

			->addColumn('action', function($data){
				$button = '<button type="button" name="lihat_penawaran" id="'.$data->id.'" class="lihat_penawaran btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat penawaran</button>'. '&nbsp&nbsp' .
				'<button type="button" name="lihat_pemenang" id="'.$data->id.'" class="lihat_pemenang btn btn-success btn-sm py-0 mb-1"><i class="fa fa-trophy"></i> lihat pemenang</button>';
				
				return $button;
			})


			->addColumn('stok', function($data){
				$stok =  $data->stok." Kg"; 
				return $stok;
			})

			->addColumn('harga_awal', function($data){
				$rp = "Rp. ";
				$harga_awal = $rp. number_format($data->harga_awal); 
				return $harga_awal;
			})

			->rawColumns(['action','stok','harga_awal'])
			->make(true);
		}

		$status_validasi = "2";
		$status = Auction_product::where('status', $status_validasi)->get();

		

		return view('admin.proses-lelang', compact('status'));
		
	}

	public function dataLelang($id)
	{
		if(request()->ajax()){

			$data = Auction_product::find($id);
			$data_proses = Auction_process::where('id_produk', $data->id)->get();

			return datatables()->of($data_proses)

			->addColumn('penawaran', function($data){
				$rp = "Rp. ";
				$penawaran = $rp. number_format($data->penawaran); 
				return $penawaran;
			})
			->make(true);
		}

	}

	public function dataPemenang($id)
	{
		if(request()->ajax()){

			$data = Auction_product::find($id);
			$harga_awal = $data->harga_awal;
			$max = Auction_process::where('id_produk',$data->id)->max('penawaran');

			$data_pemenang = Auction_winner::where('id_produk_lelang', '=', $data->id)
			->where('jumlah_penawaran', '=', $max)
			->first();

			if($data_pemenang !== NULL){
				$data_user = User::where('id',$data_pemenang->id_pemenang)->first();
				$produk = Auction_product::where('id',$data_pemenang->id_produk_lelang)->first();
				$data_gambar = Auction_image::where('id_produk', $produk->id)->get();
				return response()->json([
					'produk' => $produk,
					'data_gambar' => $data_gambar,
					'data_pemenang' => $data_pemenang,
					'data_user' => $data_user,
	
				]);
				
				}else{
					$kosong = "kosonng";
					return response()->json([
					'kosong' => $kosong,
					]);
			}
		}

	}

}