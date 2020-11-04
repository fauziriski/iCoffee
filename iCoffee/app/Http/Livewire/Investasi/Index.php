<?php

namespace App\Http\Livewire\Investasi;

use App\Invest_product;
use Livewire\Component;

class Index extends Component
{
    public $search_product;

    public function render()
    {
        return view('livewire.investasi.index', [
            'products' => $this->search_product == null ? Invest_product::where('status', 2)->orderBy('created_at','desc')->paginate(12) : Invest_product::where('status', 2)->where('nama_produk','like','%'.$this->search_product.'%')->orderBy('created_at','desc')->paginate(12)
        ]);
    }
}
