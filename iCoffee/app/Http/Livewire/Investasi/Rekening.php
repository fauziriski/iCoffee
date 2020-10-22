<?php

namespace App\Http\Livewire\Investasi;

use Livewire\Component;
use App\Investor_Bank;
use Auth;

class Rekening extends Component
{

    public function render()
    {
        return view('livewire.investasi.rekening', [
            'banks' => Investor_Bank::where('investor_id', Auth::id())->get(),
        ]);
    }

}
