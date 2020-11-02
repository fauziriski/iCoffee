<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Jbcart;
use App\Shop_product;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id_customer = Auth::user()->id;
        $keranjang = Jbcart::where('id_pelanggan', $id_customer)->orderBy('created_at','desc')->get();
        $carttotal = count($keranjang);

        $subtotal = $keranjang->sum('total'); 

        if ($carttotal == 0) {
            infoMessage('Keranjang Anda Kosong');

            return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
            
        }

        return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $id_customer = Auth::user()->id;

        $produk = Shop_product::find($request->id_produk);

        if (!$produk) {
            errorMessage('Produk tidak ditemukan');
            return redirect('/jual-beli');
        }

        if ($request->ketersedian == "Kosong") {
            Alert::warning('Stok Sedang Tidak Tersedia')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$produk->id);
        }

        if ($produk->id_penjual == $id_customer) {
            Alert::warning('Penjual Tidak Boleh Membeli Produk Milik Sendiri')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$produk->id);
        }

        $cek_keranjang = Jbcart::where('id_produk', $produk->id)->where('id_pelanggan', $id_customer)->first();

        if ($cek_keranjang) {
            $jumlah = $request->quantity + $cek_keranjang->jumlah;
            $total = ($produk->harga*$request->quantity)+$cek_keranjang->total;
            $update = $cek_keranjang->update([
                        'jumlah' => $jumlah,
                        'total' => $total
                    ]);

            if ($update) {
                Alert::success('Berhasil')->showConfirmButton('Ok', '#3085d6');
                return redirect('/jual-beli/keranjang');
            }
        }

        $total = $produk->harga*$request->quantity;

        $keranjang = Jbcart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'jumlah' => $request->quantity,
            'harga' => $produk->harga,
            'kode_produk' => $produk->kode_produk,
            'total' => $total,
            'image' => $produk->gambar,
            'id_penjual' => $produk->id_pelanggan

        ]);

        if ($keranjang) {
            Alert::success('Berhasil menambahkan keranjang')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/keranjang');
        }
        else {
            Alert::error('Gagal menambahkan keranjang')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$produk->id);
        }
        
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update($data, $tombol)
    {
        $cart = Jbcart::where('id', $data)->first();


        if($tombol == 'plus')
        {
            if ($cart->jumlah >= 100) 
            {
                $jumlah = $cart->jumlah;
                $total = $cart->total;
                
            }
            else
            {
                $jumlah = $cart->jumlah+1;
                $total = $jumlah*$cart->harga;
                $cart->update([
                    'jumlah' => $jumlah,
                    'total' => $total
                ]);

            }
            

        }
        elseif($tombol == 'minus')
        {
            if ($cart->jumlah <= 1) 
            {
                $jumlah = $cart->jumlah;
                $total = $cart->total;
            }
            else
            {
                $jumlah = $cart->jumlah-1;
                $total = $jumlah*$cart->harga;
                $cart->update([
                    'jumlah' => $jumlah,
                    'total' => $total
                ]);
            }
            

        }
        

        return response()->json(['jumlah' => $jumlah, 'total' => $total]);
    }

    public function updateByValue($id, $jumlah)
    {
        $cart = Jbcart::where('id', $id)->first();

        if ($jumlah > 100) 
        {
            $jumlah_seluruh = $cart->jumlah;
            $total = $cart->total;
            return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'lebih100']);
        }
        elseif ($jumlah < 1) {
            $jumlah_seluruh = $cart->jumlah;
            $total = $cart->total;
            return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'kurang1']);
        }
        else
        {
            $jumlah_seluruh = $jumlah;
            $total = $jumlah_seluruh*$cart->harga;
            $cart->update([
                'jumlah' => $jumlah_seluruh,
                'total' => $total
            ]);

        }

        return response()->json(['jumlah' => $jumlah_seluruh, 'total' => $total, 'status' => 'berhasil']);
    }


    public function destroy($id)
    {
        $product = Jbcart::find($id);

        if ($product) {
            $delete = $product->delete();

            if ($delete) {
                return response()->json('success');
            }
        }
        
    }

    public function storeById(string $slug)
    {
        $id_customer = Auth::user()->id;

        $produk = Shop_product::where(['slug'=> $slug])->get()->first();

        if ($produk->id_pelanggan == $id_customer) {
            Alert::warning('Anda tidak boleh membeli produk ini')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli');
        }

        if (is_null($produk)) {
            
            Alert::error('Produk tidak ditemukan')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli');
        }

        $cek_keranjang = Jbcart::where('id_produk', $produk->id)->where('id_pelanggan', $id_customer)->first();

        if ($cek_keranjang) {
            $jumlah = 1 + $cek_keranjang->jumlah;
            $total = $produk->harga+$cek_keranjang->total;
            $cek_keranjang->update([
                'jumlah' => $jumlah,
                'total' => $total
            ]);

            return redirect('/jual-beli/keranjang');
        }

        $keranjang = Jbcart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $produk->id,
            'nama_produk' => $produk->nama_produk,
            'jumlah' => 1,
            'harga' => $produk->harga,
            'kode_produk' => $produk->kode_produk,
            'total' =>  $produk->harga,
            'image' => $produk->gambar,
            'id_penjual' => $produk->id_pelanggan

        ]);

        if ($keranjang) {
            Alert::success('Berhasil menambahkan keranjang')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/keranjang');
        }
        else {
            Alert::error('Gagal menambahkan keranjang')->showConfirmButton('Ok', '#3085d6');
            return redirect('/jual-beli/produk/'.$produk->slug);
        }
    }

}
