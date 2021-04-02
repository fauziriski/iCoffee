<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use Auth;
use App\Invest_product;
use App\Laporan_penjualan;
use App\Riwayat_penjualan;
use Livewire\WithFileUploads;

class LaporanPenjualan extends Component
{
    use WithFileUploads;
    
    public $products, $product, $produk, $berat, $harga, $foto_produk, $foto_nota, $kode, $id_mitra;
    public $penjualan = [];
    public $total = 0, $harga_total = 0;

    public function mount()
    {
        $this->id_mitra = Auth::user()->id_mitra;
        $this->products = Invest_product::where('id_mitra', $this->id_mitra)->get();
    }

    public function render()
    {
        return view('livewire.investasi.mitra.laporan-penjualan');
    }

    public function hydrate(){
        $this->penjualan = $this->produk == null ? null : Laporan_penjualan::where('kode_produk',$this->produk)->where('status', 1)->get();
    }

    public function addpenjualan(){
        dd($this->foto_nota);
        Laporan_penjualan::create([
            'kode_produk' => $this->product,
            'berat_produk' => $this->berat,
            'harga_jual' => $this->harga,
            'foto_produk' => $this->foto_produk->getFilename(),
            'foto_nota' => $this->foto_nota->getFilename(),
            'status' => 1
        ]);

        $this->foto_produk->storeAs('Investasi/Produk/'.$this->product, $this->foto_produk->getFilename());
        $this->foto_nota->storeAs('Investasi/Produk/'.$this->product, $this->foto_nota->getFilename());

        $this->reset(['product', 'berat','harga','foto_produk','foto_nota']);
        $this->emit('userStore');
        session()->flash('success', 'Laporan Penjualan berhasil ditambahkan!');
    }

    public function setor($id, $berat_tot, $harga_tot){
        Riwayat_penjualan::create([
            'id_mitra' => $this->id_mitra,
            'kode_produk' => $id,
            'total_berat' => $berat_tot,
            'total_penjualan' => $harga_tot,
            'gambar' => "kosong",
            'status' => 1
        ]);

        $this->emit('setorModal');
        session()->flash('suksesSetor', 'Setor Penjualan berhasil ditambahkan!');
        Laporan_penjualan::where('kode_produk', $id)->update(['status' => 2]);
    }
}
