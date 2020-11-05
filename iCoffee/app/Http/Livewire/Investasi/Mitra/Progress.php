<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use App\Invest_product;
use Auth;
use App\File_progress;
use App\Progress_investasi;
use Livewire\WithFileUploads;

class Progress extends Component
{
    use WithFileUploads;
    
    public $products, $product, $judul, $deskripsi, $id_mitra;
    public $photos = [];
    public $videos = [];

    public function mount()
    {
        $this->id_mitra = Auth::user()->id_mitra;
        $this->products = Invest_product::where('id_mitra', $this->id_mitra)->get();
    }


    public function render()
    {
        return view('livewire.investasi.mitra.progress',[
            'progress' => Progress_investasi::where('id_mitra', $this->id_mitra)->get()
        ]);
    }
    
    public function store()
    {
        $this->validate([
            'photos.*' => 'image|max:2048', // 2MB Max
            'videos.*' => 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:40000'
        ]);
        
        $progress = Progress_investasi::create([
            'id_mitra' => $this->id_mitra,
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'kode_produk' => $this->product,
            'status' => 1,
        ]);
        // 0 = ditolak
        // 1 = diproses
        // 2 = sukses
        foreach ($this->photos as $photo){
            File_progress::create([
                'progress_investasi_id' => $progress->id,
                'nama' => $photo->getFilename(),
                'type' => 'photo',
            ]);
            $photo->storeAs('Investasi/Produk/'.$this->product, $photo->getFilename());
        }
        foreach ($this->videos as $video){
            File_progress::create([
                'progress_investasi_id' => $progress->id,
                'nama' => $video->getFilename(),
                'type' => 'video',
            ]);
            $video->storeAs('Investasi/Produk/'.$this->product, $video->getFilename());
        }
        $this->reset(['judul', 'deskripsi','photos','videos']);

        session()->flash('success', 'Progress berhasil ditambahkan!');
    }
}
