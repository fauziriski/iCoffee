@extends('jual-beli.layouts.app')
@section('title', 'Tambah Alamat')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Tambah Alamat</h6></header>
    <form action="/profil/tambah" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" required>
            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="handphoe">No Handphone</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="" placeholder="08123456789" name="no_hp" required>
                  <span class="text-danger">{{$errors->first('stok')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Provinsi</label>
                <div class="select-wrap">
                  <select name="provinsi" id="" class="form-control" required>
                    @foreach ($provinsi as $info)
                    <option value="{{ $info['id'] }}">{{ $info['nama'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Kota/Kabupaten</label>
                  <div class="select-wrap">
                    <select name="kota_kabupaten" id="" class="form-control" required>
                        <option class="form-control" value="">Select City</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="stok">Kecamatan</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="Tanjung Pinang" name="kecamatan" required>
                    <span class="text-danger">{{$errors->first('kecamatan')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="stok">Kode Pos</label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="" placeholder="35198" name="kode_pos" required>
                    <span class="text-danger">{{$errors->first('kode_pos')}}</span>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="deskripsi">Alamat</label>
                  <textarea class="form-control" rows="5" type="text" name="alamat" placeholder="Jl. Pagar Alam (Gang PU) No.44" required></textarea>
                  <span class="text-danger">{{$errors->first('alamat')}}</span>
                </div>
              </div>

            </div>
          </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Tambah Alamat</button>
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
<script type="text/javascript">
    $(document).ready(function() {
    $('select[name="provinsi"]').on('change', function() {
        var provinceID = $(this).val();
            if(provinceID) {
            $.ajax({
                url: '/profil/carikota/'+encodeURI(provinceID),
                type: "GET",
                dataType: "json",
                success:function(data) {
                $('select[name="kota_kabupaten"]').empty();
                $.each(data, function(key, value) {
                    $('select[name="kota_kabupaten"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                    });
                }
            });
            }else{
            $('select[name="kota_kabupaten"]').empty();
              }
           });
    });
</script>



@endsection