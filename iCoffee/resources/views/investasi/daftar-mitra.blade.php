<!DOCTYPE html>
<html lang="en">
<head>
  <title>Daftar Kelompok | Investasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
  <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('investasi/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/animate.css') }}">
  
  <link rel="stylesheet" href="{{asset('investasi/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/aos.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/jquery.timepicker.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/images.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/style.css') }}">
  {{-- <link rel="stylesheet/less" type="text/css" href="{{asset('investasi/css/gambar.less')}}" /> --}}
  <link href="{{asset('investasi/mitra/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
@section('header')
@include('investasi.layouts.header')
@show
@include('sweetalert::alert')
<br><br>
<div class="col-md-7 mx-auto">
   <div class="card">
     <article class="card-group-item">
        <header class="card-header">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Mitra Koperasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Mitra Kelompok Tani</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Mitra Perorangan</a>
          </li>
        </ul>
        </header>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            {{-- Mitra Koperasi --}}
            <form action="/daftar-koperasi/store" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="status" value="1">
              <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="avatar-upload" align="center">
                      <br>
                        <div class="avatar-edit">
                            <input type='file' name="gambar" id="imageUpload" accept="images/*" required/>
                            <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                            </div>
                        </div>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="nama">Nama Koperasi</label>
                    <a href="#"data-toggle="tooltip" data-html="true" data-placement="right" title="Isi dengan nama koperasi anda. <em>Contoh: Koperasi Petani Kopi Unila</em>">
                      <i class="fas fa-question-circle"></i>
                    </a>
                    <input type="text" class="form-control" name="nama_koperasi" required>
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">Email</label>
                      <input type="email" class="form-control" name="email" required>
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">No Handphone</label>
                      <input type="text" class="form-control" name="no_hp" required>
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-9">
                          <div class="form-group">
                            <label for="harga">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok">Jumlah Petani</label>
                        <input type="number" class="form-control" min="1"  name="jumlah_petani" required>
                        <span class="text-danger">{{$errors->first('stok')}}</span>
                    </div>
                </div>
            </div>
    
            <div class="row">
    
    
            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="deskripsi" required></textarea>
                <span class="text-danger">{{$errors->first('stok')}}</span>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">AD/ART</label><br>
                <input type="file" name="ad_art" accept="application/pdf" required/>
                <small class="text-muted">(Format PDF, Max 2MB)</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">Akte Koperasi</label><br>
                <input type="file" name="akte" accept="application/pdf" required/>
                <small class="text-muted">(Format PDF, Max 2MB)</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">KTP Pengurus</label><br>
                <input type="file" name="ktp_pengurus" accept="application/pdf" required/>
                <small class="text-muted">(Format PDF, Max 2MB)</small>
              </div>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Daftar Koperasi</button>
            </div>
    
            
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            {{-- Mitra Kelompok Tani --}}
            <form action="/daftar-kelompok/store" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="status" value="1">
              <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="avatar-upload">
                      <div class="avatar-edit" align="center">
                        <br>
                          <input type='file' name="gambar" id="imageUpload" accept="images/*" required/>
                          <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                          <label for="imageUpload"></label>
                      </div>
                      <div class="avatar-preview">
                          <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                          </div>
                      </div>
                  </div>
                  </div>
    
                <div class="form-group">
                    <label for="nama">Nama Kelompok</label>
                    <input type="text" class="form-control" name="nama_kelompok" required>
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">Email</label>
                      <input type="email" class="form-control" name="email" required>
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">No Handphone</label>
                      <input type="text" class="form-control" name="no_hp" required>
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-9">
                          <div class="form-group">
                            <label for="harga">Alamat</label>
                            <input type="text" class="form-control" name="alamat" required>
                            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok">Jumlah Petani</label>
                        <input type="number" class="form-control" min="1" name="jumlah" required>
                        <span class="text-danger">{{$errors->first('stok')}}</span>
                    </div>
                </div>
            </div>
    
            <div class="row">
    
    
            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="deskripsi" required></textarea>
                <span class="text-danger">{{$errors->first('stok')}}</span>
            </div>
            </div>
    
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Daftar Kelompok</button>
            </div>
    
            
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
            {{-- Mitra Perorangan --}}
            <form action="/daftar-perorangan/store" method="POST" enctype="multipart/form-data">
              @csrf
            <input type="hidden" name="status" value="1">
            <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="avatar-upload">
                      <div class="avatar-edit" align="center">
                        <br>
                          <input type='file' name="gambar" id="imageUpload" accept="images/*" required/>
                          <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                          <label for="imageUpload"></label>
                      </div>
                      <div class="avatar-preview">
                          <div id="imagePreview" style="background-image: url(http://i.pravatar.cc/500?img=7);">
                          </div>
                      </div>
                  </div>
                </div>
              <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" name="nama_perorangan" required>
                  <span class="text-danger">{{$errors->first('nama_produk')}}</span>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga">Email</label>
                    <input type="email" class="form-control" name="email" required>
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga">No Handphone</label>
                    <input type="text" class="form-control" name="no_hp" required>
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                          <label for="harga">Alamat</label>
                          <input type="text" class="form-control" name="alamat" required>
                          <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
              </div>
  
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="stok">Jumlah Petani</label>
                      <input type="number" class="form-control" min="1" name="jumlah_petani" required>
                      <span class="text-danger">{{$errors->first('stok')}}</span>
                  </div>
              </div>
          </div>
  
          <div class="row">
  
  
          <div class="col-md-12">
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" rows="5" type="text" name="deskripsi" required></textarea>
              <span class="text-danger">{{$errors->first('stok')}}</span>
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="adart">Kartu Keluarga</label><br>
              <input type="file" name="kartu_keluarga" accept="application/pdf" required/>
              <small class="text-muted">(Format PDF, Max 2MB)</small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="adart">Surat Nikah</label><br>
              <input type="file" name="surat_nikah" accept="application/pdf" required/>
              <small class="text-muted">(Format PDF, Max 2MB)</small>
            </div>
          </div>
          <div class="col-md-12 mt-3">
              <button type="submit" class="btn btn-primary float-right py-3 px-4">Daftar Perorangan</button>
          </div>
  
          
                </div>
              </div>
            </div>
          </form>
        </div>
        </div>
        

</div>
</div><!-- tutup side -->
</div>
@section('footer')
@include('investasi.layouts.footer')
@show

<script src="{{asset('investasi/js/jquery.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('investasi/js/popper.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('investasi/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('investasi/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('investasi/js/aos.js')}}"></script>
<script src="{{asset('investasi/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('investasi/js/scrollax.min.js')}}"></script>
<script src="{{asset('investasi/js/images.js')}}"></script>
<script src="{{asset('investasi/js/google-map.js')}}"></script>
<script src="{{asset('investasi/js/main.js')}}"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

</body>
</html>