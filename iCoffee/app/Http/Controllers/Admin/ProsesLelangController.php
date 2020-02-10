<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Auction_product;
use App\Auction_image;
use App\Auction_process;

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
				$button = '<button type="button" name="lihat_penawaran" id="'.$data->id.'" class="lihat_penawaran btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat Penawaran</button>'. '&nbsp&nbsp' .
				'<button type="button" name="lihat_pemenang" id="'.$data->id.'" class="lihat_pemenang btn btn-success btn-sm"><i class="fa fa-trophy"></i> Lihat Pemenang</button>';
				
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

			$data = Auction_process::find($id);
			$penawaran = Auction_process::max('penawaran');
			$pemenang = Auction_process::where('penawaran',$penawaran)->first();
			$produk = Auction_product::where('id',$pemenang->id_produk)->first();
			$data_gambar = Auction_image::where('id_produk', $data->id)->get();

			return response()->json([
				'data' => $data,
				'pemenang' => $pemenang,
				'produk' => $produk,
				'data_gambar' => $data_gambar,

			]);
		}

	}

}
