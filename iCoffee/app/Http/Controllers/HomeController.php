<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Address;
use App\Shop_product;
use App\Image;
use App\Province;
use App\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pasangjualbeli()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        return view('jual-beli.pasang',compact('id_pelanggan','nama_pelanggan'));
    }


    public function pasangproduk(Request $request)
    {

        
        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
        $oldMarker = $timestamps.$id_pelanggan;
        
        $size = count(collect($request)->get('image'));

        $this->validate($request,[

            'image' => 'required'
        ]);

        $folderPath = public_path("Uploads\Produk\{$oldMarker}");
        $response = mkdir($folderPath);
        $nama = array();
       
        

        if($files = $request->file('image')){

            foreach($files as $image){
                $name=$image->getClientOriginalName();
                $image_resize = Images::make($image->getRealPath());
                $image_resize->resize(690, 547);
                $image_resize->crop(500, 500);
                $image_resize->save($folderPath .'/'. $name);
                // $image_resize->move($folderPath,$name);
                $nama[]=$name;
                
            }

        }
    
        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $request->detail_produk,
            'gambar' => $nama[0],
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kode_produk' => $oldMarker

        ]);

        $id = $order->id;

        
        for ($i=0; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
        }

        return redirect('/jual-beli');
    }

    public function profil()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = Auth::user()->name;
        $user = User::where('id', $id_pelanggan)->first();
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->get();



        if($cekalamat->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profil/tambahalamat');       

        }
        $address = Address::where('id_pelanggan', $id_pelanggan)->where('status', '1')->first();

        $provinsi_user = Province::where('id', $address->provinsi)->first();
        $kota_user = City::where('id', $address->kota_kabupaten)->first();
        $provinsi = Province::all();


        
        
        return view('jual-beli.profil', compact('user', 'address', 'provinsi', 'provinsi_user', 'kota_user', 'cekalamat'));
    }


    public function edit_profil(Request $request)
    {

        $id_user = $request->id_user;
        $id_alamat = $request->id_alamat;

        $user = User::where('id', $id_user)->first();
        $alamat = Address::where('id', $id_user)->first();

        dd($user);

    }



    public function tambahalamat()
    {
        $provinsi = Province::all();
        return view('jual-beli.tambahalamat', compact('provinsi'));
    }

    public function carikota($id)
    {
        $kota = City::where('id_provinsi', $id)->get();
        return response()->json($kota);
    }

    public function tambah_alamat(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $tambah_alamat = Address::create([
            'id_pelanggan' => $id_pelanggan,
            'nama' => $request->nama,
            'provinsi' => $request->provinsi,
            'kota_kabupaten' => $request->kota_kabupaten,
            'kecamatan' => $request->kecamatan,
            'kode_pos' => $request->kode_pos,
            'no_hp'=> $request->no_hp,
            'address' => $request->alamat,
            'status' => '1'

        ]);
        Alert::success('Berhasil');

        return redirect('/profil/edit');
    }

    public function cekalamat($id)
    {
        $id_pelanggan = Auth::user()->id;

        $alamat = Address::where('id', $id)->first();
        $provinsi = $alamat->province->nama;
        $kota = $alamat->city->nama;

        return response()->json(array(
            'alamat' => $alamat,
            'provinsi' =>  $provinsi,
            'kota' => $kota  ));
    }

    public function editalamat(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $alamat = Address::where('id', $request->id_alamat_edit)->first();

        $update_alamat = $alamat->update([
            'nama' => $request->nama_edit,
            'id_pelanggan' => $id_pelanggan,
            'provinsi' => $request->provinsi_edit,
            'kota_kabupaten' => $request->kota_kabupaten_edit,
            'kecamatan' => $request->kecamatan_edit,
            'kode_pos' => $request->kode_pos_edit,
            'no_hp'=> $request->no_hp_edit,
            'address' => $request->alamat_edit
        ]);
        
        return response()->json();

    }


}
