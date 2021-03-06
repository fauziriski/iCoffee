@extends('investasi.layouts.app')
@section('title', 'Konfirmasi Investasi | Investasi')
@section('content')
<div class="col-md-9">
  <div class="card">
    <article class="card-group-item">
       <header class="card-header"><h6 class="title">Konfirmasi Pembayaran Investasi</h6></header>
       <div class="col-md-12 ftco-animate cart-detail">
           <br>
           <form action="/invest/konfirmasi/store" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
               <div class="col-md-12">
                 <div class="form-group">
                   <div class="avatar-upload" align="center">
                       <div class="avatar-edit">
                           <input type='file' name="gambar" required id="imageUpload" accept="image/*" />
                           <small class="text-muted">(Format JPG/JPEG/PNG, Max 2MB)</small>
                           <label for="imageUpload"></label>
                       </div>
                   </div>
                 </div>
                 <div class="form-group">
                   <label for="country">Riwayat Pembelian</label>
                   <div class="select-wrap">
                     <select name="id_order" required class="form-control">
                       <option selected disabled="disabled" value="">Pilih Riwayat Pembelian</option>
                       @foreach ($order as $item)
                         <option value="{{$item->id}}">(#INV00{{$item->id}}) {{$produk[$loop->index][0]->nama_produk}}</option>
                       @endforeach 
                     </select>
                   </div>
                 </div>
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="nama">Nama Bank</label>
                     <input placeholder="Bank ABC" type="text" class="form-control" name="nama_bank" required>
                     <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                   </div>
                 </div>       
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="nama">Atas Nama</label>
                     <input type="text" placeholder="Abdul Gofar" class="form-control" name="nama" required>
                     <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-6">
                   <div class="form-group">
                     <label for="nama">Nomor Rekening</label>
                     <input type="number" placeholder="07377198" class="form-control" name="norek" required>
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
                       <input type="number" class="form-control" placeholder="Dalam Rupiah" min="1" name="nominal" required>
                       <span class="text-danger">{{$errors->first('name')}}</span>
                     </div>
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-4 mt-3" style="margin-left: 65%;">
                   <button type="submit" class="btn btn-primary py-3 px-4">Konfirmasi Pembayaran</button>
                 </div>
               </div>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div><!-- tutup side -->
 </div>
</section>
@endsection