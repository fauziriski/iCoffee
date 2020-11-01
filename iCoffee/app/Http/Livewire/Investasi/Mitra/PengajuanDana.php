<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use App\Invest_product;
use Auth;

class PengajuanDana extends Component
{
    public $judul, $product, $desc, $products;
    public $inputs = [];
    public $i = 0;

    public function mount()
    {
        $this->products = Invest_product::where('id_mitra', Auth::user()->id_mitra)->get();
        $this->inputs = [
            ['produk_name' => '', 'price' => '', 'qty' => '']
        ];
    }
    public function render()
    {
        return view('livewire.investasi.mitra.pengajuan-dana');
    }

    public function pengajuan()
    {
        dd($this);

    }

    public function add()
    {
        $this->inputs[] = ['produk_name' => '', 'price' => '', 'qty' => ''];
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        $this->inputs = array_values($this->inputs);
    }
}
