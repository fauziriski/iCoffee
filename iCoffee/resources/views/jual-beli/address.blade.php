@extends('jual-beli.layouts.app')
@section('title', 'Profle | Alamat')
@section('content')

                <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                    <ul class="nav nav-pills justify-content-md-start mt-2 border-bottom justify-content-sm-around" id="pills-tab" role="tablist">
                        <li class="nav-item p-2 flex-fill text-center">
                            <a class="nav-link active" id="pills-tambah-alamat-baru-tab" data-toggle="pill" href="#pills-tambah-alamat-baru" role="tab" aria-controls="pills-tambah-alamat-baru" aria-selected="true">Tambah Alamat Baru</a>
                        </li>
                        <li class="nav-item p-2 flex-fill text-center">
                            <a class="nav-link" id="pills-daftar-alamat-tab" data-toggle="pill" href="#pills-daftar-alamat" role="tab" aria-controls="pills-daftar-alamat" aria-selected="false">Daftar Alamat</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-tambah-alamat-baru" role="tabpanel" aria-labelledby="pills-tambah-alamat-baru-tab">
                            <form action="/profile/tambah/cadangan" method="post"  enctype="multipart/form-data">
                                @csrf
                                <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12" style="margin-bottom: 0px">
                                                <div class="form-group">
                                                    <label for="nama_alamat">Nama</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="nama_alamat" name="nama_alamat" style="border-radius: 10px"  required>
                                                        <span class="col-md-12 text-danger">{{$errors->first('nama_alamat')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="no_hp_alamat">No Handphone</label>
                                                    <div class="input-group">
                                                        <input type="tel" class="form-control" id="no_hp_alamat" placeholder="" name="no_hp_alamat" style="border-radius: 10px"  required>
                                                        <span class="col-md-12 text-danger">{{$errors->first('no_hp_alamat')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="provinsi_alamat">Provinsi</label>
                                                    <div class="select-wrap">
                                                        <select name="provinsi_alamat" id="provinsi_alamat" class="form-control" style="border-radius: 10px"  required>
                                                            <option class="form-control" value="" id="prov__coba">Pilih Provinsi</option>
                                                            @foreach ($provinsi as $info)
                                                            <option style="border-radius: 10px" value="{{ $info['id'] }}">{{ $info['nama'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kota_kabupaten_alamat">Kota/Kabupaten</label>
                                                    <div class="select-wrap">
                                                        <select name="kota_kabupaten_alamat" id="" class="form-control" style="border-radius: 10px"  required>
                                                            <option class="form-control" value="">Pilih Kota</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kecamatan_alamat">Kecamatan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="kecamatan_alamat" placeholder="" name="kecamatan_alamat" style="border-radius: 10px"  required>
                                                        <span class="col-md-12 text-danger">{{$errors->first('kecamatan_alamat')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="kode_pos_alamat">Kode Pos</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="kode_pos_alamat" placeholder="" name="kode_pos_alamat" style="border-radius: 10px"  required>
                                                        <span class="col-md-12 text-danger">{{$errors->first('kode_pos_alamat')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="alamat_alamat">Alamat</label>
                                                    <textarea class="form-control" rows="5" type="text" id="alamat_alamat" name="alamat_alamat" placeholder="" style="border-radius: 10px"  required></textarea>
                                                    <span class="col-md-12 text-danger">{{$errors->first('alamat_alamat')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                          
                                    <div class="col-md-12 mt-3 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary py-3 px-4">Tambah Alamat</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade show" id="pills-daftar-alamat" role="tabpanel" aria-labelledby="pills-daftar-alamat-tab">
                            @foreach ($cekalamat as $item)
                            
                            @if (!($item->status == 0))
                            <div class="row mr-2 mt-2 ml-2 mb-2 " style=" border: 1px solid #ee4d2c;border-radius: 10px">
                            @else
                            <div class="row mr-2 mt-2 ml-2 mb-2 border" style="border-radius: 10px">
                            @endif
                                <div class="col-md-9 mt-2">
                                    <div class="row mb-0" style="">
                                        <div class="col-md-2">
                                            <p class="font-weight-bold d-none d-md-inline">Nama</p>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="">{{ $item->nama }}</p>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-2">
                                            <p class="font-weight-bold d-none d-md-inline">Telepon</p>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="">{{ $item->no_hp }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 align-self-center">
                                            <p class="font-weight-bold d-none d-md-inline">Alamat</p>
                                        </div>
                                        <div class="col-md-10">
                                            <p class="mb-0">{{ $item->address }}</p>
                                            <p class="mb-0">{{ $item->kecamatan }} - {{ $item->city->nama }}</p>
                                            <p class="mb-0">{{ $item->province->nama }}</p>
                                            <p class="">{{ $item->kode_pos }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2 mb-2 align-self-center">
                                    <div class="row justify-content-center">
                                        <div class="col-5 col-md-5 col-sm-5">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name="edit_alamat" value="{{$item->id}}" data-whatever="@mdo">
                                                Ubah
                                            </button>
                                        </div>
                                        <div class="col-5 col-md-5 col-sm-5">
                                            <a href="#" name="hapusalamat" value="{{$item->id}}" type="button" class="btn btn-primary">
                                                Hapus
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row justify-content-center mt-2 mb-2">
                                        <div class="col-12 col-md-12 col-sm-12 text-center">
                                            @if (!($item->status == 0))
                                            <a>
                                                <span class="oi oi-map-marker"></span>&nbsp; Atur Jadi Utama
                                            </a>
                                            @else
                                            <a href="/profile/utama/alamat/{{ $item->id }}">
                                                <span class="oi oi-map-marker"></span>&nbsp; Atur Jadi Utama
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

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
                                            <input type="tel" class="form-control" id="no_hp_edit" name="no_hp_edit">
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
                                    <button type="button" class="btn btn-secondary" style="border-radius: 10px" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="ubahalamat">Ubah Alamat</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(function(){
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });
    
    });
</script>

<script>
    $(document).ready(function() {

        $('select[name="provinsi_alamat"]').on('change', function() {
            var provinceID = $(this).val();
                if(provinceID) {
                    $.ajax({
                        url: '/profile/carikota/'+encodeURI(provinceID),
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="kota_kabupaten_alamat"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="kota_kabupaten_alamat"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                            });
                        }
                    });
                } else{
                    $('select[name="kota_kabupaten_alamat"]').empty();
                }
        });

        $('button[name="edit_alamat"]').on('click', function() {
            var alamatID = $(this).val();
                if(alamatID) {
                    $.ajax({
                        url: '/profile/cekalamat/'+encodeURI(alamatID),
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

        $('select[name="provinsi_edit"]').on('change', function() {
            var provinceID = $(this).val();
            if(provinceID) {
                $.ajax({
                    url: '/profile/carikota/'+encodeURI(provinceID),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                    $('select[name="kota_kabupaten_edit"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="kota_kabupaten_edit"]').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                        });
                    }
                });
            } else{
                $('select[name="kota_kabupaten_edit"]').empty();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#ubahalamat').on('click', function() {
            var data = $('#editalamatform').serialize();
            $.ajax({
                url:"/profile/alamat/edit",
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

        $('a[name="hapusalamat"]').on('click', function() {
            var id = $(this).attr('value');
            swal({
                title: "Apakah Anda Yakin!?",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Hapus",
                showCancelButton: true,
            }, function() {
                console.log(id);
                $.ajax({
                    type: "GET",
                    url: '/profile/alamat/hapus/'+encodeURI(id),
                    dataType: "json",
                    success: function (data) {
                            swal(
                            'Berhasil',
                            'Hapus Alamat Berhasil',
                            'success'
                        );
                        location.reload();
                    }         
                });
            });
        });
    });

</script>

@endsection

@section('footer')
    
@endsection