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
          <div class="row justify-content-md-center">
            <div class="col-md-auto">
              <div class="form-group">
                <center>Saldo</center>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input type="number" class="form-control" readonly  min="1" name="nominal">
                  <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="country">Daftar Rekening</label>
            <div class="select-wrap">
              <select name="id_order" class="form-control">
                <option selected disabled="disabled" value="">Pilih Rekening</option>
                {{-- @foreach ($order as $item)
                  <option value="{{$item->id}}">(#INV00{{$item->id}}) {{$produk[$loop->index][0]->nama_produk}}</option>
                @endforeach  --}}
              </select>
            </div>
          </div>
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
          <div class="row">
            <div class="col-md-4 mt-3" style="margin-left: 70%;">
              <button type="submit" class="btn btn-primary py-3 px-4">Tarik Saldo</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection