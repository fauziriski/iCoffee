<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use App\Auction_product;
use App\Auction_image;
use App\Auction_process;



class ValidasiProdukLelangController extends Controller
{
	public function ProdukLelang()
	{
		if(request()->ajax())
		{	

			return datatables()->of(Auction_product::latest()->get())
			->addColumn('action', function($data){
				
				if ($data->status == "1") {
					$button = 
					'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
					'<button type="button" name="pesan" id="'.$data->id.'" class="pesan btn btn-warning btn-sm"><i class="fa fa-envelope"></i> Kirim Pesan</button>'. '&nbsp&nbsp' .
					'<button type="button" name="diproses" id="'.$data->id.'" class="diproses btn btn-secondary btn-sm"><i class="fa fa-clock"></i> Diproses</button>'. '&nbsp&nbsp' .
					'<button type="button" name="tolak" id="'.$data->id.'" class="tolak btn btn-danger btn-sm"><i class="fa fa-times"></i> Tolak</button>';
					
				}elseif ($data->status == "3") {
					$button = '<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm"><i class="fa fa-eye"></i> Lihat</button>'. '&nbsp&nbsp' .
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
				}elseif ($data->status == "3") {
					$status = "diproses";
				}elseif ($data->status == "2") {
					$status = "divalidasi";
				}else{
					$status = "ditolak";
				}

				return $status;
			})
			
			->rawColumns(['action','status'])
			->make(true);
		}

		return view('admin.validasi-produk-lelang');
	}

	public function dataProdukLelang($id)
	{
		if(request()->ajax())
		{
			$data = Auction_product::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}

	public function lihatProdukLelang($id)
	{
		if(request()->ajax()){

			$data = Auction_product::find($id);
			$data_gambar = Auction_image::where('id_produk', $data->id)->get();

			return response()->json([
				'data' => $data,
				'data_gambar' => $data_gambar,
			]);
		}
	}

	public function TolakProdukLelang(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Ditolak']);
	}

	public function ValidasiProdukLelang(Request $request)
	{

		$form_data = array(
			'status' => $request->status,
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Divalidasi']);
	}

	public function ProsesProdukLelang(Request $request)
	{	
		
		$form_data = array(
			'status' => $request->status,
		);

		Auction_product::whereId($request->hidden_id2)->update($form_data);
		return response()->json(['success' => 'Berhasil Diproses']);
	}
}
