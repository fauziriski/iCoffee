@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Edit Profil</h6></header>
    <form action="/pasang-produk/berhasil" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama_produk">
            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga">Email </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control" placeholder="icoffee@gmail.com" name="email">
                  <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="handphoe">No Handphone</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="08123456789" name="no_hp">
                  <span class="text-danger">{{$errors->first('stok')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Provinsi</label>
                <div class="select-wrap">
                  <select name="id_kategori" id="" class="form-control">
                    <option value="1">Robusta</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Kota/Kabupaten</label>
                  <div class="select-wrap">
                    <select name="id_kategori" id="" class="form-control">
                      <option value="1">Robusta</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="stok">Kecamatan</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="" placeholder="Satuan" name="kecamatan">
                    <span class="text-danger">{{$errors->first('kecamatan')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="stok">Kode Pos</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="" placeholder="35198" name="kode_pos">
                    <span class="text-danger">{{$errors->first('kode_pos')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="deskripsi">Alamat</label>
                  <textarea class="form-control" rows="5" type="text" name="alamat" placeholder="Jl. Pagar Alam (Gang PU) No.44"></textarea>
                  <span class="text-danger">{{$errors->first('alamat')}}</span>
                </div>
              </div>

            </div>
          </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Pasang Produk</button>
            </div>


          </div>
        </div>
      </div>
    </form>

  </div>
</div><!-- tutup side -->
</div>
</section>
@endsection