@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
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

                            {{ $alamat_penjual->addresses->nama }}<br>
                            {{ $alamat_penjual->addresses->address }},
                            {{ $alamat_penjual->addresses->kecamatan }},
                            {{ $alamat_penjual->addresses->city->nama }},
                            {{ $alamat_penjual->addresses->province->nama }},
                            {{ $alamat_penjual->addresses->kode_pos }}
                        </address>
                    </div>
                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Penerima :</strong><br>
                            {{ $order->addresses->nama }}<br>
                            {{ $order->addresses->address }},
                            {{ $order->addresses->kecamatan }},
                            {{ $order->addresses->city->nama }},
                            {{ $order->addresses->province->nama }},
                            {{ $order->addresses->kode_pos }}
                        </address>
                    </div>

                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Metode Pembayaran :</strong><br>
                            {{ $bank_information->bank_name }} {{ $bank_information->no_rekening }}<br>
                        </address>
                        <address>
                            <strong>Pesan untuk penjual :</strong>
                            {{ $order->pesan }}<br>
                        </address>
                        @if ($order->status == 5 || 6 || 7 || 10 || 11)
                            <address>
                                <strong>No Resi :</strong><br>
                                <p class="text-uppercase">
                                    {{ $kurir[1] }} {{ $cek_resi->invoice }}<br>
                                </p>
                            </address>
                        @else
                            <address class="text-uppercase">
                                <strong>No Resi :</strong><br>
                                <p class="text-uppercase">
                                    {{ $kurir[1] }}<br>
                                </p>
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
                                        <td class="text-center"><strong>Harga</strong></td>
                                        <td class="text-center"><strong>Jumlah</strong></td>
                                        <td class="text-center"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderdetails as $data)
                                        <tr>
                                            <td>{{ $data->nama_produk }}</td>
                                            <td class="text-center">Rp {{ number_format($data->harga) }}</td>
                                            <td class="text-center">{{ $data->jumlah }}</td>
                                            <td class="text-right">Rp {{ number_format($data->total) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">Rp {{ number_format($order->total_bayar) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Biaya Pengiriman</strong></td>
                                        <td class="no-line text-right">Rp {{ number_format($kurir[0]) }}</td>
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
                                {{ number_format($jumlah_seluruh) }}</strong></h3>
                    </div>
                    <div class="panel-body mt-3">
                        @if ($order->status == 3)
                            <form action="/jual-beli/pesanan/terima" method="post">
                                @csrf
                                <input type="hidden" name="id" required value="{{ $order->id }}">
                                <input type="hidden" name="invoice" required value="{{ $order->invoice }}">
                                <input type="hidden" name="jumlah_seluruh" required value="{{ $jumlah_seluruh }}">
                                <div class="col-md-4 float-right">
                                    <p class="row">
                                        <input type="submit" style="border-radius: 10px; margin: auto; padding: 16px;"
                                            class="btn btn-secondary col-md-5 col-5" name="submit" value="Tolak">
                                        <input type="submit" style="border-radius: 10px; margin: auto; padding: 16px;"
                                            class="btn btn-primary col-md-5 col-5" name="submit" value="Terima">
                                    </p>
                                </div>
                            </form>
                        @endif

                        @if ($order->status == 4)
                            <form action="/jual-beli/pesanan/inputresi" method="post">
                                @csrf
                                <input type="hidden" name="id" required value="{{ $order->id }}">
                                <input type="hidden" name="invoice" required value="{{ $order->invoice }}">

                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-2 mr-2 mt-2">
                                                <label for="input_resi">Masukan Resi</label>
                                            </div>
                                            <div class="col-md-6 mr-2 mt-2">
                                                <input type="text" class="form-control" name="input_resi" required>
                                                <span class="text-danger">{{ $errors->first('input_resi') }}</span>
                                            </div>
                                            <div class="col-md-2 mt-2 text-center">
                                                <input type="submit"
                                                    style="border-radius: 10px; margin: auto; padding: 14px;"
                                                    class="btn btn-primary px-5" name="submit" value="Input">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>
                            @elseif($order->status == 5 || $order->status == 6)
                                <div class="text-center col-md-8 offset-md-7 col-12">
                                    <p class="row justify-content-center">

                                        <button id="willbill" name="willbill"
                                            style="border-radius: 10px; margin: auto; padding: 16px;"
                                            value="{{ $order->id }}" type="button" class="btn btn-primary ml-3 mr-3 mt-2 py-3 px-5"
                                            data-toggle="modal" data-target="#exampleModalCenter1">
                                            Lacak Paket
                                        </button>
                                    </p>
                                </div>


                            @elseif($order->status == 7 || $order->status == 10 || $order->status == 11)
                                <div class="text-center col-md-7 offset-md-6 col-12">
                                    <p class="row justify-content-center">

                                        <button id="willbill" name="willbill"
                                            style="border-radius: 10px; margin: auto; padding: 16px;"
                                            value="{{ $order->id }}" type="button" class="btn btn-primary ml-3 mr-3 mt-2 py-3 px-5"
                                            data-toggle="modal" data-target="#exampleModalCenter1">
                                            Lacak Paket
                                        </button>

                                        
                                        <button id="see_coplain" name="see_coplain"
                                            style="border-radius: 10px; padding: 16px;"
                                            value="{{ $order->id }}" type="button" class="btn btn-primary ml-2 mr-2 mt-2 py-3 px-5"
                                            data-toggle="modal" data-target="#see_complain_modal">
                                            Lihat Komplain
                                        </button>
                                    </p>
                                </div>
                        @endif
                        
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
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

                                <div class="modal fade" id="see_complain_modal" tabindex="-1" role="dialog"
                                aria-labelledby="see_complain_modal_title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Lihat Komplain</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-md-3" style="font-size: 17px;">
                                                    Invoice :
                                                </dt>
                                                <dd class="col-md-9" style="font-size: 17px;">
                                                    <p id="complain_code"></p>
                                                </dd>
                                                <dt class="col-md-3" style="font-size: 17px;">
                                                    Komplain :
                                                </dt>
                                                <dd class="col-md-9" style="font-size: 17px;">
                                                    <p id="complain_content"></p>
                                                </dd>
                                                <dt class="col-md-3"  style="font-size: 17px;">
                                                    Bukti :
                                                </dt>
                                                <div class="col-md-9">
                                                    <div id="image">
                                                        <a name="images-modal" href="#imagemodal" data-toggle="modal" data-target="#imagemodal">
                                                            <img src="" alt="" srcset="" id="complain_image">
                                                        </a>
                                                    </div>
                                                    <div>   
                                                        <div class="modal fade " id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">
                                                                    <img class="modal-img" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <dt class="col-md-3"  style="font-size: 17px;">
                                                    Video Unboxing :
                                                </dt>
                                                <dd class="col-md-6 ml-0" style="font-size: 17px;">
                                                    <p id="complain_video"></p>
                                                </dd>
                                            </dl>
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('button[name="willbill"]').on('click', function() {
            var orderID = $(this).val();
            console.log(orderID);
            if (orderID) {
                $.ajax({
                    url: '/jual-beli/waybill/trasaction/' + encodeURI(orderID),
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
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                            errorMessage('Gagal Melacak Paket');
                    }
                });
            } else {
                $('#waybilltrackul').empty();
            }
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('button[name="see_coplain"]').on('click', function() {
            var orderID = $(this).val();
            console.log(orderID);
            if (orderID) {
                $.ajax({
                    url : '/jual-beli/komplain/' + encodeURI(orderID),
                    type : "GET",
                    dataType : "JSON",
                    success : function(data) {
                        $('#complain_content').empty();
                        $('#complain_code').empty();
                        $('#complain_image').empty();
                        $('#complain_video').empty();

                        $('#complain_code').replaceWith("<p id='complain_code'>"+data[0].invoice+"</p>");
                        $('#complain_content').replaceWith("<p id='complain_content'>"+data[0].keterangan+"</p>");
                        $('#complain_image').replaceWith(`<img id='complain_image' height="100px" width="100px" src="{{asset('Uploads/Komplain/JualBeli/${data[0].invoice}/${data[0].gambar}')}}" alt='' srcset=''>`);
                        $('#complain_video').replaceWith(`<p id='complain_video'><a href="${data[0].video_unboxing}">Klik Disini</a></p>`);
                    }
                })
                
            } else {
                
            }
        });
    });
</script>

<script>

$(function(){
    $('a[name="images-modal"]').on("click",function(){
        var data = document.getElementById("complain_image").src;
        // // var src = $(this).attr("src");
        // console.log(data);
        $(".modal-img").prop("src",data);
    })
})

</script>


@endsection
