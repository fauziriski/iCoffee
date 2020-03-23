@extends('jual-beli.layouts.app')
@section('content')


<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Tarik Saldo</h6></header>
    <form action="/profil/saldo/tarik" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
            <span class="text-danger">{{$errors->first('email')}}</span>
          </div>

          <div class="form-group">
            <label for="bank">Bank</label>
            <div class="select-wrap">
              <select name="bank" id="" class="form-control" required>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>  
                <option value="BNI">BNI</option>  
                <option value="Mandiri">Mandiri</option>       
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="no_rek">No Rekening</label>
            <input type="tel" class="form-control" name="no_rek" min="" required>
            <span class="text-danger">{{$errors->first('no_rek')}}</span>
          </div>

          <div class="form-group">
            <label for="pemilik">Pemilik Rekening</label>
            <input type="text" class="form-control" name="pemilik" min="" required>
            <span class="text-danger">{{$errors->first('pemilik')}}</span>
          </div>


          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" min="10000" max="{{ $cek_saldo->saldo }}" required>
            <span class="text-danger">{{$errors->first('jumlah')}}</span>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" required>
            <span class="text-danger">{{$errors->first('password')}}</span>
          </div>


            <div class="col-md-12 mt-3">
              <button type="submit" class="btn btn-primary float-right py-3 px-4">Tarik Saldo</button>
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