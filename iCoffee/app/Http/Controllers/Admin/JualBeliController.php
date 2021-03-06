<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Shop_product;
use App\Image;
use Carbon;

class JualBeliController extends Controller
{
	public function jenisProduk()
	{
		if(request()->ajax())
		{
			return datatables()->of(Shop_product::latest()->get())
			->addColumn('action', function($data){
				$button ='<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-primary btn-sm py-0 mb-1"><i class="fa fa-eye"></i> lihat</button>'. '&nbsp';
				$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 mb-1"><i class="fa fa-trash"></i> hapus</button>';
				return $button;
			})
			
			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->format('l, d F Y H:i');  
				return $waktu;
			})

			->addColumn('stok', function($data){
				$stok =  number_format($data->stok)." Kg"; 
				return $stok;
			})

			->addColumn('harga', function($data){
				$rp = "Rp. ";
				$harga = $rp. number_format($data->harga); 
				return $harga;
			})

			->rawColumns(['action'])
			->make(true);
		}

		return view('admin.jenis-produk');
	}


	public function lihatProduk($id)
	{
		if(request()->ajax()){

			$data = Shop_product::find($id);
			$data_gambar = Image::where('id_produk', $data->id)->get();

			return response()->json([
				'data' => $data,
				'data_gambar' => $data_gambar,
			]);
		}
	}

	public function hapus($id)
	{

		$data = Shop_product::findOrFail($id);
		$data->delete();
		return response()->json();
	}
}
