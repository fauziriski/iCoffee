<?php

namespace App\Http\Livewire\Investasi\Mitra;

use Livewire\Component;
use App\Invest_product;
use App\Pengajuan_dana;
use App\Rincian_pengajuan;
use Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PengajuanDana extends Component
{
    use WithPagination;

    public $judul, $product, $desc, $products, $id_mitra, $pengajuan_dana;
    public $inputs = [];
    public $detail_ajuan = [];
    public $detail_produk, $detail_harga, $detail_qty, $detail_jumlah;

    public function mount()
    {
        $this->products = Invest_product::where('id_mitra', Auth::user()->id_mitra)->get();
        $this->id_mitra = Auth::user()->id_mitra;
        $this->pengajuan_dana = Pengajuan_dana::where('id_mitra', $this->id_mitra)->get();
        $this->detail_ajuan = [];
        $this->inputs = [
            ['produk_name' => '', 'price' => '', 'qty' => '']
        ];
    }

    public function render()
    {
        return view('livewire.investasi.mitra.pengajuan-dana', [
            'pengajuan_dana' => Pengajuan_dana::where('id_mitra', $this->id_mitra)->get()
        ]);
        
    }

    public function pengajuan()
    {
        
        $total = 0;
        foreach ($this->inputs as $item){
            $total = $total + $item['price'] * $item['qty'];
        }
        $pengajuan = Pengajuan_dana::create([
            'id_mitra' => $this->id_mitra,
            'judul' => $this->judul,
            'deskripsi' => $this->desc,
            'kode_produk' => $this->product,
            'status' => 1,
            'total' => $total
        ]);
        // 0 = ditolak
        // 1 = diproses
        // 2 = sukses
        foreach ($this->inputs as $item){
            $jumlah = 0;
            $jumlah = $item['price'] * $item['qty'];
            Rincian_pengajuan::create([
                'pengajuan_dana_id' => $pengajuan->id,
                'produk' => $item['produk_name'],
                'harga' => $item['price'],
                'qty' => $item['qty'],
                'jumlah' => $jumlah
            ]);
        }
        $this->reset(['judul', 'desc','inputs']);
        $this->inputs = [
            ['produk_name' => '', 'price' => '', 'qty' => '']
        ];

        session()->flash('success', 'Pengajuan berhasil ditambahkan!');
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

    public function detail()
    {
        $this->dispatchBrowserEvent('openDetailModal');
        dd($this->dispatchBrowserEvent('openDetailModal'));
        // $this->detail_ajuan = Rincian_pengajuan::where('id_pengajuan', $id)->get();
        
        // foreach($this->detail_ajuan as $item){
        //     dd($item->produk);
        // }
    }
}
