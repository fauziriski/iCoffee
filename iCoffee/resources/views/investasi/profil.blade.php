@extends('investasi.layouts.app')
@section('title', 'Produk Investasi | Investasi')
@section('content')

<div class="col-md-9">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Data Bank</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Rekening Saldo</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        {{-- Profil --}}
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...

        </div>
        {{-- Rekening --}}
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Daftar Bank</label>
                <div class="select-wrap">
                  <select name="id_order" class="form-control">
                    <option selected disabled="disabled" value="">Pilih Bank</option>
                    {{-- @foreach ($order as $item)
                      <option value="{{$item->id}}">(#INV00{{$item->id}}) {{$produk[$loop->index][0]->nama_produk}}</option>
                    @endforeach  --}}
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama">Atas Nama</label>
                <input type="text" placeholder="Abdul Gofar" class="form-control" name="nama">
                <span class="text-danger">{{$errors->first('nama_produk')}}</span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama">Nomor Rekening</label>
                <input type="number" placeholder="07377198" class="form-control" name="norek">
                <span class="text-danger">{{$errors->first('nama_produk')}}</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga">Total Nominal</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input type="number" class="form-control" placeholder="Dalam Rupiah" min="1" name="nominal">
                  <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- Saldo --}}
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <div class="row">
            <div align="center" class="col-lg-4 mt-5 mb-4">
              <h3>Rp. 00,0</h3>
              <small class="text-muted">Saldo Tersedia</small>
            </div>
            <div class="col-lg-8 col-sm-12">
              <label for="country">Rekening Bank</label>
              <button type="button" class="btn btn-sm btn-success float-right " data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle fa-sm"></i> Tambah Rekening</button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening Bank</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="\mitra/tambah-bank">
                          @csrf
                              <div class="form-group">
                                  <label for="recipient-name" class="col-form-label" required>Bank</label>
                                  <input type="text" class="form-control" name="bank_name">
                              </div>
                              <div class="form-group">
                                  <label for="message-text" class="col-form-label" required>Atas Nama</label>
                                  <input type="text" class="form-control" name="name">
                              </div>
                              <div class="form-group">
                                  <label for="message-text" class="col-form-label" required>Nomor Rekening</label>
                                  <input type="text" class="form-control" name="norek">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-success">Simpan</button>
                          </div>
                          </form>
                      </div>
                      </div>
                  </div>
              <form method="post" action="\mitra/tarik-saldo">
              @csrf
                  <div class="form-group">
                      <div class="select-wrap">
                      <select name="id_bank" class="form-control" required>
                          <option selected disabled="disabled" value="">Pilih Rekening Bank</option>
                          {{-- @foreach ($rekening as $item)
                              <option value="{{$item->id}}">{{$item->bank_name}} - {{$item->name}} - {{$item->norek}}</option>
                          @endforeach  --}}
                      </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="harga">Jumlah</label>
                      <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">Rp</div>
                          </div>
                          <input type="number" class="form-control" placeholder="Dalam Rupiah" min="0"  name="jumlah" required>
                          <span class="text-danger">{{$errors->first('name')}}</span>
                      </div>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-success float-right py-2">Tarik Saldo</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</section>
@endsection