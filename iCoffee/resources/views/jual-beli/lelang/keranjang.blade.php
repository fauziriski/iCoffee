@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Kerajang')
@section('sidebar')
@endsection
@section('content')

    <form action="/lelang/checkout-barang" method="POST">
        @csrf
        <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Awal</th>
                                        <th>Jumlah</th>
                                        <th>Tawaran Anda</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjang as $data)
                                        <tr class="text-center">
                                            <td class="product-remove"><input type="radio" id="id_produk{{ $data->id }}"
                                                    name="id" class="checkbox-keranjang" value="{{ $data->id }}" required>
                                            </td>
                                            <td class="image-prod">
                                                <img class="img"
                                                    src="{{ asset('Uploads/Lelang/' . $data->auction_product->kode_lelang . '/' . $data->auction_product->gambar) }}"
                                                    alt="">
                                            </td>
                                            <td class="product-name">
                                                <h3>{{ $data->auction_product->nama_produk }}</h3>
                                                <p>{{ $data->pelelang->name }}</p>
                                            </td>
                                            <td class="price">Rp
                                                {{ number_format($data->auction_product->harga_awal, 0, ',', '.') }}
                                            </td>
                                            <input type="hidden" id="harga" name="harga"
                                                value="{{ $data->auction_product->harga_awal }}" readonly>
                                            <td class="quantity">
                                                <form method="post" class="form-user">
                                                    <input type="hidden" id="id_qty" value="{{ $data->id }}">
                                                    <div class="input-group mb-3">
                                                        <input type="text" id="{{ $data->id }}" name="quantity"
                                                            class="form-control input-number" required
                                                            value="{{ $data->auction_product->stok }} Kg" min="1" max="100"
                                                            readonly>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="price" name="total" for="harga jumlah">Rp
                                                {{ number_format($data->jumlah_penawaran, 0, ',', '.') }}
                                            </td>
                                            <input type="hidden" id="total{{ $data->id }}" value="Rp{{ number_format($data->jumlah_penawaran, 0, ',', '.') }}">
                                            <td class="product-remove">
                                                <a href="#">
                                                    <span class="oi oi-trash"></span>
                                                </a>
                                            </td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <p class="d-flex total-price">
                                <span id="sub_total_info">Sub Total ({{ $carttotal }}) Produk</span>
                                <span id="sub_total">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </p>
                        </div>
                        {{-- <p><a href="/jual-beli/checkout"
                                class="btn btn-primary py-2 px-5">Checkout</a></p> --}}
                        <p class="text-right">
                            <input type="submit" class="btn btn-primary py-2 px-5" value="Checkout">
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </form>



    {{-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    --}}


@endsection
@section('js')

    @foreach ($keranjang as $data)


        <script>
            $(document).ready(function() {
                var u = 0;
                var subTotalInfo = 0;
                var quantitiy = 0;
                $('.quantity-right-plus').click(function(e) {

                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#{!!  json_encode($data->id) !!}').val());

                    // If is not undefined

                    $('#{!!  json_encode($data->id) !!}').val(quantity + 1);

                    var data = $('.form-user').serialize();

                    $.ajax({
                        type: 'POST',
                        url: "/jual-beli/update-keranjang",
                        data: data
                        // success: function() {
                        //   $('.tampildata').load("tampil.php");
                        // }
                    });

                });

                $('.quantity-left-minus').click(function(e) {
                    // Stop acting like a button
                    e.preventDefault();
                    // Get the field name
                    var quantity = parseInt($('#quantity').val());

                    // If is not undefined

                    // Increment
                    if (quantity > 0) {
                        $('#quantity').val(quantity - 1);
                    }
                });

                $('.checkbox-keranjang').on('click', function() {
                    var u = 0;
                    var subTotalInfo = 0;
                    var y = $(this).val();

                    if (document.getElementById("id_produk" + y).checked == false) {

                        var x = $('#total' + y).val();
                        var removedot = x.split(".").join("");
                        var data = removedot.replace('Rp', '');

                        var sumSubtotal = parseInt(u) - parseInt(data);
                        u = sumSubtotal

                        subTotalInfo = subTotalInfo - 1

                        $('#sub_total').replaceWith('<span id="sub_total">Rp ' + u
                            .toLocaleString("id-ID") + ' </span>');
                        $('#sub_total_info').replaceWith('<span id="sub_total_info">Sub Total (' +
                            subTotalInfo + ') Produk </span>');

                    }

                    if (document.getElementById("id_produk" + y).checked == true) {
                        var x = $('#total' + y).val();
                        var removedot = x.split(".").join("");
                        var data = removedot.replace('Rp', '');

                        var sumSubtotal = parseInt(u) + parseInt(data);
                        u = sumSubtotal
                        subTotalInfo = subTotalInfo + 1

                        $('#sub_total').replaceWith('<span id="sub_total">Rp ' + u
                            .toLocaleString("id-ID") + ' </span>');
                        $('#sub_total_info').replaceWith('<span id="sub_total_info">Sub Total (' +
                            subTotalInfo + ') Produk </span>');

                    }



                });

            });

        </script>
    @endforeach

@stop
