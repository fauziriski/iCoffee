@extends('investasi.layouts.app')
@section('title', 'Jadi Investor')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Jadi Investor</h6></header>
    @if (count($id) == 0)
    <form action="/jadi-investor" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12 mt-2">
            <h6 align="center">Dokumen</h6>
          <div class="row">
            <div class="col-md-6 mt-3">
              <div class="form-group">
                <label for="harga">No. KTP* </label>
                <div class="input-group">
                  <input type="number" class="form-control" name="no_ktp">
                  <span class="text-danger">{{$errors->first('harga')}}</span>
                </div>
              </div>
            </div>

            <div class="col-md-6 mt-3">
              <div class="form-group">
                <label for="stok">No. NPWP</label>
                <div class="input-group">
                  <input type="number" class="form-control" name="no_npwp">
                  <span class="text-danger">{{$errors->first('stok')}}</span>
                </div>
              </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <p>KTP*</p>
                    <input type="file" name="ktp" accept="image/png, image/jpeg"class="form-control-file" >
                    <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <p>NPWP</p>
                    <input type="file" name="npwp" accept="image/png, image/jpeg" class="form-control-file" >
                    <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Pasang Produk</button>
            </div>


          </div>
        </div>
      </div>
    </form>
    @else
      <img src="waiting.png">
    @endif

  </div>
</div><!-- tutup side -->
</div>
</section>
@endsection