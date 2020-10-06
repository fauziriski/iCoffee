@extends('jual-beli.layouts.app')
@section('title', 'Profle | Produk Saya')
@section('content')

                    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                        <div class="row justify-content-center mt-2">
                            <div class="col-md-12">
                                <h3 class="text-center">
                                    Produk Saya
                                </h3>
                            </div>
                        </div>
                        @foreach ($produk as $item)
                        <div class="row ml-1 mr-1 mt-1 justify-content-center" style="padding: 10px;border: 1px solid #ee4d2c;border-radius: 10px">
                            <div class="col-md-2 ml-0 mr-0 text-center  align-self-center">
                                <img class="img-fluid rounded" src="{{ url('/Uploads/Produk/'.$item->kode_produk.'/'.$item->gambar) }}" width="70%" height="70%">
                            </div>

                            <div class="col-md-4 mt-1 align-self-center">
                                <div class="row mb-0">
                                    <p class="font-weight-bold text-left">
                                        Nama : {{ $item->nama_produk }}
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="font-weight-bold">
                                        Kategori : Kopi {{ $item->category->kategori }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-2 align-self-center">
                                <div class="row mb-0">
                                    <p class="font-weight-bold text-left">
                                        Harga : Rp {{ $item->harga }}
                                    </p>
                                </div>
                                <div class="row">
                                    <p class="font-weight-bold">
                                        Stok : {{ $item->stok }} Kg
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-2 mt-3 align-self-center">
                                @if ($item->status == 0)
                                <div class="text-center alert alert-warning" role="alert">
                                    Non-Aktif
                                </div>
                                @else
                                <div class="text-center alert alert-success" role="alert">
                                    Aktif
                                </div>
                                @endif
                            </div>

                            <div class="col-md-2 align-self-center">
                                <div class="row justify-content-center">
                                    <a class="justify-content-center" href="/jual-beli/produk/{{ $item->id }}">
                                        <span class="oi oi-eye align-middle"></span>&nbsp; Lihat Produk 
                                    </a>
                                </div>
                                <div class="row justify-content-center">
                                    <a href="/jual-beli/produk/edit/{{ $item->id }}" name="edit_produk">
                                        <span class="oi oi-pencil align-middle"></span>&nbsp; Edit Produk 
                                    </a>
                                </div>
                                
                            </div>
                        </div>     
                        @endforeach
                        
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    
@endsection