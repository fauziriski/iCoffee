@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Invoice')
@section('sidebar')
@endsection
@section('content')


    <div class="container mt-5">
        <div class="invoice-title">
            <h3>Invoice</h3>
            <h3 class="pull-right">Order #{{ $order->invoice }}</h3>
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
                            {{ $order->addresses_pembeli->city->type }} {{ $order->addresses_penjual->city->nama }},
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

                            <address>
                                <strong>No Resi :</strong><br>
                                <p class="text-uppercase">
                                    {{ $kurir[1] }}<br>
                                </p>
                            </address>


                        @endif
                    </div>
                    <div class="col-md-3 col-6">
                        <address>
                            <strong>Status :</strong><br>
                            @if ($order->status == 1)
                                <div class="alert alert-warning" role="alert">
                                    Belum Dibayar
                                </div>
                            @elseif( $order->status == 2)
                                <div class="alert alert-info" role="alert">
                                    Pembayaran Ditolak
                                </div>

                            @elseif( $order->status == 3)
                                <div class="alert alert-info" role="alert">
                                    Di Serahkan ke Penjual
                                </div>
                            @elseif( $order->status == 4)
                                <div class="alert alert-info" role="alert">
                                    Penjual Menerima dan Barang di Proses
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
                                <div class="alert alert-info" role="alert">
                                    komplain
                                </div>
                            @elseif( $order->status == 8)
                                <div class="alert alert-info" role="alert">
                                    Pembayaran Sedang di Proses
                                </div>
                            @elseif( $order->status == 9)
                                <div class="alert alert-danger" role="alert">
                                    Pembelian dibatalkan
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
                                <div class="alert alert-danger" role="alert">
                                    Penjual Menolak Pesanan
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
                                        <td class="text-center">{{ $order->jumlah }} Kg</td>
                                        <td class="text-right">Rp {{ number_format($order->sub_total, 0, ',', '.') }}</td>
                                    </tr>


                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">Rp
                                            {{ number_format($order->sub_total, 0, ',', '.') }}
                                        </td>
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
                    <div class="panel-body mt-3">
                        @if ($order->status == 5)
                            <form action="/lelang/pesanan/selesai" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" required value="{{ $order->id }}">
                                <input type="hidden" name="invoice" required value="{{ $order->invoice }}">
                                <input type="hidden" name="jumlah_seluruh" required value="{{ $order->total_bayar }}">
                                <p class="row justify-content-end ">
                                    <button id="willbill" name="willbill" style="border-radius: 10px; margin: auto; padding: 16px;"
                                        value="{{ $order->id }}" type="button" class="btn btn-primary col-md-3 mr-1 ml-1 mt-1"
                                        data-toggle="modal" data-target="#exampleModalCenter1">
                                        Lacak Paket
                                    </button>
                                    <input type="submit" style="border-radius: 10px"
                                        class="btn btn-secondary mr-1 ml-1 py-3 px-5 mt-1 col-md-3" name="submit"
                                        value="Komplain">
                                    <input type="submit" class="btn btn-primary py-3 px-5 mt-1 mr-1 ml-1 col-md-3"
                                        name="submit" value="Diterima">
                                </p>
                            </form>
                        @elseif($order->status == 1)
                            <p class="row">
                            <div class="col-md-9 offset-md-6 text-center">
                                <a href="/lelang/konfirmasi" name="konfirmasi_pembayaran" type="button"
                                    class="btn btn-primary px-3 py-3">
                                    Konfirmasi Pembayaran
                                </a>
                            </div>
                            </p>

                            </form>

                        @elseif( $order->status == 6)
                            <p class="row justify-content-center">
                            <div class="col-md-5 offset-md-7">
                                <div class="row">
                                    <button id="willbill" name="willbill"
                                        style="border-radius: 10px; margin: auto; padding: 16px;" value="{{ $order->id }}"
                                        type="button" class="btn btn-primary col-12 col-md-4 mr-1 mt-1" data-toggle="modal"
                                        data-target="#exampleModalCenter1">
                                        Lacak Paket
                                    </button>
                                    {{-- <input type="submit" class="btn col-12 col-md-4 btn-primary mr-1 mt-1 py-3 px-5"
                                        data-toggle="modal" data-target="#exampleModalCenter" name="submit" value="Rating"> --}}
                                </div>
                            </div>
                            </p>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Rating</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <form action="" id="rating_form" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id_lelang_rating" id="id_order_rating"
                                                        required value="{{ $order->id }}">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="star-rating text-center">

                                                                <span class="fa fa-star-o" data-rating="1"></span>
                                                                <span class="fa fa-star-o" data-rating="2"></span>
                                                                <span class="fa fa-star-o" data-rating="3"></span>
                                                                <span class="fa fa-star-o" data-rating="4"></span>
                                                                <span class="fa fa-star-o" data-rating="5"></span>
                                                                <input type="hidden" name="whatever1" class="rating-value"
                                                                    value="{{ $penilaian }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" id="rating" name="rating" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($order->status == 7 || $order->status == 10 || $order->status == 11)
                        <div class="row justify-content-center">
                            <div class="col-md-6 offset-md-8 text-center">
                                <button id="willbill" name="willbill" style="border-radius: 10px; margin: auto; padding: 16px;"
                                    value="{{ $order->id }}" type="button" class="btn btn-primary mr-4 ml-4 mt-1"
                                    data-toggle="modal" data-target="#exampleModalCenter1">
                                    Lacak Paket
                                </button>

                                <button id="see_coplain" name="see_coplain"
                                    style="border-radius: 10px; padding: 16px;"
                                    value="{{ $order->id }}" type="button" style="border-radius: 10px; margin: auto; padding: 16px;"
                                    class="btn btn-primary mr-1 ml-1 mt-1"
                                    data-toggle="modal" data-target="#see_complain_modal">
                                    Lihat Komplain
                                </button>
                            </div>
                        </div>

                        @endif

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

        .star-rating {
            line-height: 40px;
            font-size: 2.25em;
        }

        .star-rating .fa-star {
            color: yellow;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <script>
        var $star_rating = $('.star-rating .fa');

        var SetRatingStar = function() {
            return $star_rating.each(function() {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data(
                        'rating'))) {
                    return $(this).removeClass('fa-star-o').addClass('fa-star');
                } else {
                    return $(this).removeClass('fa-star').addClass('fa-star-o');
                }
            });
        };

        $star_rating.on('click', function() {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });

        SetRatingStar();
        $(document).ready(function() {

        });

    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#rating').on('click', function() {
                var data = $('#rating_form').serialize();
                $.ajax({
                    url: "/lelang/rating",
                    method: "POST",
                    data: data,
                    success: function(data) {
                        swal(
                            'Berhasil',
                            'Data Berhasil di Tambahkan',
                            'success'
                        );
                        location.reload();

                    }
                });

            });
        });

    </script> --}}

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
                            console.log(data);
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
                        url : '/lelang/komplain/' + encodeURI(orderID),
                        type : "GET",
                        dataType : "JSON",
                        success : function(data) {
                            $('#complain_content').empty();
                            $('#complain_code').empty();
                            $('#complain_image').empty();

                            $('#complain_code').replaceWith("<p id='complain_code'>"+data.invoice+"</p>");
                            $('#complain_content').replaceWith("<p id='complain_content'>"+data.keterangan+"</p>");
                            $('#complain_image').replaceWith(`<img id='complain_image' height="100px" width="100px" src="{{asset('Uploads/Komplain/Lelang/${data.invoice}/${data.gambar}')}}" alt='' srcset=''>`);
                            
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
