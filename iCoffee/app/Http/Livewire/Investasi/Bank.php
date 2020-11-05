<?php

namespace App\Http\Livewire\Investasi;

use Livewire\Component;
use App\Investor_Bank;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithPagination;

class Bank extends Component
{
    use WithPagination;

    public $bank_name, $name, $norek, $bank_id;

    public function render()
    {
        return view('livewire.investasi.bank', [
            'banks' => Investor_Bank::where('investor_id', Auth::id())->paginate(5)
        ]);
    }

    public function addbank()
    {
        Investor_Bank::create([
            'investor_id' => Auth::id(),
            'bank_name' => $this->bank_name,
            'name' => $this->name,
            'norek' => $this->norek
        ]);
        
        $this->emit('userStore');
        $this->reset();
        session()->flash('success','Tambah Data Rekening Berhasil!');
    }

    public function delete($id)
    {
        if($id){
            Investor_Bank::find($id)->delete();
            session()->flash('delete','Berhasil menghapus data rekening!');
        }
    }

    public function update($id)
    {
        if($id){
            $bank = Investor_Bank::find($id);
            $this->bank_name = $bank->bank_name;
            $this->name = $bank->name;
            $this->norek = $bank->norek;
            $this->bank_id = $id;
        }
    }

    public function updatebank()
    {
        Investor_Bank::where('id', $this->bank_id)->update([
            'bank_name' => $this->bank_name,
            'name' => $this->name,
            'norek' => $this->norek,
        ]);
        $this->emit('update');
        $this->reset();
        session()->flash('updated','Berhasil mengupdate data rekening!');
    }
}
