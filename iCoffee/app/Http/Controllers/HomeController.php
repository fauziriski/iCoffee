<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use App\Joint_account;
use App\Account;
use App\User;
use App\Order;
use App\Orderdetail;
use App\Address;
use App\Shop_product;
use App\Image;
use App\Province;
use App\Category;
use App\City;
use App\Confirm_payment;
use App\Auction_Order;
use App\Top_up;
use App\Balance_withdrawal;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Kavist\RajaOngkir\Facades\RajaOngkir;
Use Redirect;
use App\Subdistrict;
use App\Helper\Helper;
use URL;
use DB;


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
        return view('/');
    }

    public function pasangjualbeli()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = User::where('name', $id_pelanggan)->get();
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->whereIn('status', [0,1])->get();



        if($cekalamat->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tambahalamat');       

        }

        $alamat_utama = $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->where('status', 1)->get();

        if(empty($alamat_utama))
        {
            Alert::info('Tentukan Alamat Utama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit');       

        }

        $category = Category::all();
        return view('jual-beli.pasang',compact('category'));
    }


    public function pasangproduk(Request $request)
    {

        $size = count($request->file());
        if ($size == 0) 
        {
            Alert::error('Gagal','Masukan Foto Produk Pertama')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }
        elseif ($size == 1) 
        {
            Alert::error('Gagal','Masukan Foto Produk Kedua')->showConfirmButton('Ok', '#3085d6');
            return back();
            
        }

        $harga = Helper::instance()->removeDot($request->harga);
        $stok = Helper::instance()->removeDot($request->stok);
        
        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
        $oldMarker = $timestamps.$id_pelanggan;
        
        //geser nama gambar
        $image_file = array();
        for ($i=0; $i < 5 ; $i++) 
        { 
            if(!(empty($request->file('image-'.$i))))
            {
                $image_file[] = $request->file('image-'.$i);
            }
        }
      
        $jumlah_gambar_bener = array();
        $jumlah_gambar = count($image_file);
        
        for ($i=0; $i < $jumlah_gambar ; $i++) 
        { 
            $filesize = 0;
            $filesize = filesize($image_file[$i]);
            $filesize = round($filesize / 1024, 2);

            if($filesize > 2048 )
            {
                Alert::error('Gagal','Ukuran Gambar Tidak Lebih Dari 2 Mb')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            elseif(!($image_file[$i]->isValid()))
            {
                Alert::error('Gagal','Gambar yang Anda Masukan Korupt, Ganti dengan Gambar Lain')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            
            elseif($image_file[$i]->getMimeType() == 'image/jpeg' &&  $filesize < 2048)
            {
                $jumlah_gambar_bener[] = $image_file[$i]; 
            }
            elseif($image_file[$i]->getMimeType() == 'image/png' && $filesize < 2048 )
            {
                $jumlah_gambar_bener[] = $image_file[$i];

            }
            else
            {
                Alert::error('Gagal','File yang Anda Masukan Bukan Gambar')->showConfirmButton('Ok', '#3085d6');
                return back();
            }
            
        }

        $this->validate($request,[

            'image-0' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image-4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $folderPath = public_path("Uploads/Produk/{".$oldMarker."}");
        $response = mkdir($folderPath);
        $nama = array();

            for ($i=0; $i < $size; $i++) { 
                if($files = $image_file[$i]){
                    $name=$files->getClientOriginalName();
                    $image_resize = Images::make($files->getRealPath());
                    $image_resize->resize(690, 547);
                    $image_resize->crop(570, 512);
                    $image_resize->save($folderPath .'/'. $name);
                    // $image_resize->move($folderPath,$name);
                    $nama[]=$name;
                
            }

        }

        //Change content to html                
        $content = $request->detail_produk;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        $content = $dom->saveHTML();
    
        $order = Shop_product::create([
            'id_pelanggan' => $id_pelanggan,
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'detail_produk' => $content,
            'gambar' => $nama[0],
            'harga' => $harga,
            'stok' => $stok,
            'kode_produk' => $oldMarker,
            'status' => '1'

        ]);

        $id = $order->id;

        
        for ($i=1; $i < $size ; $i++) {
            Image::create([
                'id_pelanggan' => $id_pelanggan,
                'id_produk' => $id,
                'nama_gambar' => $nama[$i],
                'kode_produk' => $oldMarker

            ]);
        }

        return redirect('/jual-beli');
    }

    public function profile()
    {
        $id_pelanggan = Auth::user()->id;
        $nama_pelanggan = Auth::user()->name;
        $user = User::where('id', $id_pelanggan)->first();
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->whereIn('status', ['0','1'])->get();

        if($cekalamat->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tambahalamat');       

        }

        $provinsi = Province::all();
        
        
        return view('jual-beli.profile', compact('user', 'provinsi', 'cekalamat'));
    }

    public function alamat()
    {
        $id_pelanggan = Auth::user()->id;
        $user = User::where('id', $id_pelanggan)->first();
        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->whereIn('status', ['0','1'])->get();

        if($cekalamat->isEmpty())
        {
            Alert::info('Lengkapi Alamat Terlebih Dahulu')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tambahalamat');       

        }

        $provinsi = Province::all();
        
        
        return view('jual-beli.address', compact('user', 'provinsi', 'cekalamat'));
    }


    public function edit_profile(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|string|max:255',
            'nama' => 'required|string|max:255',
            'password' => 'required|min:8',
        ]);


        $user_id = Auth::user()->id;
        $password = Auth::user()->password;

        if ($password_hash = Hash::check($request->password, $password)) {
            $user = User::where('id', $user_id)->first();

            $user_update = $user->update([
                'name' => $request->nama,
                'email' => $request->email,
    
            ]);
            Alert::success('Berhasil');

            return redirect('/profile/edit');
        }
        
        Alert::error('Gagal','Kata sandi salah')->showConfirmButton('Ok', '#3085d6');

        return redirect('/profile/edit');

    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
            'password_lama' => 'required|min:8',
            'password_baru' => 'required|min:8',
            'cek_password_baru' => 'required|min:8',
        ]);

        $user_id = Auth::user()->id;
        $password = Auth::user()->password;

        if ($request->password_baru != $request->cek_password_baru) {
            Alert::error('Gagal','Kata sandi baru tidak sama')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit#pills-edit-password');
        }

        if ($password_hash = Hash::check($request->password_lama, $password)) {
            $user = User::where('id', $user_id)->first();
            $update = $request->user()->fill([
                        'password' => Hash::make($request->password_baru)
                    ])->save();

            if ($update) {
                Alert::success('Berhasil','Kata sandi berhasil diubah')->showConfirmButton('Ok', '#3085d6');

                return redirect('/profile/edit#pills-edit-password');
            }

            Alert::error('Gagal','Tidak dapat mengubah kata sandi')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit#pills-edit-password');
            
        }

        Alert::error('Gagal','Kata sandi salah')->showConfirmButton('Ok', '#3085d6');
        return redirect('/profile/edit#pills-edit-password');


    }



    public function tambahalamat()
    {
        
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
       
        $id_customer = Auth::user()->id;
        $alamat = Address::where('id_pelanggan', $id_customer)->whereIn('status', [0,1])->first();

        if(!(empty($alamat)))
        {
            Alert::info('Anda Sudah Mengisi Alamat')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/edit');  
        }
        $provinsi = Province::all();
        
        return view('jual-beli.tambahalamat', compact('provinsi'));
    }

    public function carikota($id)
    {
        $kota = City::where('id_provinsi', $id)->get();
        return response()->json($kota);
    }

    public function subdistrict($id)
    {
        $subdistrict = Subdistrict::where('city_id', $id)->get();

        if ($subdistrict) {
            return response()->json($subdistrict);
        }
        
    }

    public function tambah_alamat(Request $request)
    {

        $validateData = $this->validate($request, [
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|max:13|min:11',
            'provinsi' => 'required|exists:provinces,id',
            'kota_kabupaten' => 'required|exists:cities,id',
            'kecamatan' => 'required|exists:subdistricts,id',
            'kode_pos' => 'max:6|min:5',
            'alamat' => 'required|string|max:255'
        ]);

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

        $provider = User::where('id',$id_pelanggan);
        $provider->update([
            'provider_id' => "114101115117",
        ]);
        

        
        if (session('links')[0] == 'jual-beli/checkout-barang') {
            session()->forget('links');
            Alert::success('Berhasil','Berhasil Menambahkan Alamat')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/keranjang');
        }
        session()->forget('links');
        Alert::success('Berhasil');
        return redirect('/profile/alamat#pills-daftar-alamat');
        
    }

    public function cekalamat($id)
    {
        $id_pelanggan = Auth::user()->id;

        $alamat = Address::where('id', $id)->first();
        $provinsi = $alamat->province->nama;
        $kota = $alamat->city->nama;
        $type = $alamat->city->type;
        $kecamatan = $alamat->subdistrict->name;

        return response()->json(array(
            'alamat' => $alamat,
            'provinsi' =>  $provinsi,
            'kota' => $kota,
            'type' => $type,
            'kecamatan' => $kecamatan  ));
    }

    public function editalamat(Request $request)
    {
        $validateData = $this->validate($request, [
            'id_alamat_edit' => 'required|exists:addresses,id',
            'nama_edit' => 'required|string|max:255',
            'no_hp_edit' => 'required|max:13|min:11',
            'provinsi_edit' => 'required',
            'kota_kabupaten_edit' => 'required',
            'kecamatan_edit' => 'required',
            'kode_pos_edit' => 'max:6|min:5',
            'alamat_edit' => 'required|string|max:255'
        ]);

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

    public function alamathapus($id)
    {
        $id_pelanggan = Auth::user()->id;

        $alamat = Address::where('id', $id)->first();
        $update_alamat = $alamat->update([
            'status' => 2
        ]);

        $cek_alamat = Address::where('id_pelanggan', $id_pelanggan)->where('status', 1)->first();

        if(empty($cek_alamat))
        {
            $cek_alamat_tersedia = Address::where('id_pelanggan', $id_pelanggan)->where('status', 0)->first();
            if(!(empty($cek_alamat_tersedia)))
            {
                $ubah_alamat_utama = $cek_alamat_tersedia->update([
                    'status' => 1
                ]);
                return response()->json();
            }
            return response()->json();
        }
       
        return response()->json();
    }


    public function invoicetopup_detail($id)
    {
        $cek_data = Top_up::where('invoice', $id)->first();

        $cek_bank = Account::where('bank_name', $cek_data->payment)->first();

        return response()->json(['invoice' => $cek_data, 'bank' => $cek_bank]);

    }

    public function pembayaran()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Order::where('id_pelanggan', $id_pelanggan)->whereIn('status',[1,2])->orderBy('created_at','desc')->get();

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

        return view('jual-beli.confirm_payment', compact('data_invoice', 'jumlah', 'data_tanggal','transaksipenjual'));
    }

    

    public function konfirmasipembayaran(Request $request)
    {
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'email' => 'required',
            'nama_bank_pengirim' => 'required',
            'no_rekening_pengirim' => 'required',
            'no_telp' => 'required',
            'nama_pemilik_pengirim' => 'required',
            'jumlah_transfer' => 'required',
            'invoice' => 'required',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $folderPath = public_path("Uploads/Konfirmasi_Pembayaran/JualBeli/".$request->invoice."");
        $response = mkdir($folderPath);
        
        $image = $request->foto_bukti;
        $name=$image->getClientOriginalName();
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $jumlah_transfer = Helper::instance()->removeDot($request->jumlah_transfer);

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '1',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $jumlah_transfer,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        if ($confirm_pesanan) {
            $order = Order::where('invoice', $request->invoice)->update([
                'status' => '8'
            ]);
    
            Alert::success('Berhasil', 'Konfirmasi berhasil')->showConfirmButton('Ok', '#3085d6');
    
            return redirect('/jual-beli/invoice/'. $request->invoice);
        }
        else {
            Alert::error('Gagal', 'Konfirmasi gagal')->showConfirmButton('Ok', '#3085d6');
    
            return redirect('/jual-beli/konfirmasi');
        }

        
        
    }

    public function updatepersmisson()
    {
        for ($i=11; $i <14 ; $i++) { 
            for ($j=5; $j <6 ; $j++) { 
                $update = DB::table('model_has_permissions')->insert(
                    ["permission_id" => $j, "model_type" => "App\User", "model_id" => $i]
                );
            }
            
        }
        
    }

    public function bycript($data)
    {
            // $user = User::create([
            //     'name' => 'Admin User',
            //     'email' => 'adminuser@icoffee.asia',
            //     'password' =>  bcrypt('icoffee.asia'),
            //     'provider_id' => 'admin-icoffee',
            // ]);

            $decrypt = bcrypt($data);
            dd($decrypt);


    
            // $user->assignRole('adminuser');
    }



    public function top_up()
    {
        return view('jual-beli.lelang.top_up');
    }

    public function invoice_top_up()
    {
        return view('jual-beli.lelang.invoice_top_up');
    }

    public function top_up_diproses(Request $request)
    {
       
        $this->validate($request,[
            'email' => 'required',
            'bank' => 'required|exists:accounts,bank_name',
            'jumlah' => 'required'

        ]);
        
        $jumlah = Helper::instance()->removeDot($request->jumlah);

        $user_id = Auth::user()->id;
        $timestamps = date('YmdHis');
        $oldMarker = $timestamps.$user_id;

        if ($jumlah > 1000000) {
            Alert::error('Gagal', 'Max top up Rp 1.000.000')->showConfirmButton('Ok', '#3085d6');
            return back();
        }


        $top_up = Top_up::create([
            'user_id' => $user_id, 
            'email'=> $request->email, 
            'invoice'=> $oldMarker, 
            'jumlah'=> $jumlah,
            'payment' => $request->bank, 
            'status' => 1
        ]);
        Alert::info('Berhasil','Segera Konfirmasi Pembayaran Anda')->showConfirmButton('Ok', '#3085d6');

        return redirect('profile/top_up/history#pills-topup-masuk');
    }

    public function konfirmasi_top_up()
    {
        $id_pelanggan = Auth::user()->id;
        $transaksipenjual = Top_up::where('user_id', $id_pelanggan)->whereIn('status',[1,2])->get();
        $data_tanggal = array();
        foreach ($transaksipenjual as $data) {
            $data_tanggal = date('Y-m-d', strtotime($data->created_at));   
        }
        return view('jual-beli.topup.confirm_topup', compact('data_tanggal','transaksipenjual'));
    }

    public function konfirmasipembayarantopup(Request $request)
    {
        
        $id_pelanggan = Auth::user()->id;
        $this->validate($request,[
            'email' => 'required|exists:users,email',
            'nama_bank_pengirim' => 'required',
            'no_rekening_pengirim' => 'required',
            'no_telp' => 'required|max:13|min:11',
            'nama_pemilik_pengirim' => 'required|max:224',
            'jumlah_transfer' => 'required',
            'invoice' => 'required|exists:top_up,invoice',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $jumlah = Helper::instance()->removeDot($request->jumlah_transfer);

        $image = $request->foto_bukti;
        $name = 'confirm_top_up_' .$request->invoice .'_' . \Carbon\Carbon::now()->format('Ymd_His'). '-' .uniqid() . '.' . $image->getClientOriginalExtension();
        $folderPath = public_path("Uploads/Konfirmasi_Pembayaran/Lelang/".$request->invoice."");
        $response = mkdir($folderPath);
        $image_resize = Images::make($image->getRealPath());
        $image_resize->save($folderPath .'/'. $name);

        $confirm_pesanan = Confirm_payment::create([
            'id_pelanggan' => $id_pelanggan,
            'email' => $request->email,
            'no_rekening_pengirim' => $request->no_rekening_pengirim,
            'nama_bank_pengirim' => $request->nama_bank_pengirim,
            'nama_pemilik_pengirim' => $request->nama_pemilik_pengirim,
            'jasa' => '3',
            'no_telp' => $request->no_telp,
            'jumlah_transfer' => $jumlah,
            'invoice' => $request->invoice,
            'foto_bukti' => $name,
            'status' => '1'
        ]);

        if ($confirm_pesanan) {
            $order = Top_up::where('invoice', $request->invoice)->update([
                'status' => '8'
            ]);
            Alert::success('Berhasil','Konfirmasi top up berhasil silahkan tunggu info selanjutnya')->showConfirmButton('Ok', '#3085d6');
    
            return redirect('/profile/top_up/history#pills-topup-masuk');
        }

        Alert::error('Gagal','Konfirmasi top up gagal')->showConfirmButton('Ok', '#3085d6');
        return back();
    }

    public function produksaya()
    {
        $user_id = Auth::user()->id;

        $produk = Shop_product::where('id_pelanggan', $user_id)->get();
        $category = Category::all();

        return view('jual-beli.produk', compact('produk', 'category'));
    }

    

    

    public function tambah_alamat_cadangan(Request $request)
    {

        $validateData = $this->validate($request, [
            'nama_alamat' => 'required|string|max:255',
            'no_hp_alamat' => 'required|max:13|min:11',
            'provinsi_alamat' => 'required',
            'kota_kabupaten_alamat' => 'required',
            'kecamatan_alamat' => 'required',
            'kode_pos_alamat' => 'max:6|min:5',
            'alamat_alamat' => 'required|string|max:255'
        ]);

        $id_pelanggan = Auth::user()->id;

        $cekalamat = Address::where('id_pelanggan', $id_pelanggan)->get();

        $jumlah_alamat = count($cekalamat);

        if ($jumlah_alamat >= 5) {
            Alert::error('Gagal','Jumlah alamat anda sudah melebihi batas')->showConfirmButton('Ok', '#3085d6');

            return redirect('/profile/edit');
            
        }

        $tambah_alamat = Address::create([
            'id_pelanggan' => $id_pelanggan,
            'nama' => $request->nama_alamat,
            'provinsi' => $request->provinsi_alamat,
            'kota_kabupaten' => $request->kota_kabupaten_alamat,
            'kecamatan' => $request->kecamatan_alamat,
            'kode_pos' => $request->kode_pos_alamat,
            'no_hp'=> $request->no_hp_alamat,
            'address' => $request->alamat_alamat,
            'status' => '0'

        ]);

        $provider = User::where('id',$id_pelanggan);
        $provider->update([
            'provider_id' => "114101115117",
        ]);

        if ($tambah_alamat) {
            Alert::success('Berhasil', 'Alamat berhasil ditambahkan')->showConfirmButton('Ok', '#3085d6');

            return redirect('/profile/alamat#pills-daftar-alamat');
        } else {
            Alert::error('Gagal', 'Alamat gagal ditambahkan')->showConfirmButton('Ok', '#3085d6');

            return redirect('/profile/alamat');
        }
        

    }

    public function alamat_utama($id)
    {
        $user_id = Auth::user()->id;
        $alamat = Address::where('id_pelanggan', $user_id)->whereIn('status', [0,1])->update([
            'status' => 0
        ]);


        $alamat_utama = Address::where('id', $id)->first();
        $alamat_utama->update([
            'status' => 1
        ]);
        
        // if (session('links')[0] == 'jual-beli/checkout-barang') {
        //     session()->forget('links');
        //     Alert::success('Berhasil','Berhasil Mengganti Alamat Utama')->showConfirmButton('Ok', '#3085d6');
        //     return redirect('/jual-beli/keranjang');
        // }
        // session()->forget('links');
        return redirect('/profile/alamat#pills-daftar-alamat');

    }

    public function tarik_saldo()
    {
        $id_pelanggan = Auth::user()->id;

        $cek_saldo = Joint_account::where('user_id', $id_pelanggan)->first();
        return view('jual-beli.topup.pencairan_saldo', compact('cek_saldo'));
    }

    public function tarik_saldo_konfirmasi(Request $request)
    {
        $this->validate($request,[

            'email' => 'required|exists:users,email',
            'bank' => 'required|exists:accounts,bank_name',
            'no_rek' => 'required',
            'pemilik' => 'required',
            'jumlah' => 'required',
            'password' => 'required',

        ]);
        $id_pelanggan = Auth::user()->id;
        $jumlah = Helper::instance()->removeDot($request->jumlah);

        $cek_saldo = Joint_account::where('user_id', $id_pelanggan)->first();

        if ($cek_saldo->saldo < $jumlah) {
            Alert::error('Gagal', 'Gagal melakukan penarikan, saldo yang anda miliki '. $cek_saldo->saldo )->showConfirmButton('Ok', '#3085d6');
            return back();
        }



        $user = User::where('id', $id_pelanggan)->first();
        $password = Str::camel($user->password);

        $timestamps = date('YmdHis');
        $id_pelanggan = Auth::user()->id;
        $oldMarker = 'TRKSALDO'.$timestamps.$id_pelanggan;

        // $decrypted = Crypt::decryptString($password);
        if ($password_hash = Hash::check($request->password, $password)) {
           $tariksaldo =  Balance_withdrawal::create([
                            'user_id' => $id_pelanggan, 
                            'invoice' => $oldMarker, 
                            'jumlah' => $jumlah, 
                            'status' => 1,
                            'email' => $request->email,
                            'bank' => $request->bank,
                            'no_rekening'  => $request->no_rek,
                            'pemilik_rekening' => $request->pemilik
                        ]);
            
            if ($tariksaldo) {
                Alert::success('Berhasi', 'Berhasil melakukan penarikan, tunggu info selanjutnya')->showConfirmButton('Ok', '#3085d6');
                return redirect('/profile/top_up/history#pills-topup-keluar');
            }
                Alert::error('Gagal', 'Gagal melakukan petarikan')->showConfirmButton('Ok', '#3085d6');
                return redirect('/profile/tarik_saldo');
        }
        else{
            Alert::error('Gagal', 'Password anda salah')->showConfirmButton('Ok', '#3085d6');
            return redirect('/profile/tarik_saldo');
        }
     
    }

    public function cek_invoice_dana($invoice)
    {

        $cek_data = Balance_withdrawal::where('invoice', $invoice)->first();

        return response()->json($cek_data);

    } 

    public function batal_tarik_dana($invoice)
    {
        $cek_data = Balance_withdrawal::where('invoice', $invoice)->first();
        $cek_data->update([
            'status' => 5
        ]);

        Alert::success('Berhasi', 'Pencairan Dana Anda Berhasil Dibatalkan')->showConfirmButton('Ok', '#3085d6');
        return redirect('/profile/top_up/history#pills-topup-keluar');
        
    }


}
