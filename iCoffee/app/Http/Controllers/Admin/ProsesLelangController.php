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


			// ->addColumn('waktu', function($data){
			// 	$waktu = '<p id="'.$data->id.'" name="'.$data->id.'"></p>';

			// 	return $waktu;
			// })
			
			->rawColumns(['action'])
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

			
			->make(true);

		}
			// $data = Auction_product::find($id);
			// $data_gambar = Auction_image::where('id_produk', $data->id)->get();

			// $data_proses = Auction_process::where('id_produk', $data->id)->get();
// $data = Auction_product::find($id);
// 			$data_proses = Auction_process::where('id_produk', $data->id)->get();
// 			return response()->json([
// 				'data_proses' => $data_proses,
// 			]);
		
		// $data = Auction_product::find($id);
		// $data_proses = Auction_process::where('id_produk', $data->id)->get();
		// return view('admin.proses-lelang', compact('data_proses'));
	}

}
