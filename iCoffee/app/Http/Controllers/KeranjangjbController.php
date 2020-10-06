<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\User;
use App\Shop_product;
use App\Image;
use App\Jbcart;
use App\Address;
use App\Delivery;
use App\Delivery_category;
use App\Order;
use App\Orderdetail;
use App\Rating;
use App\Account;
use App\Joint_account;
use App\Complaint;
use DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Helper\Helper;
// use Kavist\RajaOngkir\RajaOngkir;


class KeranjangjbController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function province(Request $request)
    {
        
        $array = array(
            "origin" => "501",
            "destination" => "114",
            "weight" => "1",
            "courier" => "tiki",
        );
        $data = Helper::instance()->cekOngkir($array);

        //$costjne["rajaongkir"]["results"][0]["costs"][]
    }

    function file_get_content_curl () 
    {
        // Throw Error if the curl function does'nt exist.
        $Url = '127.0.0.1:8000/jual-beli/province/data';
        if (!function_exists('curl_init'))
        { 
            die('CURL is not installed!');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }



    public function pesanbarang(Request $request)
    {

        $id_customer = Auth::user()->id;
        $hitung = count(collect($request)->get('id_toko'));
        $jumlah_keranjang = count(collect($request)->get('id_keranjang'));

        for ($i=0; $i < $hitung ; $i++)
        {
            $id_produks[] = $request->id_produk[$i];
        }    

        for ($i=0; $i < $hitung ; $i++) { 
            $split[] = explode(': ', $request->kurir[$i]);
        }

        for ($i=0; $i < $hitung ; $i++) { 
            $kategori_pengiriman[] = Delivery_category::where('nama_pengiriman', $split[$i][1])->first();
        }
        // $alamat = Address::where('id', $request->id_alamat)->where('status', 1)->first();
        // dd($request);
        $timestamps = date('YmdHis');
        $invoice = $timestamps.$id_customer;

        for ($i=0; $i < $hitung ; $i++) { 
            $totalbayar[] = $request->total_bayar[$i]+$split[$i][0];
        }

        for ($i=0; $i < $jumlah_keranjang ; $i++) { 
            $flight = Jbcart::where('id', $request->id_keranjang[$i])->first();
            $flight->delete();
        }


        for ($i=0; $i < $hitung ; $i++) { 

            $order[] = Order::create([
                        'id_pelanggan' => $id_customer,
                        'id_alamat' => $request->id_alamat,
                        'nama' => $request->nama_alamat,
                        'invoice' => $invoice,
                        'status' => '1',
                        'payment' => $request->bank,
                        'shipping' => $request->kurir[$i],
                        'pesan' => $request->pesan[$i],
                        'total_bayar' =>$request->total_bayar[$i],
                        'id_penjual' => $request->id_toko[$i]
    
            ]);      

        }

        for ($i=0; $i < $hitung ; $i++) { 
            $id[] = $order[$i]->id;
        }

        for ($i=0; $i < $hitung ; $i++) { 
            $id[] = $order[$i]->id;
        }

        for ($i=0; $i < $hitung ; $i++) { 
            for ($j=0; $j < count($request->id_penjual[$i]) ; $j++) { 
                $alamat_penjual[$i][] = Address::where('id_pelanggan', $request->id_penjual[$i][$j])->where('status', 1)->first();
            }
        }

        for ($i=0; $i < $hitung ; $i++) { 
            for ($j=0; $j < count($request->id_penjual[$i]) ; $j++) { 

                $orderdetail[$i][] = Orderdetail::create([
                                'id_pelanggan' => $id_customer,
                                'id_penjual' => $request->id_penjual[$i][$j],
                                'id_order' => $id[$i],
                                'id_produk' => $request->id_produk[$i][$j],
                                'nama_produk' =>$request->nama_produk[$i][$j],
                                'invoice' => $invoice,
                                'jumlah' => $request->jumlah[$i][$j],
                                'harga' => $request->harga[$i][$j],
                                'total' => $request->total[$i][$j],
                                'kode_produk' =>  $request->total[$i][$j],
                                'gambar' => $request->gambar[$i][$j],
                                'id_alamat_penjual' => $alamat_penjual[$i][$j]->id
        
                    
                ]);
                $ids[$i][] = $orderdetail[$i][$j]->id;
            }

        }


        for ($i=0; $i < $hitung ; $i++) {

            Delivery::create([
                'ongkos_kirim' => $split[$i][0],
                'id_order' => $id[$i],
                'nama' => $request->kurir[$i],
                'invoice' =>  '',
                'id_kategori_kurir' => $kategori_pengiriman[$i]->id
      
            ]);

        }
        
        return redirect('/jual-beli/invoice/'.$invoice);
        
        
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

    public function rating(Request $request)
    {
        $rating = Rating::where('id_order', $request->id_order_rating)->where('jasa', 1)->first();
        $rating->update([
            'rating' => $request->whatever1
        ]);

        return response()->json();
    }
    
}
