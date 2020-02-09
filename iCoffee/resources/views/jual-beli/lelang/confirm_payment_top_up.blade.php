@extends('jual-beli.layouts.app')
@section('title', 'Tambah Alamat')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Konfirmasi Pembayaran</h6></header>
    <form action="/profil/konfirmasi/top_up/berhasil" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
            <span class="text-danger">{{$errors->first('email')}}</span>
          </div>
          
          <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_bank_pengirim">Nama Bank Pengirim</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="" name="nama_bank_pengirim" required>
                    <span class="text-danger">{{$errors->first('nama_bank_pengirim')}}</span>
                  </div>
                </div>
              </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="no_rekening_pengirim">No Rekening Pengirim</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="" name="no_rekening_pengirim" required>
                  <span class="text-danger">{{$errors->first('no_rekening_pengirim')}}</span>
                </div>
              </div>
            </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="no_telp">Nomor Telepon</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="" placeholder="" name="no_telp" required>
                    <span class="text-danger">{{$errors->first('no_telp')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_pemilik_pengirim">Nama Pemilik Rekening</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="" name="nama_pemilik_pengirim" required>
                    <span class="text-danger">{{$errors->first('nama_pemilik_pengirim')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="jumlah_transfer">Jumlah Transfer</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="" placeholder="" name="jumlah_transfer" required>
                    <span class="text-danger">{{$errors->first('jumlah_transfer')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="invoice">Invoice</label>
                  <div class="input-group">
                    <select name="invoice" id="" class="form-control" required>
                        <option selected disabled="disabled" value="" >Invoice</option>
                        @foreach ($transaksipenjual as $data)

                          <option class="form-control" value="{{ $data->invoice }}">#{{ $data->invoice }}/{{ $data_tanggal }} </option>     
                            
                        @endforeach
                        
  
                        
                    </select>
                    <span class="text-danger">{{$errors->first('invoice')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="foto_bukti">Foto Bukti Pembayaran</label>
                  <div class="input-group">
                    <input type="file" name="foto_bukti" class="form-control" required>
                    <span class="text-danger">{{$errors->first('foto_bukti')}}</span>
                  </div>
                </div>
              </div>


            </div>
          </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Konfirmasi Pembayaran</button>
            </div>


          </div>
        </div>
      </div>
    </form>

  </div>
</div><!-- tutup side -->
</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@endsection