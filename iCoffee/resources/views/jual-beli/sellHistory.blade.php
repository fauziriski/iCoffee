@extends('jual-beli.layouts.app')
@section('title', 'Profle | Riwayat Pembelian')
@section('content')

                <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                    <h3 class="text-center">Riwayat Penjualan</h3>
                    @foreach ($transaksipenjual as $key => $value)
                    <div class="row mr-2 mt-2 ml-2 mb-2" style=" border: 1px solid #ee4d2c;border-radius: 10px">
                        
                        <div class="col-md-12 justify-content-center">
                            <div class="row mt-1 mb-0">
                                <div class="col-md-12 align-self-center">
                                    <center>
                                        <p class="font-weight-bold">{{ $value->created_at }}</p>
                                    </center>
                                </div>
                            </div>
                            <div class="row border mt-1 justify-content-around">
                                <div class="col-md-3 align-self-center">
                                    <p>Invoice ({{$value->invoice}})</p>
                                </div>
                                <div class="col-md-4 align-self-center">
                                    @if( $value->status == 3)
                                        <div class="alert alert-info" role="alert">
                                            Di Serahkan ke Penjual
                                        </div>
                                    @elseif( $value->status == 4)
                                        <div class="alert alert-info" role="alert">
                                            Menerima Pesanan
                                        </div>
                                    @elseif( $value->status == 5)
                                        <div class="alert alert-info" role="alert">
                                            Barang Dikirim
                                        </div>
                                    @elseif( $value->status == 6)
                                        <div class="alert alert-success" role="alert">
                                            Selesai
                                        </div>
                                    @elseif( $value->status == 7)
                                        <div class="alert alert-primary" role="alert">
                                            Komplin
                                        </div>
                                                            
                                    @elseif( $value->status == 10)
                                        <div class="alert alert-info" role="alert">
                                            Komplain dibatalkan
                                        </div>

                                    @elseif( $value->status == 11)
                                        <div class="alert alert-info" role="alert">
                                            Komplain diterima
                                        </div>

                                    @elseif( $value->status == 0)
                                        <div class="alert alert-info" role="alert">
                                            Menolak Pesanan
                                        </div>
                                        
						            @endif
                                </div>
                                <div class="col-md-3 align-self-center">
                                    <p>Total Harga Produk</p>
                                    <p class="font-weight-bold" style="color:  #ee4d2c">Rp {{ number_format($value->total_bayar,0,",",".") }}</p>
                                </div>
                                <div class="col-md-2 align-self-center">
                                    <p>Total Belanja</p>
                                    <p class="font-weight-bold" style="color:  #ee4d2c">Rp {{ number_format($total_bayar[$key],0,",",".") }}</p>
                                </div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="col-md-12 text-center ">
                                    <a href="/jual-beli/invoice_penjual/{{ $value->invoice }}"><span class="oi oi-eye"></span>&nbsp; Detail Pesanan </a>
                                </div>
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