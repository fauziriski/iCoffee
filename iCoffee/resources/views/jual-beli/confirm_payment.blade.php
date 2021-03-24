@extends('jual-beli.layouts.app')
@section('title', 'Konfirmasi Pembayaran Pembelian')
@section('content')

    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
        <h3 class="text-center mt-2">Konfirmasi Pembayaran Pembelian</h3>
        <form action="/jual-beli/konfirmasi/pembayaran" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" readonly value="{{ Auth::user()->email }}"
                                    required>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_bank_pengirim">Nama Bank Pengirim</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="" placeholder="" name="nama_bank_pengirim"
                                        required>
                                </div>
                                <span class="text-danger">{{ $errors->first('nama_bank_pengirim') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_rekening_pengirim">No Rekening Pengirim</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="" placeholder="" name="no_rekening_pengirim"
                                        required>
                                </div>
                                <span class="text-danger">{{ $errors->first('no_rekening_pengirim') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_telp">Nomor Telepon</label>
                                <div class="input-group">
                                    <input type="tel" class="form-control" id="" placeholder="" name="no_telp" required>
                                </div>
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_pemilik_pengirim">Nama Pemilik Rekening</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="" placeholder=""
                                        name="nama_pemilik_pengirim" required>
                                </div>
                                <span class="text-danger">{{ $errors->first('nama_pemilik_pengirim') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_transfer">Jumlah Transfer</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;"
                                            class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control" id="jumlah_transfer" name="jumlah_transfer"
                                        required>
                                </div>
                                <span class="text-danger">{{ $errors->first('jumlah_transfer') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="invoice">Invoice</label>
                                <div class="input-group">
                                    <select name="invoice" id="" class="form-control" required>
                                        <option selected disabled="disabled" value="">Invoice</option>
                                        @foreach ($data_invoice as $key => $value)
                                            <option class="form-control" value="{{ $value }}">
                                                #{{ $value }}/{{ $data_tanggal[$key] }} </option>
                                        @endforeach

                                    </select>
                                </div>
                                <span class="text-danger">{{ $errors->first('invoice') }}</span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="foto_bukti">Foto Bukti Pembayaran</label>
                                <div class="input-group">
                                    <input type="file" name="foto_bukti" class="form-control" required>
                                </div>
                                <span class="text-danger">{{ $errors->first('foto_bukti') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3 text-center">
                    <button type="submit" class="btn btn-primary py-3 px-4">Konfirmasi Pembayaran</button>
                </div>


            </div>
            </div>
            </div>
        </form>
    </main>
    </div>
    </div>
    </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection

@section('js')
<script src="{{asset('Jualbeli/plugins/customPlugin/rupiahFormat.js')}}"></script>
    <script type="text/javascript">
        var harga = document.getElementById('jumlah_transfer');
        harga.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            harga.value = formatRupiah(this.value, 'Rp. ');
        });

    </script>
@endsection
