@extends('investasi.layouts.app')
@section('title', 'Pasang Produk | Investasi')
@section('content')

<div class="col-md-9">
   <div class="card">
     <article class="card-group-item">
        <header class="card-header"><h6 class="title">Pasang Produk Investasi</h6></header>
        <form action="/pasang-investasi/store" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="nama">Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk">
                  <span class="text-danger">{{$errors->first('nama_produk')}}</span>
              </div>

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                <label for="harga">Harga </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" placeholder="Dalam Rupiah" name="harga">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label for="stok">Stok</label>
        <div class="input-group">
          <input type="number" class="form-control" placeholder="Satuan" name="stok">
          <span class="text-danger">{{$errors->first('stok')}}</span>
          <div class="input-group-prepend">
            <div class="input-group-text">Kg</div>
        </div>
    </div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="country">Periode Kontrak</label>
        <div class="select-wrap">
          <select name="kontrak" class="form-control">
            <option value="">6 bulan</option>
        </select>
    </div>
</div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label for="country">Periode Bagi Hasil</label>
    <div class="select-wrap">
      <select name="bagi_hasil" class="form-control">
        <option value="">6 bulan</option>
    </select>
</div>
</div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label for="stok">ROI/Tahun</label>
    <div class="input-group">
      <input type="number" class="form-control" placeholder="15" name="ROI">
      <span class="text-danger">{{$errors->first('stok')}}</span>
      <div class="input-group-prepend">
        <div class="input-group-text">%</div>
    </div>
</div>
</div>
</div>




<div class="col-md-12">
  <div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea class="form-control" rows="5" type="text" name="deskripsi"></textarea>
    <span class="text-danger">{{$errors->first('stok')}}</span>
</div>
</div>
<div class="col-md-12">
  <div class="form-group">
    @for ($i = 0; $i < 5; $i++)
      <input type="file" name="gambar[]" class="form-control-file" >
    @endfor
  </div>
</div>
<div class="col-md-12 mt-3">
    <button type="submit" class="btn btn-primary float-right py-3 px-4">Pasang Investasi</button>
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