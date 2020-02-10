@extends('jual-beli.layouts.app')
@section('title', 'Tambah Alamat')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Komplain Barang</h6></header>
    <form action="/lelang/pesanan/komplain" method="post"  enctype="multipart/form-data">
      @csrf
      <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
        <div class="col-md-12">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" required>
            <span class="text-danger">{{$errors->first('email')}}</span>
          </div>
          <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="invoice_data">Invoice</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="" placeholder="" name="invoice_data" value={{ $invoice }} readonly required>
                    <span class="text-danger">{{$errors->first('invoice_data')}}</span>
                  </div>
                </div>
              </div>

              <input type="hidden" class="form-control" id="" placeholder="" name="invoice" value={{ $invoice }} required>
              <input type="hidden" class="form-control" id="" placeholder="" name="id_order" value={{ $id }} required>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" rows="5" type="text" name="keterangan" placeholder="" required></textarea>
                  <span class="text-danger">{{$errors->first('keterangan')}}</span>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="foto_bukti">Foto Bukti Pembayaran</label>
                  <div class="input-group">
                    <input type="file" name="foto_bukti" class="form-control" required>
                    <span class="text-danger">{{$errors->first('foto_bukti')}}</span>
                  </div>
                </div>
              </div>


            </div>
          </div>

            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary float-right py-3 px-4">Komplain</button>
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

@endsection