<?php

namespace App\Http\Controllers\JualBeli\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Images;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Balance_withdrawal;
use App\Helper\Helper;
use App\Top_up;
use App\Order;
use App\User;


class TransactionController extends Controller
{
    
    public function index()
    {
        // blm bayar 1
        // sudah dibbayar 2
        // proses penjual 3
        // penjual menerima 4 menolak 0
        // dikriim 5
        // terkirim 6
        // komplin 7
        // konfirmasi diproses 8
        // batalkan pesanan pembeli 9
        $id_pelanggan = Auth::user()->id;
        $transaksipembeli = Order::where('id_pelanggan', $id_pelanggan)->orderBy('created_at','desc')->paginate(5);
        $transaksipenjual = Order::where('id_penjual', $id_pelanggan)->whereIn('status',[0,3,4,5,6,7])->orderBy('created_at','desc')->paginate(5);

        $jumlah_transaksi_penjual = count($transaksipenjual);
        $kurir_data = array();
        $total_bayar = array();
        for ($i=0; $i < $jumlah_transaksi_penjual ; $i++) { 
            $kurir_penjual = explode(': ',  $transaksipenjual[$i]->shipping);
            $kurir_data[] =  $kurir_penjual[0];
            $total_bayar[] =  $transaksipenjual[$i]->total_bayar+$kurir_penjual[0];
        }

        $jumlah_transaksi_beli = count($transaksipembeli);

        $invoice = array();
        $tanggal = array();
        

        for ($i=0; $i < $jumlah_transaksi_beli; $i++) { 
            if(!(in_array($transaksipembeli[$i]->invoice, $invoice))){
                $invoice[] = $transaksipembeli[$i]->invoice;
                $tanggal[] = $transaksipembeli[$i]->created_at;
            }
        }
        $cek_data = array();

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

        $transaksi_top_up = Top_up::where('user_id', $id_pelanggan)->orderBy('updated_at','desc')->paginate(5);
        $count_transaksi_top_up = count($transaksi_top_up);

        $transaksi_penarikan = Balance_withdrawal::where('user_id', $id_pelanggan)->orderBy('updated_at','desc')->paginate(5);

        return view('jual-beli.transaksi', compact('invoice','transaksipembeli','tanggal','transaksi_penarikan', 'count_transaksi_top_up','transaksi_top_up', 'hitung_invoice', 'cek_data','kurir_data', 'jumlah_transaksi_penjual','total_bayar','transaksipenjual'));
    }
}
