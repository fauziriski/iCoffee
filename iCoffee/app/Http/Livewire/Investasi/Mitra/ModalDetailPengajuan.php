<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use App\Rincian_pengajuan;

class ModalDetailPengajuan extends Component
{
    public $detail_pengajuan;
    protected $listeners = ['postAdded'];

    public function postAdded($id)
    {
        $this->detail_ajuan = Rincian_pengajuan::where('id_pengajuan', $id)->get();
    }

    public function render()
    {
        return view('livewire.investasi.mitra.modal-detail-pengajuan');
    }
}
