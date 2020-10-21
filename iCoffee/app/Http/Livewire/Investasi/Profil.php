<?php

namespace App\Http\Livewire\Investasi;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\User;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class Profil extends Component
{
    use WithFileUploads;

    public $photo, $email, $name, $password, $telephone, $foto;

    public function mount()
    {
        $this->email = Auth::user()->email;
        $this->name = Auth::user()->name;
        $this->telephone = Auth::user()->telephone;
        $this->foto = Auth::user()->photo;
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'password' => 'min:8',
            'photo' => 'image|max:1024'
        ]);
    }
    
    public function render()
    {
        return view('livewire.investasi.profil');
    }

    public function update()
    {

        User::find(Auth::id())->update([
            'name' => $this->name,
            'email' => $this->email,
            'photo' => $this->photo->getFilename()
        ]);

        if($this->photo != null){
            $this->photo->storeAs('Investasi/Profil', $this->photo->getFilename());
        }
        if($this->password != null){
            User::find(Auth::id())->update([
                'password' => Hash::make($this->password),
            ]);
        }

        session()->flash('success', 'Profil berhasil diupdate!');
    }
}
