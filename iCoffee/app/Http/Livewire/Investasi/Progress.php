<?php

namespace App\Http\Livewire\Investasi;

use Livewire\Component;
use App\invest_order;
use App\Invest_product;
use App\Progress_investasi;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Progress extends Component
{
    public $orders;
    public $produk = [];
    public $progress = [];

    public function mount()
    {
        $this->orders = invest_order::where('id_investor', Auth::id())->where('status', 2)->get();
        if(!$this->orders->isEmpty()){
            foreach($this->orders as $ord){
                $this->produk = Invest_product::where('id', $ord->id_produk)->get();
            }
            foreach($this->produk as $ord){
                $this->progress = Progress_investasi::where('kode_produk', $ord->kode_produk)->where('status', 2)->get();
            }
            return view('livewire.investasi.progress');
        }else
        {
            Alert::toast('Silahkan pesan terlebih dahulu!', 'warning');
            return redirect()->to('/invest');
        }
    }

    public function render()
    {
        return view('livewire.investasi.progress');
    }
}
