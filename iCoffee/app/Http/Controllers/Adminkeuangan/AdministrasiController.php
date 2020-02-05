<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Adm_jurnal;
use App\Adm_tranksaksi;
use App\Adm_kat_akun;
use App\Adm_akun;
use App\Adm_sub1_akun;
use App\Adm_sub2_akun;
use DB;
use DataTables;
use Carbon;
use Validator;



class AdministrasiController extends Controller
{
	public function dataAdministrasi(){

		if(request()->ajax())
		{	
			
			return datatables()->of(Adm_jurnal::latest()->get())
			->addColumn('action', function($data){
				$button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</button>';
				$button .= '&nbsp;&nbsp;';
				$button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $waktu;
			})

			
			->rawColumns(['action','created_id'])
			->make(true);
		}

		$tran = Adm_tranksaksi::All();

		$kategori = Adm_kat_akun::All();

		$satu = Adm_sub1_akun::All();

		$dua = Adm_sub2_akun::All();

		return view('admin.admin-keuangan.administrasi',compact('tran','kategori','satu','dua'));
	}

	public function tambah(Request $request)
	{	

		$rules = array(	
			'nama_tran' =>  'required',
			'tujuan_tran' => 'required',
			'catatan' =>  'required',
			'akun1' => 'required',
			'akun2' => 'required',
			'jumlah1' => 'required',
			'jumlah2' => 'required',
			'bukti' =>  'required|image|max:2048'
		);

		$error = Validator::make($request->all(), $rules);

		if($error->fails())
		{
			return response()->json(['errors' => $error->errors()->all()]);
		}

		$bukti = $request->file('bukti');
		$timestamps = date('YmdHis');
		$id = Adm_jurnal::pluck('id')->toArray();
		$jml_id = count($id);
		$kode = "AKK-A".$jml_id;

		$new_name = $kode.$timestamps. '.' . $bukti->getClientOriginalExtension();

		$bukti->move(public_path('Uploads/Adm_bukti'), $new_name);

		$total_jumlah = $request->jumlah2;

		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'2',
			'nama_tran' => $request->nama_tran,
			'bukti' =>  $new_name,
			'catatan' => $request->catatan,
			'kode' => $kode,
			'total_jumlah' => $total_jumlah,
			'tujuan_tran' => $request->tujuan_tran		
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun1,
			'posisi' => $request->posisi1,
			'jumlah' => $request->jumlah1
		]);

		Adm_akun::create([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun2,
			'posisi' => $request->posisi2,
			'jumlah' => $request->jumlah2
		]);
		

		if(!(empty($request->akun3))){
			Adm_akun::create([
				'id_adm_jurnal' => $id->id,
				'nama_akun' => $request->akun3,
				'posisi' => $request->posisi3,
				'jumlah' => $request->jumlah3
			]);
		}

		return response()->json(['success' => 'Data berhasil ditambah.']);
	}


	public function lihatAdministrasi($id)
	{
		if(request()->ajax())
		{
			$data = Adm_jurnal::findOrFail($id);
			return response()->json(['data' => $data]);
		}
	}


	public function hapus($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return view('admin.super-admin.data-pelanggan');

	}

	public function update(Request $request)
	{

		$bukti_name = $request->hidden_bukti;
		$bukti = $request->file('bukti');
		if($bukti != '')
		{
			$rules = array(	
				'nama_tran' =>  'required',
				'tujuan_tran' => 'required',
				'catatan' =>  'required',
				'akun1' => 'required',
				'akun2' => 'required',
				'jumlah1' => 'required',
				'jumlah2' => 'required',
				'bukti' =>  'required|image|max:2048'
			);
			$error = Validator::make($request->all(), $rules);
			if($error->fails())
			{
				return response()->json(['errors' => $error->errors()->all()]);
			}

			$bukti_name = rand() . '.' . $bukti->getClientOriginalExtension();
			$bukti->move(public_path('foto_produk'), $bukti_name);
		}
		else
		{
			$rules = array(	
				'nama_tran' =>  'required',
				'tujuan_tran' => 'required',
				'catatan' =>  'required',
				'akun1' => 'required',
				'akun2' => 'required',
				'jumlah1' => 'required',
				'jumlah2' => 'required',
				'bukti' =>  'required|image|max:2048'
			);

			$error = Validator::make($request->all(), $rules);

			if($error->fails())
			{
				return response()->json(['errors' => $error->errors()->all()]);
			}
		}

		$form_data = array(
			'id_kat_jurnal' =>'2',
			'nama_tran' => $request->nama_tran,
			'catatan' => $request->catatan,
			'kode' => $kode,
			'total_jumlah' => $total_jumlah,
			'tujuan_tran' => $request->tujuan_tran,	
			'image' =>  $bukti_name
		);

		Adm_akun::update([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun1,
			'posisi' => $request->posisi1,
			'jumlah' => $request->jumlah1
		]);

		Adm_akun::update([
			'id_adm_jurnal' => $id->id,
			'nama_akun' => $request->akun2,
			'posisi' => $request->posisi2,
			'jumlah' => $request->jumlah2
		]);
		

		if(!(empty($request->akun3))){
			Adm_akun::update([
				'id_adm_jurnal' => $id->id,
				'nama_akun' => $request->akun3,
				'posisi' => $request->posisi3,
				'jumlah' => $request->jumlah3
			]);
		}


		Adm_jurnal::whereId($request->hidden_id)->update($form_data);

		return response()->json(['success' => 'Data berhasil di ubah.']);
	}



}
