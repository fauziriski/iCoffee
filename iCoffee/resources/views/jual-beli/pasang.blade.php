@extends('jual-beli.layouts.app')

@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Pasang Produk</h6></header>
    <form action="/pasang-produk/berhasil" method="post">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">
          <div class="form-group">
            <div class="images">
              <div class="pic">
                Tambah Foto
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk">
            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="harga">Harga </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input type="number" class="form-control" placeholder="Dalam Rupiah" name="harga">
                  <span class="text-danger">{{$errors->first('harga')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="stok">Stok</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="Satuan" name="stok">
                  <span class="text-danger">{{$errors->first('stok')}}</span>
                  <div class="input-group-prepend">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="country">Kategori</label>
                <div class="select-wrap">
                  <select name="id_kategori" id="" class="form-control">
                    <option value="1">Arabika</option>
                    <option value="2">Robusta</option>
                    <option value="3">Luwak</option>
                    <option value="4">Jawa</option>
                    <option value="5">Flores</option>
                    <option value="6">Hijau</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="detail_produk"></textarea>
                <span class="text-danger">{{$errors->first('detail_produk')}}</span>
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