<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mitra;
use App\Mitra_koperasi;
use App\Mitra_perorangan;
use App\Kelompok_tani;
use DB;
use DataTables;
use Illuminate\Support\Facades\Hash;

class ValidasiPetaniController extends Controller
{

	public function koperasi(Request $request)
	{	

		$form_data = array(
			'id_mitra' => $request->id_mitra,
			'email' => $request->email,
			'nama' => $request->nama_koperasi,
			'deskripsi' => $request->deskripsi,
			'alamat' => $request->alamat,
			'jumlah_petani' => $request->jumlah_petani,
			'gambar' => $request->gambar,
			'no_hp' => $request->no_hp,
			'password' =>Hash::make($request->password),
			'kode' =>$request->kode,
			'saldo' => '0',
		);

		$form_data2 = array(
			'status' => $request->status,
		);

		Mitra_koperasi::whereId($request->hidden_id)->update($form_data2);

		Mitra::create($form_data);

		return response()->json(['success' => 'Berhasil divalidasi.']);
	}

	public function perorangan(Request $request)
	{	

		$form_data = array(
			'id_mitra' => $request->id_mitra,
			'email' => $request->email,
			'nama' => $request->nama_koperasi,
			'deskripsi' => $request->deskripsi,
			'alamat' => $request->alamat,
			'jumlah_petani' => $request->jumlah_petani,
			'gambar' => $request->gambar,
			'no_hp' => $request->no_hp,
			'password' =>Hash::make($request->password),
			'kode' =>$request->kode,
			'saldo' => '0',
		);

		$form_data2 = array(
			'status' => $request->status,
		);

		Mitra_perorangan::whereId($request->hidden_id)->update($form_data2);

		Mitra::create($form_data);

		return response()->json(['success' => 'Berhasil divalidasi.']);
	}

	public function kelompok(Request $request)
	{	

		$form_data = array(
			'id_mitra' => $request->id_mitra,
			'email' => $request->email,
			'nama' => $request->nama_koperasi,
			'deskripsi' => $request->deskripsi,
			'alamat' => $request->alamat,
			'jumlah_petani' => $request->jumlah_petani,
			'gambar' => $request->gambar,
			'no_hp' => $request->no_hp,
			'password' =>Hash::make($request->password),
			'kode' =>$request->kode,
			'saldo' => '0',
		);

		$form_data2 = array(
			'status' => $request->status,
		);

		Kelompok_tani::whereId($request->hidden_id)->update($form_data2);

		Mitra::create($form_data);

		return response()->json(['success' => 'Berhasil divalidasi.']);
	}
}
