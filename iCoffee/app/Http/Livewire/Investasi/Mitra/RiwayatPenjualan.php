<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use App\Riwayat_penjualan;
use Auth;

class RiwayatPenjualan extends Component
{
    public $product, $riwayats, $id_mitra;

    public function mount(){
        $this->id_mitra = Auth::user()->id_mitra;
        $this->riwayats = Riwayat_penjualan::where('id_mitra', $this->id_mitra)->get();
    }

    public function render()
    {
        return view('livewire.investasi.mitra.riwayat-penjualan');
    }
}
