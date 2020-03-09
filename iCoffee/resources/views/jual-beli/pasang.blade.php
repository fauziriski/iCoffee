@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Pasang Produk</h6></header>
    <form action="/pasang-produk/berhasil" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="nama">Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" required>
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
                  <input type="number" class="form-control" placeholder="Contoh : 10000" min="1000" name="harga" required>
                  <span class="text-danger">{{$errors->first('harga')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="stok">Stok</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="Contoh : 10" min="1" name="stok" required>
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
                  <select name="id_kategori" id="" class="form-control" required>
                    @foreach ($category as $data)
                    <option value="{{ $data->id }}">{{ $data->kategori }}</option>         
                    @endforeach  
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="detail_produk" required></textarea>
                <span class="text-danger">{{$errors->first('detail_produk')}}</span>
              </div>
            </div>

            @for ($i = 0; $i < 5; $i++)
            <div class="col-md-8">
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="image-{{$i}}" id="inputGroupFile{{$i}}"/>
                <label class="custom-file-label" for="inputGroupFile{{ $i }}">Upload Foto Produk</label>
              </div>
            </div>
          </div>
            @endfor
            <div class="col-md-12 mt-3">
              <button type="submit" id="tambahproduk" class="btn btn-primary float-right py-3 px-4">Pasang Produk</button>
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
@section('js')
<script>
    $('#inputGroupFile0').on('change',function(){
      var fileName = $(this).val();

      $(this).next('.custom-file-label').html(fileName);
    });

    $('#inputGroupFile1').on('change',function(){
      var fileName = $(this).val();

      $(this).next('.custom-file-label').html(fileName);
    });

    $('#inputGroupFile2').on('change',function(){
      var fileName = $(this).val();

      $(this).next('.custom-file-label').html(fileName);
    });

    $('#inputGroupFile3').on('change',function(){
      var fileName = $(this).val();

      $(this).next('.custom-file-label').html(fileName);
    });

    $('#inputGroupFile4').on('change',function(){
      var fileName = $(this).val();

      $(this).next('.custom-file-label').html(fileName);
    });
</script>


@endsection