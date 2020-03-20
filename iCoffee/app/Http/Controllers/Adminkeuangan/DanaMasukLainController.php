<?php

namespace App\Http\Controllers\Adminkeuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
use Validator;



class DanaMasukLainController extends Controller
{
	public function dataDanaMasuk(){

		if(request()->ajax())
		{	
			
			$id = '11';
			$AKMLA = Adm_jurnal::where('id_kat_jurnal',$id)->get();

			return datatables()->of($AKMLA)
			->addColumn('action', function($data){
				$button = 
				'<button type="button" name="lihat" id="'.$data->id.'" class="lihat btn btn-info btn-sm py-0 mb-1"><i class="fa fa-eye"></i> Lihat</button>'.'&nbsp&nbsp'.
				'<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm py-0"mb-1><i class="fa fa-edit"></i> Ubah</button>'.'&nbsp;&nbsp;'.
				'<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm py-0 delete"><i class="fa fa-trash"></i> Hapus</button>';
				return $button;
			})

			->addColumn('created_at', function($data){
				$waktu =  Carbon::parse($data->created_at)->toDayDateTimeString(); 
				return $waktu;
			})

			
			->rawColumns(['action','created_at'])
			->make(true);
		}

		$tran = Adm_tranksaksi::All();

		$kategori = Adm_kat_akun::All();

		$satu = Adm_sub1_akun::All();

		$dua = Adm_sub2_akun::All();

		return view('admin.admin-keuangan.dana-masuk-lain',compact('tran','kategori','satu','dua'));
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
		$id = "11";
		$id = Adm_jurnal::where('id_kat_jurnal',$id)->get();
		$jml_id = count($id)+1;
		$kode = "AKM-LA".$jml_id;

		$new_name = $kode.$timestamps. '.' . $bukti->getClientOriginalExtension();

		$bukti->move(public_path('Uploads/Adm_bukti/AKMLA'), $new_name);

		$total_jumlah = $request->jumlah2;

		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'11',
			'nama_tran' => $request->nama_tran,
			'bukti' =>  $new_name,
			'catatan' => $request->catatan,
			'kode' => $kode,
			'total_jumlah' => $total_jumlah,
			'tujuan_tran' => $request->tujuan_tran,		
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

		$nama_akun = $request->akun1;
		
		$jumlah = Adm_akun::where('nama_akun',$nama_akun)->select('jumlah')->get();
		$total = 0;
		for($i=0;$i<count($jumlah);$i++){
			$total += $jumlah[$i]->jumlah;
		}

		$data1 = Adm_arus_kas::where('nama_akun',$nama_akun)->select('nama_akun')->get();
		$data = count($data1);

		if($data == '0'){
			$id = Adm_arus_kas::create([
				'kode' => 'AKM-LA',
				'nama_akun' => $nama_akun,
				'total' => $total
			]);
		}else{
			$form = array(	
				'kode' => 'AKM-LA',
				'nama_akun' => $nama_akun,
				'total' => $total
			);
			Adm_arus_kas::where('nama_akun',$nama_akun)->update($form);
		}

	
		return response()->json(['success' => 'Data berhasil ditambah.']);
	}

	public function hapus($id)
	{

		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return response()->json();

	}

	public function update(Request $request)
	{
		
		$image_name = $request->bukti22;
		$foto_baru = $request->file('foto_baru22');
		if($foto_baru != '')
		{	
			$kode = $request->kode22;
			$timestamps = date('YmdHis');
			$image_name = $kode.$timestamps. '.' . $foto_baru->getClientOriginalExtension();
			$foto_baru->move(public_path('Uploads/Adm_bukti/AKMLA'), $image_name);
		}
		else
		{
			$rules = array(	
				'nama_tran22' =>  'required',
				'catatan22' =>  'required',
				'akun22.*' =>  'required_unless:type_of_content,is_information',
				'jumlah22.*' =>  'required_unless:type_of_content,is_information'
		
			);

			$error = Validator::make($request->all(), $rules);

			if($error->fails())
			{
				return response()->json(['errors' => $error->errors()->all()]);
			}
		}
		
		$id = Adm_jurnal::create([
			'id_kat_jurnal' =>'11',
			'nama_tran' => $request->nama_tran22,
			'bukti' =>  $image_name,
			'catatan' => $request->catatan22,
			'kode' => $request->kode22,
			'total_jumlah' => "1",
			'tujuan_tran' => $request->tujuan_tran22		
		]);
		
		$akun = $request->get('akun22');
		$posisi = $request->get('posisi22');
		$jumlah = $request->get('jumlah22');

		for ($i = 0; $i < count($akun); $i++) {
			Adm_akun::create([
				'id_adm_jurnal' => $id->id,
				'nama_akun' => $akun[$i],
				'posisi' => $posisi[$i],
				'jumlah' => $jumlah[$i]
			]);
			
		}

		$id =  $request->hidden_id22;
		$data = Adm_jurnal::findOrFail($id);
		$data->delete();

		return response()->json(['success' => 'Data berhasil di ubah.']);
	}


	public function detailDanaMasuk($id)
	{
		if(request()->ajax())
		{	
			$akun = Adm_akun::where('id_adm_jurnal',$id)->get();

			$data = Adm_jurnal::findOrFail($id);
			return response()->json([
				'data' => $data,
				'akun' => $akun
			]);
		}
	}



}
