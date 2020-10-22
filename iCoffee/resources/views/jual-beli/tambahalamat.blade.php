@extends('jual-beli.layouts.app')
@section('title', 'Tambah Alamat')
@section('content')

                    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                        <h2 class="text-center">Tambah Alamat</h2>

                        <form action="/profile/tambah" method="post"  enctype="multipart/form-data">
                          @csrf
                          <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" required>
                                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <div class="input-group">
                                      <input type="tel" class="form-control" id="" placeholder="" name="no_hp" required>
                                    </div>
                                    <span class="text-danger">{{$errors->first('no_hp')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="country">Provinsi</label>
                                    <div class="select-wrap">
                                      <select name="provinsi" id="" class="form-control" required>
                                        <option selected disabled="disabled" value="" >Pilih Provinsi</option>
                                        @foreach ($provinsi as $info)
                                        <option value="{{ $info['id'] }}">{{ $info['nama'] }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <span class="text-danger">{{$errors->first('provinsi')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="country">Kota/Kabupaten</label>
                                      <div class="select-wrap">
                                        <select name="kota_kabupaten" id="" class="form-control" required>
                                            <option class="form-control" value="">Pilih Kota</option>
                                        </select>
                                      </div>
                                      <span class="text-danger">{{$errors->first('kota_kabupaten')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="stok">Kecamatan</label>
                                    <div class="input-group">
                                      <select name="kecamatan" id="" class="form-control" required>
                                        <option class="form-control" value="">Pilih Kecamatan</option>
                                      </select>
                                    </div>
                                    <span class="text-danger">{{$errors->first('kecamatan')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="stok">Kode Pos</label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="" placeholder="" name="kode_pos" required>
                                    </div>
                                    <span class="text-danger">{{$errors->first('kode_pos')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="deskripsi">Alamat</label>
                                    <textarea class="form-control" rows="5" type="text" name="alamat" placeholder="" required></textarea>
                                    <span class="text-danger">{{$errors->first('alamat')}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-primary py-3 px-4">Tambah Alamat</button>
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
<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="provinsi"]').on('change', function() {
        var provinceID = $(this).val();
        if(provinceID) {
        $.ajax({
            url: '/profile/carikota/'+encodeURI(provinceID),
            type: "GET",
            dataType: "json",
            success:function(data) {
            $('select[name="kota_kabupaten"]').empty();
            $('select[name="kota_kabupaten"]').append('<option selected="true" disabled="disabled">Pilih Kota/Kabupaten</option>');
            $.each(data, function(key, value) {
                $('select[name="kota_kabupaten"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                });
            }
        });
        }
      });
      $('select[name="kota_kabupaten"]').on('change', function() {
        var cityID = $(this).val();
        if(cityID) {
        $.ajax({
            url: '/profile/subdistrict/'+encodeURI(cityID),
            type: "GET",
            dataType: "json",
            success:function(data) {
            $('select[name="kecamatan"]').empty();
            $('select[name="kecamatan"]').append('<option selected="true" disabled="disabled">Pilih Kecamatan</option>');
            $.each(data, function(key, value) {
                $('select[name="kecamatan"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        });
        }
      });
      
    });
</script>



@endsection