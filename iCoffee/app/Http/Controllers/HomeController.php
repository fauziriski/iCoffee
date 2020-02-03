<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\Order;
use App\Orderdetail;
use App\Address;
use App\Shop_product;
use App\Image;
use App\Province;
use App\City;
use App\Confirm_payment;
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

    public function transaksi()
    {
        // blm bayar 1
        // sudah dibbayar 2
        // proses penjual 3
        // penjual menerima 4 dibatalkan 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        $id_pelanggan = Auth::user()->id;
        $transaksipembeli = Order::where('id_pelanggan', $id_pelanggan)->get();
        $transaksipenjual = Order::where('id_pelanggan', $id_pelanggan)->whereIn('status',[0,3,4,5,6,7])->get();

        $jumlah_transaksi_beli = count($transaksipembeli);

        $invoice = array();
        $tanggal = array();
        

        for ($i=0; $i < $jumlah_transaksi_beli; $i++) { 
            if(!(in_array($transaksipembeli[$i]->invoice, $invoice))){
                $invoice[] = $transaksipembeli[$i]->invoice;
                $tanggal[] = $transaksipembeli[$i]->created_at;
            }
        }

        $hitung_invoice = count($invoice);
        for ($i=0; $i < $hitung_invoice; $i++) { 
            $total_pembayaran = 0;
            $total_ongkos_kirim = 0;
            $jumlah_seluruh = 0;
            $ongkir = 0;
            $jumlah_invoice = Order::where('invoice', $invoice[$i])->get();
            $hitung_jumlah_invoice = count($jumlah_invoice);
            for ($j=0; $j < $hitung_jumlah_invoice ; $j++) { 
                $kurir = explode(': ', $jumlah_invoice[$j]->shipping);
                $ongkir += $kurir[0];
                $jumlah_seluruh +=  $jumlah_invoice[$j]->total_bayar;                
            }
            $cek_data[] =  $jumlah_seluruh+$ongkir;

        }

        return view('jual-beli.transaksi', compact('invoice','tanggal', 'hitung_invoice', 'cek_data'));
    }

    public function pembayaran()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Order::where('id_pelanggan', $id_pelanggan)->where('status',1)->get();

        $jumlah_invoice = count($transaksipenjual);

        $data_invoice = array();
        $data_tanggal = array();
        for ($i=0; $i < $jumlah_invoice ; $i++) { 
            if(!(in_array($transaksipenjual[$i]->invoice, $data_invoice))){
                $data_invoice[] = $transaksipenjual[$i]->invoice;
                $data_tanggal[] = date('Y-m-d', strtotime($transaksipenjual[$i]->created_at));

            }
        }
        $jumlah = count($data_invoice);

        return view('jual-beli.confirm_payment', compact('data_invoice', 'jumlah', 'data_tanggal'));
    } 

    public function konfirmasipembayaran(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'foto_bukti' => 'required|image|max:2048'
        ]);

        $folderPath = public_path("Uploads\Konfirmasi_Pembayaran\JualBeli\{$request->invoice}");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '1',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $request->jumlah_transfer,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        $order = Order::where('invoice', $request->invoice)->update([
            'status' => '8'
        ]);

        Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');

        return redirect('/jual-beli');
    }

    public function konfirmasipembayaranlelang(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'foto_bukti' => 'required|image|max:2048'
        ]);

        $folderPath = public_path("Uploads\Konfirmasi_Pembayaran\{$request->invoice}");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '1',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $request->jumlah_transfer,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        $order = Order::where('invoice', $request->invoice)->update([
            'status' => '8'
        ]);

        Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');

        return redirect('/jual-beli');
    }






}
