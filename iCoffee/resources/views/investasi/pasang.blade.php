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
          <div class="col-md-4">
              <div class="form-group">
                <label for="harga">Harga </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                </div>
                <input type="number" class="form-control" placeholder="Dalam Rupiah" min="1" name="harga">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label for="stok">Unit</label>
        <div class="input-group">
          <input type="number" class="form-control" placeholder="Satuan" min="1" name="stok">
          <span class="text-danger">{{$errors->first('stok')}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label for="country">Kategori</label>
        <div class="select-wrap">
          <select name="id_kategori" class="form-control">
            <option value="1">Robusta</option>
            <option value="2">Arabika</option>
            <option value="3">Honey</option>
            <option value="4">Natural</option>
            <option value="5">Flores</option>
            <option value="6">Hijau</option>
          </select>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label for="periode">Periode Kontrak</label>
        <div class="select-wrap">
          <select name="periode" id="Kontrak" class="form-control">
            <option value="">Pilih Periode Kontrak</option>
          </select>
    </div>
</div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label for="country">Periode Bagi Hasil</label>
    <div class="select-wrap">
      <select name="profit_periode" id="Return" class="form-control input-lg">
        <option value="">Pilih Periode Return</option>
       </select>
</div>
</div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label for="stok">ROI/Tahun</label>
    <div class="input-group">
      <input type="number" class="form-control" placeholder="15" min="1" name="roi">
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
    <textarea class="form-control" rows="5" type="text" name="detail_produk"></textarea>
    <span class="text-danger">{{$errors->first('stok')}}</span>
</div>
</div>
<div class="col-md-12">
  <div class="form-group">
    @for ($i = 0; $i < 5; $i++)
      <input type="file" name="gambar[]" accept="image/*" class="form-control-file" >
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

@section('scripts')
<script>
  $(document).ready(function(){
  
   load_json_data('Kontrak');
  
   function load_json_data(id, parent_id)
   {
    var html_code = '';
    $.getJSON('country_state_city.json', function(data){
  
     html_code += '<option value="">Pilih Periode '+id+'</option>';
     $.each(data, function(key, value){
      if(id == 'Kontrak')
      {
       if(value.parent_id == '0')
       {
        html_code += '<option value="'+value.id+'">'+value.name+'</option>';
       }
      }
      else
      {
       if(value.parent_id == parent_id)
       {
        html_code += '<option value="'+value.id+'">'+value.name+'</option>';
       }
      }
     });
     $('#'+id).html(html_code);
    });
  
   }
  
   $(document).on('change', '#Kontrak', function(){
    var country_id = $(this).val();
    if(country_id != '')
    {
     load_json_data('Return', country_id);
    }
    else
    {
     $('#Return').html('<option value="">Pilih Periode Return</option>');
    }
   });
  });
  </script>
  @endsection