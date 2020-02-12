@extends('jual-beli.layouts.app')
@section('content')


<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Pasang Produk Lelang</h6></header>
    <form action="/pasang-lelang/berhasil" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" required>
            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga">Harga Awal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input type="number" class="form-control" placeholder="" name="harga_awal" required>
                  <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="harga">Kelipatan</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input type="number" class="form-control" placeholder="" name="kelipatan" required>
                  <span class="text-danger">{{$errors->first('kelipatan')}}</span>
                </div>
              </div>
            </div>       
          </div>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="country">Jangka Waktu</label>
                <div class="select-wrap">
                  <select name="lama_lelang" id="" class="form-control" required>
                    <option value="3">3 Hari</option>
                    <option value="4">4 Hari</option>
                    <option value="5">5 Hari</option>
                    <option value="6">6 Hari</option>
                    <option value="7">7 Hari</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="country">Kategori</label>
                <div class="select-wrap">
                  <select name="id_kategori" id="" class="form-control" required>
                    @foreach ($category as $data)
                    <option value="{{ $data->id }}">{{ $data->kategori }}</option>         
                    @endforeach  
                  </select>
                </div>
              </div>
            </div>


            <div class="col-md-4">
              <div class="form-group">
                <label for="stok">Stok</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="Satuan" name="stok" required>
                  <span class="text-danger">{{$errors->first('stok')}}</span>
                  <div class="input-group-prepend">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="deskripsi" required></textarea>
                <span class="text-danger">{{$errors->first('stok')}}</span>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">

                  <input type="file" name="images" class="form-control-file" required>
         

                @for ($i = 0; $i < 5; $i++)

                  <input type="file" name="image[]" class="form-control-file" required>
                @endfor

              </div>
            </div>

            <div class="col-md-12 mt-3">
              <button type="submit" class="btn btn-primary float-right py-3 px-4">Pasang Lelang</button>
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