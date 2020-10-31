@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Invoice Penjual')
@section('sidebar')
@endsection
@section('content')


    <div class="container mt-5">
        <div class="invoice-title">
            <h3>Invoice</h3>
            <h3 class="pull-right">Order # {{ $order->invoice }}</h3>
        </div>

        <div class="row mb-2">
            <div class="col-md-12">
                <hr>
                <div class="row">
                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Pengirim :</strong><br>
                            {{ $order->addresses_penjual->nama }}<br>
                            {{ $order->addresses_penjual->address }},
                            Kecamatan {{ $order->addresses_penjual->subdistrict->name }},
                            {{ $order->addresses_penjual->city->type }} {{ $order->addresses_penjual->city->nama }},
                            Provinsi {{ $order->addresses_penjual->province->nama }},
                            <br>
                            Kode Pos : {{ $order->addresses_penjual->kode_pos }}
                        </address>
                    </div>
                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Penerima :</strong><br>
                            {{ $order->addresses_pembeli->nama }}<br>
                            {{ $order->addresses_pembeli->address }},
                            Kecamatan {{ $order->addresses_pembeli->subdistrict->name }},
                            {{ $order->addresses_pembeli->city->type }} {{ $order->addresses_pembeli->city->nama }},
                            Provinsi {{ $order->addresses_pembeli->province->nama }},
                            <br>
                            Kode Pos : {{ $order->addresses_pembeli->kode_pos }}
                        </address>
                    </div>

                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Metode Pembayaran :</strong><br>
                            {{ $bank_information->bank_name }} {{ $bank_information->no_rekening }}<br>

                        </address>
                        @if ($order->status == 5 || 6 || 7 || 10 || 11)
                            <address>
                                <strong>No Resi :</strong><br>
                                {{ $kurir[1] }} {{ $cek_resi->invoice }}<br>
                            </address>
                        @else
                            <address>
                                <strong>No Resi :</strong><br>
                                {{ $kurir[1] }}<br>
                            </address>
                        @endif
                    </div>
                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Tanggal Order :</strong><br>
                            {{ $order->created_at }}<br>
                            <strong>Status :</strong><br>
                            @if ($order->status == 3)
                                <div class="alert alert-info" role="alert">
                                    Di Serahkan ke Penjual
                                </div>
                            @elseif( $order->status == 4)
                                <div class="alert alert-info" role="alert">
                                    Menerima Pesanan
                                </div>
                            @elseif( $order->status == 5)
                                <div class="alert alert-info" role="alert">
                                    Barang Dikirim
                                </div>
                            @elseif( $order->status == 6)
                                <div class="alert alert-success" role="alert">
                                    Selesai
                                </div>
                            @elseif( $order->status == 7)
                                <div class="alert alert-primary" role="alert">
                                    Komplin
                                </div>

                            @elseif( $order->status == 10)
                                <div class="alert alert-info" role="alert">
                                    Komplain dibatalkan
                                </div>

                            @elseif( $order->status == 11)
                                <div class="alert alert-info" role="alert">
                                    Komplain diterima
                                </div>

                            @elseif( $order->status == 0)
                                <div class="alert alert-info" role="alert">
                                    Menolak Pesanan
                                </div>
                            @endif

                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="card-header"><strong>Detail Order</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive col-sm-12">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td class="text-center"><strong>Nama Produk</strong></td>
                                        <td class="text-center"><strong>Harga Awal</strong></td>
                                        <td class="text-center"><strong>Jumlah</strong></td>
                                        <td class="text-center"><strong>Tawaran Anda</strong></td>
                                    </tr>
                                </thead>
                                <tbody>


                                    <tr>
                                        <td>{{ $order->auction_products->nama_produk }}</td>
                                        <td class="text-center">Rp {{ number_format($order->tawaran_awal, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ $order->jumlah }}</td>
                                        <td class="text-right">Rp {{ number_format($order->sub_total, 0, ',', '.') }}</td>
                                    </tr>


                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">Rp
                                            {{ number_format($order->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
                                        <td class="no-line text-right">Rp {{ number_format($kurir[0], 0, ',', '.') }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row mb-5">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="card-header"><strong>Total</strong><strong class="float-right">Rp
                                {{ number_format($order->total_bayar, 0, ',', '.') }}</strong></h3>
                    </div>
                    <div class="panel-body mt-3 row">
                        @if ($order->status == 3)
                            <form action="/lelang/pesanan/terima" method="post">
                                @csrf
                                <input type="hidden" name="id" required value="{{ $order->id }}">
                                <input type="hidden" name="invoice" required value="{{ $order->invoice }}">
                                <input type="hidden" name="jumlah_seluruh" required value="{{ $order->total_bayar }}">
                                <p><input type="submit" style="border-radius: 10px;" class="btn btn-secondary  py-3 px-5"
                                        name="submit" value="Tolak">
                                    <input type="submit" class="btn btn-primary py-3 px-5" name="submit" value="Terima">
                                </p>
                            </form>

                        @elseif ( $order->status == 4)
                            <form action="/lelang/pesanan/inputresi" method="post">
                                @csrf
                                <input type="hidden" name="id" required value="{{ $order->id }}">
                                <input type="hidden" name="invoice" required value="{{ $order->invoice }}">

                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="input_resi">Masukan Resi</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="input_resi" required>
                                        <span class="text-danger">{{ $errors->first('input_resi') }}</span>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <input type="submit" class="btn btn-primary px-5 py-2" name="submit" value="Input">
                                    </div>

                                </div>


                            </form>

                        @elseif($order->status == 5 || $order->status == 6 || $order->status == 7 || $order->status ==
                            10 || $order->status == 11)

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Lacak Paket</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group list-group-flush" id="waybilltrackul">
                                                <li class="list-group-item" id="waybilltrackli">

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center offset-md-9">
                                <button id="willbill" class="btn btn-primary text-center" name="willbill"
                                    style="border-radius: 10px; margin: auto; padding: 16px;" value="{{ $order->id }}"
                                    type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                    Lacak Paket
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('button[name="willbill"]').on('click', function() {
                var orderID = $(this).val();
                if (orderID) {
                    $.ajax({
                        url: '/lelang/waybill/trasaction/' + encodeURI(orderID),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#waybilltrackul').empty();
                            $.each(data, function(key, value) {
                                count = value.result.manifest.length;
                                for (i = count - 1; i >= 0; i--) {
                                    $('#waybilltrackul').append(
                                        '<li class="list-group-item" id="waybilltrackli">' +
                                        value.result.manifest[i].manifest_date +
                                        ' - [' + value.result.manifest[i]
                                        .city_name + '] ' + value.result.manifest[i]
                                        .manifest_description + '</li>');
                                }

                            });
                        }
                    });
                } else {
                    $('#waybilltrackul').empty();
                }
            });
        });

    </script>


    <style>
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }

        .table>tbody>tr>.no-line {
            border-top: none;
        }

        .table>thead>tr>.no-line {
            border-bottom: none;
        }

        .table>tbody>tr>.thick-line {
            border-top: 2px solid;
        }

    </style>




@endsection
