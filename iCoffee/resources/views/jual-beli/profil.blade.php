@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
 <div class="card">

   <article class="card-group-item">
    <header class="card-header">
      <ul class="nav nav-pills" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Edit Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tambah Almat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Daftar Alamat</a>
      </li>
    </ul>
    </header>


    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <form action="/profil/edit_profil" method="post"  enctype="multipart/form-data">
          @csrf
          <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
            <div class="col-md-12">
              <input type="hidden" name="id_alamat" value="{{ $address->id }}">
              <input type="hidden" name="id_user" value="{{ $user->id }}">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" required value="{{ $user->name }}">
                <span class="text-danger">{{$errors->first('nama')}}</span>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga">Email </label>
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="icoffee@gmail.com" name="email" required value="{{ $user->email }}">
                      <span class="text-danger">{{$errors->first('email')}}</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="handphoe">No Handphone</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="" placeholder="08123456789" name="no_hp" required value="{{ $address->no_hp }}">
                      <span class="text-danger">{{$errors->first('stok')}}</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="country">Provinsi</label>
                    <div class="select-wrap">
                      <select name="provinsi_profil" id="" class="form-control">
                        <option value="{{ $provinsi_user['id'] }}">{{ $provinsi_user['nama'] }}</option>
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
                        <select name="kota_kabupaten_profil" id="" class="form-control">
                          <option value="{{ $kota_user['id'] }}">{{ $kota_user['nama'] }}</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stok">Kecamatan</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="" placeholder="" name="kecamatan" required value="{{ $address->kecamatan }}">
                        <span class="text-danger">{{$errors->first('kecamatan')}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stok">Kode Pos</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="" placeholder="35198" name="kode_pos" required value="{{ $address->kode_pos}}">
                        <span class="text-danger">{{$errors->first('kode_pos')}}</span>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="deskripsi">Alamat</label>
                      <textarea class="form-control" rows="5" type="text" name="alamat" placeholder="Jl. Pagar Alam (Gang PU) No.44" >{{ $address->address}}</textarea>
                      <span class="text-danger">{{$errors->first('alamat')}}</span>
                    </div>
                  </div>

                </div>
              </div>

                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary float-right py-3 px-4">Edit Data</button>
                </div>


              </div>
        </form>

      </div>


      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

        <form action="/profil/tambah" method="post"  enctype="multipart/form-data">
          @csrf
          <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
            <div class="col-md-12">
    
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama_alamat" name="nama_alamat" required>
                <span class="text-danger">{{$errors->first('nama_alamat')}}</span>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="handphoe">No Handphone</label>
                    <div class="input-group">
                      <input type="number" class="form-control" id="no_hp_alamat" placeholder="08123456789" name="no_hp_alamat" required>
                      <span class="text-danger">{{$errors->first('no_hp_alamat')}}</span>
                    </div>
                  </div>
                </div>
    
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="country">Provinsi</label>
                    <div class="select-wrap">
                      <select name="provinsi_alamat" id="provinsi_alamat" class="form-control" required>
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
                        <select name="kota_kabupaten_alamat" id="" class="form-control" required>
                            <option class="form-control" value="">Select City</option>
                        </select>
                      </div>
                    </div>
                  </div>
    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stok">Kecamatan</label>
                      <div class="input-group">
                        <input type="text" class="form-control" id="kecamatan_alamat" placeholder="Tanjung Pinang" name="kecamatan_alamat" required>
                        <span class="text-danger">{{$errors->first('kecamatan_alamat')}}</span>
                      </div>
                    </div>
                  </div>
    
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stok">Kode Pos</label>
                      <div class="input-group">
                        <input type="number" class="form-control" id="kode_pos_alamat" placeholder="35198" name="kode_pos_alamat" required>
                        <span class="text-danger">{{$errors->first('kode_pos_alamat')}}</span>
                      </div>
                    </div>
                  </div>
    
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="deskripsi">Alamat</label>
                      <textarea class="form-control" rows="5" type="text" id="alamat_alamat" name="alamat_alamat" placeholder="Jl. Pagar Alam (Gang PU) No.44" required></textarea>
                      <span class="text-danger">{{$errors->first('alamat_alamat')}}</span>
                    </div>
                  </div>
    
                </div>
              </div>
    
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary float-right py-3 px-4">Tambah Alamat</button>
                </div>
    
      
          </div>
        </form>

      </div>


      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">


        <div class="col-md-12 ftco-animate">

            <table class="table-responsive mt-3 ml-3 mb-3 mr-3">
              @foreach ($cekalamat as $data)
                <tr>
                  <th>Penerima</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th class="ml-3">{{$data->nama}}</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>

                <tr >
                  <th>Telepon</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th class="ml-3">{{$data->no_hp}}</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th class="ml-3">
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name="edit_alamat" value="{{$data->id}}" data-whatever="@mdo">Ubah</button>
                
                  </th>
                  <th class="ml-3">
                 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Hapus</button>
    
                </th>
                </tr>


                <tr>
                  <th>Alamat</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th class="ml-3">{{$data->address}},
                    {{$data->province->nama}},
                    {{$data->city->nama}},
                    {{$data->kecamatan}},
                    {{$data->kode_pos}}
                  </th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  
                </tr>
            
              @endforeach
      
            </table>
 
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="editalamatform">
                  @csrf
                  <input type="hidden" id="id_alamat_edit" name="id_alamat_edit">
                  <div class="form-group">
                    <label for="nama_edit" class="col-form-label">Nama</label>
                    <input type="text" class="form-control" id="nama_edit" name="nama_edit">
                  </div>

                  <div class="form-group">
                    <label for="no_hp_edit" class="col-form-label">Telepon</label>
                    <input type="text" class="form-control" id="no_hp_edit" name="no_hp_edit">
                  </div>

                  <div class="form-group">
                    <label for="provinsi_edit" class="col-form-label">Provinsi</label>
                      <select name="provinsi_edit" required id="provinsi_edit" class="form-control">
                        <option value="" id="prov_coba"></option>
                        @foreach ($provinsi as $info)
                          <option value="{{ $info['id'] }}">{{ $info['nama'] }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="kota_kabupaten_edit" class="col-form-label">Kota/Kabupaten</label>
                    <select name="kota_kabupaten_edit" id="" class="form-control" required>
                      <option value="" id="kota_coba"></option>
                      <option class="form-control" value="">Select City</option>
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="kecamatan_edit" class="col-form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan_edit" name="kecamatan_edit">
                  </div>

                  <div class="form-group">
                    <label for="kode_pos_edit" class="col-form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="kode_pos_edit" name="kode_pos_edit">
                  </div>

                  <div class="form-group">
                    <label for="alamat_edit" class="col-form-label">Alamat</label>
                    <textarea class="form-control" id="alamat_edit" name="alamat_edit"></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="ubahalamat">Ubah Alamat</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div><!-- tutup side -->
</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $('select[name="provinsi_profil"]').on('change', function() {
      var provinceID = $(this).val();
          if(provinceID) {
          $.ajax({
              url: '/profil/carikota/'+encodeURI(provinceID),
              type: "GET",
              dataType: "json",
              success:function(data) {
              $('select[name="kota_kabupaten_profil"]').empty();
              $.each(data, function(key, value) {
                  $('select[name="kota_kabupaten_profil"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                  });
              }
          });
          }else{
          $('select[name="kota_kabupaten_profil"]').empty();
            }
         });


  $('select[name="provinsi_alamat"]').on('change', function() {
      var provinceID = $(this).val();
          if(provinceID) {
          $.ajax({
              url: '/profil/carikota/'+encodeURI(provinceID),
              type: "GET",
              dataType: "json",
              success:function(data) {
              $('select[name="kota_kabupaten_alamat"]').empty();
              $.each(data, function(key, value) {
                  $('select[name="kota_kabupaten_alamat"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                  });
              }
          });
          }else{
          $('select[name="kota_kabupaten_alamat"]').empty();
            }
         });


  $('button[name="edit_alamat"]').on('click', function() {
      var alamatID = $(this).val();
          if(alamatID) {
          $.ajax({
              url: '/profil/cekalamat/'+encodeURI(alamatID),
              type: "GET",
              dataType: "json",
              success:function(data) {

              $.each(data, function(key, value) {
                $('#id_alamat_edit').replaceWith('<input type="hidden" id="id_alamat_edit" name="id_alamat_edit" required value="'+ data.alamat.id +'">');
                $('#nama_edit').replaceWith('<input type="text" class="form-control" id="nama_edit" name="nama_edit" required value="'+ data.alamat.nama +'">');
                $('#no_hp_edit').replaceWith('<input type="text" class="form-control" id="no_hp_edit" name="no_hp_edit" required value="'+ data.alamat.no_hp +'">');
                $('#prov_coba').replaceWith('<option value="'+ data.alamat.provinsi +'" selected>'+ data.provinsi +'</option>');
                $('#kota_coba').replaceWith('<option value="'+ data.alamat.kota_kabupaten +'" selected>'+ data.kota +'</option>');
                $('#kecamatan_edit').replaceWith('<input type="text" class="form-control" id="kecamatan_edit" name="kecamatan_edit" required value="'+ data.alamat.kecamatan +'">');
                $('#kode_pos_edit').replaceWith('<input type="text" class="form-control" id="kode_pos_edit" name="kode_pos_edit" required value="'+ data.alamat.kode_pos +'">');
                $('#alamat_edit').replaceWith('<input type="text" class="form-control" id="alamat_edit" name="alamat_edit" required value="'+ data.alamat.address +'">');

                
                  });
              }
          });
          }else{
          $('select[name="kota_kabupaten_alamat"]').empty();
            }
         });

  $('#ubahalamat').on('click', function() {
    var data = $('#editalamatform').serialize();
    $.ajax({
					url:"/profil/alamat/edit",
					method:"POST",
          dataType: 'json',
					data: data,
          success:function(data){
            swal(
              'Berhasil',
              'Edit alamat berhasil',
              'success'
            );
            location.reload();
          }
				});

  });


  $('select[name="provinsi_edit"]').on('change', function() {
      var provinceID = $(this).val();
          if(provinceID) {
          $.ajax({
              url: '/profil/carikota/'+encodeURI(provinceID),
              type: "GET",
              dataType: "json",
              success:function(data) {
              $('select[name="kota_kabupaten_edit"]').empty();
              $.each(data, function(key, value) {
                  $('select[name="kota_kabupaten_edit"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                  });
              }
          });
          }else{
          $('select[name="kota_kabupaten_edit"]').empty();
            }
         });
  });
</script>

@endsection