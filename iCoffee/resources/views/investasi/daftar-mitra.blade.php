@extends('investasi.layouts.app')
@section('title', 'Daftar Kelompok | Investasi')
@section('content')

<div class="col-md-9">
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
              <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="gambar" id="imageUpload" accept="images/*" />
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
                    <input type="text" class="form-control" name="nama_koperasi">
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">Email</label>
                      <input type="email" class="form-control" name="email">
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">No Handphone</label>
                      <input type="text" class="form-control" name="no_hp">
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-9">
                          <div class="form-group">
                            <label for="harga">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok">Jumlah Petani</label>
                        <input type="number" class="form-control" id="" name="jumlah_petani">
                        <span class="text-danger">{{$errors->first('stok')}}</span>
                    </div>
                </div>
            </div>
    
            <div class="row">
    
    
            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="deskripsi"></textarea>
                <span class="text-danger">{{$errors->first('stok')}}</span>
            </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">AD/ART</label><br>
                <input type="file" name="ad_art" accept="application/pdf"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">Akte Koperasi</label><br>
                <input type="file" name="akte" accept="application/pdf"/>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="adart">KTP Pengurus</label><br>
                <input type="file" name="ktp_pengurus" accept="application/pdf"/>
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
              <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="gambar" id="imageUpload" accept="images/*" />
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
                    <input type="text" class="form-control" name="nama_kelompok">
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">Email</label>
                      <input type="email" class="form-control" name="email">
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="harga">No Handphone</label>
                      <input type="text" class="form-control" name="no_hp">
                      <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                      <div class="col-md-9">
                          <div class="form-group">
                            <label for="harga">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                            <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                    </div>
                </div>
    
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok">Jumlah Petani</label>
                        <input type="number" class="form-control" id="" name="jumlah">
                        <span class="text-danger">{{$errors->first('stok')}}</span>
                    </div>
                </div>
            </div>
    
            <div class="row">
    
    
            <div class="col-md-12">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" rows="5" type="text" name="deskripsi"></textarea>
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
            <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="avatar-upload">
                      <div class="avatar-edit">
                          <input type='file' name="gambar" id="imageUpload" accept="images/*" />
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
                  <input type="text" class="form-control" name="nama_perorangan">
                  <span class="text-danger">{{$errors->first('nama_produk')}}</span>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga">Email</label>
                    <input type="email" class="form-control" name="email">
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga">No Handphone</label>
                    <input type="text" class="form-control" name="no_hp">
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
                </div>
              </div>
              <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                          <label for="harga">Alamat</label>
                          <input type="text" class="form-control" name="alamat">
                          <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                  </div>
              </div>
  
              <div class="col-md-3">
                  <div class="form-group">
                      <label for="stok">Jumlah Petani</label>
                      <input type="number" class="form-control" name="jumlah_petani">
                      <span class="text-danger">{{$errors->first('stok')}}</span>
                  </div>
              </div>
          </div>
  
          <div class="row">
  
  
          <div class="col-md-12">
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <textarea class="form-control" rows="5" type="text" name="deskripsi"></textarea>
              <span class="text-danger">{{$errors->first('stok')}}</span>
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="adart">Kartu Keluarga</label><br>
              <input type="file" name="kartu_keluarga" accept="application/pdf"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="adart">Surat Nikah</label><br>
              <input type="file" name="surat_nikah" accept="application/pdf"/>
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
</section>
@endsection