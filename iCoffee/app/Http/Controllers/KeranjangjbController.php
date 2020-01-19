<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\User;
use App\Shop_product;
use App\Image;
use App\JbCart;
use App\Address;
use App\Delivery;
use DB;

class KeranjangjbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function keranjang()
    {

        $id_customer = Auth::user()->id;
        $keranjang = JbCart::where('id_pelanggan', $id_customer)->orderBy('created_at','desc')->get();
        $subtotal = $keranjang->sum('total');
        $carttotal = $keranjang->count();

        return view('jual-beli.keranjang', compact('keranjang','subtotal','carttotal'));
    }

    public function tambahkeranjang(Request $request)
    {
        $id_customer = Auth::user()->id;

        $total = $request->harga*$request->quantity;

        $keranjang = JbCart::create([
            'id_pelanggan' => $id_customer,
            'id_produk' => $request->id_produk,
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->quantity,
            'harga' => $request->harga,
            'kode_produk' => $request->kode_produk,
            'total' => $total,
            'image' => $request->gambar

        ]);

        $keranjang = JbCart::where('id_pelanggan', $id_customer)->get();


        return redirect('/jual-beli/keranjang');
    }

    public function checkout()
    {
        return view('jual-beli.checkout');
    }

    public function checkoutbarang(Request $request)
    {
        $this->validate($request,[

            'id' => 'required'
        ]);

        $id_customer = Auth::user()->id;
        $alamat = Address::where('id_pelanggan', $id_customer)->where('status', 1)->first();
        
        $id = $request->id;

        $checkout = JbCart::whereIn('id', $request->id)->get();
        
        
        foreach ($checkout as $data) {

            
            $produk[] = Shop_product::find($data->id_produk);
            
        }

        foreach ($produk as $data) {

            $alamat_penjual[] = Address::where('id_pelanggan', $data->id_pelanggan)
                                        ->where('status', 1)->first();
            
        }

        $berat = $checkout->sum('jumlah');
        $jumlah = $checkout->sum('total');

        $pengirim = $alamat_penjual[0]->kota_kabupaten;
        $penerima = $alamat->kota_kabupaten;

        // $delivery = Delivery::Where(function($x) {
        //         $x->where('asal', 'JAKARTA PUSAT')
        //           ->Where('tujuan', 'BANDAR LAMPUNG');
        //         })->orWhere(function($q) {
        //             $q->where('asal', 'BANDAR LAMPUNG')
        //               ->Where('tujuan', 'JAKARTA PUSAT');
        //             })->get();

        // $request->session()->keep([$alamat_penjual], [$alamat]);
        session(['alamat_penjual' => $pengirim]);
        session(['alamat' => $penerima]);
        session(['berat' => $berat]);
        


        return view('jual-beli.checkout', compact('checkout','alamat','jumlah'));


    }

    public function updatekeranjang(Request $request)
    {
        $cart = JbCart::where('id', $request->id)->first();
        $cart->update([
            'jumlah' => $request->quantity

        ]);

    }

    public function pesanbarang(Request $request)
    {
        dd($request);
    }

    

    public function hapus($id)
    {
        $flight = JbCart::find($id);

        $flight->delete();

        return redirect('/jual-beli/keranjang');

    }

    public function cekongkir($kurir)
    {
        $client = new Client();

        $alamat_penjual = $request->session()->get('alamat_penjual');
        $alamat = $request->session()->get('alamat');
        $berat = $request->session()->get('berat');


        try{
            $response = $client->request('POST','https://api.rajaongkir.com/starter/cost',
                [
                    'body' => 'origin='.$alamat_penjual.'&destination='.$alamat.'&weight='.$request->berat.'&courier=tiki',
                    'headers' => [
                        'key' => '173f863cc1b39ff155f1d8058cebc703',
                        'content-type' => 'application/x-www-form-urlencoded',
                        
                    ]
                ]
            );
        }
        catch(RequestException $e){
            var_dump($e->getResponse()->getBody()->getContents());
        }
        $json = $response->getBody()->getContents();


        $array_result = json_decode($json, true);

        $myJSON = json_encode($array_result);

        echo $myJSON;

        // return response()->json($array_result);

    }
    
}
