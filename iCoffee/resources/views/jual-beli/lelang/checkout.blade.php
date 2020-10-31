@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Checkout')
@section('sidebar')
@endsection
@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col ftco-animate">
                    <form action="/lelang/pesanbarang" method="post">
                        @csrf
                        <h3 class="mb-4 billing-heading">Checkout</h3>
                        <div class="col-md-12 ">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Alamat Pengiriman</h3>
                                <div class="form-group">
                                    <div class="row align-items-end">
                                        <div class="col-xl-6 ftco-animate">
                                            <p class="col-lg-12">{{ $alamat_pembeli->nama }}</p>
                                            <p class="col-lg-12">
                                                {{ $alamat_pembeli->address }} - Provinsi
                                                {{ $alamat_pembeli->province->nama }}, {{ $alamat_pembeli->city->type }}
                                                {{ $alamat_pembeli->city->nama }}, Kecamatan
                                                {{ $alamat_pembeli->subdistrict->name }}, Kode Pos
                                                +{{ $alamat_pembeli->kode_pos }}
                                            </p>
                                        </div>
                                        <input type="hidden" name="id_alamat_penjual" value="{{ $alamat_penjual->id }}">
                                        <input type="hidden" name="id_alamat_pembeli" value="{{ $alamat_pembeli->id }}">
                                        <input type="hidden" name="nama_alamat" value="{{ $alamat_pembeli->nama }}">
                                        <div class="col">
                                            <p><a href="/profil/edit"
                                                    class="btn btn-primary py-3 px-4 col-lg-7 align-self-end">Ganti
                                                    Alamat</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="col-md-12">
                            <h3>{{ $checkout->pelelang->name }}</h3>
                            <input type="hidden" name="id_toko" value="{{ $checkout->pelelang->id }}">

                            <div class="cart-detail p-3 p-md-4">
                                <div class="row">
                                    <div class="col-md-12 ftco-animate">
                                        <div class="table-responsive col-sm-12">
                                            <table class="table table-condensed">
                                                <thead class="">
                                                    <tr class="text-center">

                                                        <th>&nbsp;</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga Awal</th>
                                                        <th>Jumlah</th>
                                                        <th>Penawaran Anda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <tr class="text-center">
                                                        <td class="image-prod">
                                                            <div class="img"
                                                                style="background-image: url({{ asset('Uploads/Lelang/' . $checkout->auction_product->kode_lelang . '/' . $checkout->auction_product->gambar) }});">
                                                            </div>
                                                        </td>
                                                        <td class="product-name">
                                                            <h3>{{ $checkout->auction_product->nama_produk }}</h3>
                                                        </td>
                                                        <td class="price">Rp
                                                            {{ number_format($checkout->auction_product->harga_awal, 0, ',', '.') }}
                                                        </td>
                                                        <td class="total">{{ $checkout->auction_product->stok }} Kg</td>
                                                        <td class="total">Rp
                                                            {{ number_format($checkout->jumlah_penawaran, 0, ',', '.') }}
                                                        </td>
                                                    </tr><!-- END TR-->
                                                    <input type="hidden" name="id_keranjang" value="{{ $checkout->id }}">
                                                    <input type="hidden" name="id_produk"
                                                        value="{{ $checkout->id_produk_lelang }}">
                                                    <input type="hidden" name="id_penjual"
                                                        value="{{ $checkout->id_pelelang }}">
                                                    <input type="hidden" name="harga_awal"
                                                        value="{{ $checkout->auction_product->harga_awal }}">
                                                    <input type="hidden" name="jumlah"
                                                        value="{{ $checkout->auction_product->stok }}">
                                                    <input type="hidden" name="nama_produk"
                                                        value="{{ $checkout->auction_product->nama_produk }}">
                                                    <input type="hidden" name="kode_lelang"
                                                        value="{{ $checkout->auction_product->kode_lelang }}">
                                                    <input type="hidden" name="gambar"
                                                        value="{{ $checkout->auction_product->gambar }}">
                                                    <input type="hidden" name="jumlah_penawaran"
                                                        value="{{ $checkout->jumlah_penawaran }}">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                                <div class="row align-items-end">
                                    <div class="col-md-6 p-2 p-md-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="pesan">Pesan untuk penjual (Opsional)</label>
                                                <textarea rows="5" type="text" name="pesan" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-1 p-md-3">
                                        <div class="row align-items-end">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="country">Pilih Kurir</label>
                                                    <div class="select-wrap">
                                                        <select name="kurir" id="kurir" class="kurir form-control"
                                                            onchange="myFunction()" required>
                                                            {{-- onchange="myFunction()"
                                                            --}}
                                                            <option selected disabled="disabled" value="">Pilih Kurir
                                                            </option>
                                                            @for ($k = 0; $k < count($costjne['rajaongkir']['results'][0]['costs']); $k++)
                                                                <option
                                                                    value="{{ $costjne['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'] }}: JNE: {{ $costjne['rajaongkir']['results'][0]['costs'][$k]['service'] }} ">
                                                                    JNE Rp
                                                                    {{ number_format($costjne['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'], 0, ',', '.') }}
                                                                    (
                                                                    {{ $costjne['rajaongkir']['results'][0]['costs'][$k]['service'] }}
                                                                    {{ $costjne['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['etd'] }}
                                                                    Hari )
                                                                </option>
                                                            @endfor

                                                            @for ($k = 0; $k < count($costtiki['rajaongkir']['results'][0]['costs']); $k++)
                                                                <option
                                                                    value="{{ $costtiki['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'] }}: TIKI: {{ $costtiki['rajaongkir']['results'][0]['costs'][$k]['service'] }}">
                                                                    TIKI Rp
                                                                    {{ number_format($costtiki['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'], 0, ',', '.') }}
                                                                    (
                                                                    {{ $costtiki['rajaongkir']['results'][0]['costs'][$k]['service'] }}
                                                                    {{ $costtiki['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['etd'] }}
                                                                    Hari )
                                                                </option>
                                                            @endfor

                                                            @for ($k = 0; $k < count($costjnt['rajaongkir']['results'][0]['costs']); $k++)
                                                                <option
                                                                    value="{{ $costjnt['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'] }}: JNT: {{ $costjnt['rajaongkir']['results'][0]['costs'][$k]['service'] }}">
                                                                    J&T Rp
                                                                    {{ number_format($costjnt['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'], 0, ',', '.') }}
                                                                    (
                                                                    {{ $costjnt['rajaongkir']['results'][0]['costs'][$k]['service'] }}
                                                                    {{ $costjnt['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['etd'] }}
                                                                    )
                                                                </option>
                                                            @endfor

                                                            @for ($k = 0; $k < count($costlion['rajaongkir']['results'][0]['costs']); $k++)
                                                                <option
                                                                    value="{{ $costlion['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'] }}: Lion: {{ $costlion['rajaongkir']['results'][0]['costs'][$k]['service'] }}">
                                                                    Lion Rp
                                                                    {{ number_format($costlion['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'], 0, ',', '.') }}
                                                                    (
                                                                    {{ $costlion['rajaongkir']['results'][0]['costs'][$k]['service'] }}
                                                                    {{ $costlion['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['etd'] }}
                                                                    )
                                                                </option>
                                                            @endfor

                                                            @for ($k = 0; $k < count($costninja['rajaongkir']['results'][0]['costs']); $k++)
                                                                <option
                                                                    value="{{ $costninja['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'] }}: Ninja: {{ $costninja['rajaongkir']['results'][0]['costs'][$k]['service'] }}">
                                                                    Ninja Rp
                                                                    {{ number_format($costninja['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['value'], 0, ',', '.') }}
                                                                    (
                                                                    {{ $costninja['rajaongkir']['results'][0]['costs'][$k]['service'] }}
                                                                    {{ $costninja['rajaongkir']['results'][0]['costs'][$k]['cost'][0]['etd'] }}
                                                                    )
                                                                </option>
                                                            @endfor

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 p-1 p-md-3">
                                                <label for="country">Subtotal</label>
                                                <div class="cart-detail">
                                                    <input type="hidden" name="total_bayar"
                                                        value="{{ $checkout->jumlah_penawaran }}">
                                                    <h6 class="text-center">Total Pembayaran Rp.
                                                        {{ number_format($checkout->jumlah_penawaran, 0, ',', '.') }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-end">
                                <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
                                    <div class="cart-total mb-3">
                                        <h3>Transfer Bank</h3>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="bank" class="mr-2" value="BCA"
                                                            required> Bank BCA</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="bank" class="mr-2" value="BNI"> Bank
                                                        BNI</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="bank" class="mr-2" value="Mandiri">
                                                        Bank Mandiri</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="bank" class="mr-2" value="BRI"> Bank
                                                        BRI</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-7 mt-5 cart-wrap ftco-animate">
                                    <div class="cart-total mb-3">
                                        <h3>Cart Totals</h3>
                                        <p class="d-flex">
                                            <span>Subtotal untuk Produk</span>
                                            <span>Rp {{ number_format($checkout->jumlah_penawaran, 0, ',', '.') }}</span>
                                        </p>
                                        <p class="d-flex">
                                            <span>Total Ongkos Kirim</span>
                                            <span id="demo"></span>
                                        </p>
                                        <hr>
                                        <p class="d-flex">
                                            <span>Total Pembayaran</span>
                                            <span id="total"></span>
                                        </p>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col text-center col-12 offset-md-8 mb-5">
                                            {{-- <p><a href="checkout.html"
                                                    class="btn btn-primary py-3 px-4">Buat Pesanan</a></p>
                                            --}}
                                            <p>
                                                <input type="submit" class="btn btn-primary py-3 px-4" value="Buat Pesanan">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> <!-- .section -->

@endsection

@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <script>
        function myFunction() {
            var x = document.getElementById("kurir").value;
            var a = parseInt(x)
            document.getElementById("demo").innerHTML = a;
            var y = {
                !!json_encode($checkout - > jumlah_penawaran) !!
            };
            var z = parseInt(x) + parseInt(y);
            document.getElementById("demo").innerHTML = "Rp " + a.toLocaleString("id-ID");
            document.getElementById("total").innerHTML = "Rp " + z.toLocaleString("id-ID");
        }

    </script>


@stop
