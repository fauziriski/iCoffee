@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Produk Anda</h6></header>
    <div class="col" style="border-radius: 400px;">
        @foreach ($produk as $data)

            <div class="row mt-3">
                <div class="col">
                    <p>Nama Produk : <strong>{{  $data->nama_produk }}</strong></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2 text-center">
                    <img class="img-fluid" src="{{ url('/Uploads/Produk/{'.$data->kode_produk.'}/'.$data->gambar) }}" width="70%" height="70%">
                </div>
                <div class="col-md-3">
                    <p>Harga : <strong style="color:#ee4d2c">Rp {{ number_format($data->harga) }}</strong></p>
                </div>
                <div class="col-md-4 mt-2">
                    <p>Stok : <strong style="color:#ee4d2c">{{ number_format($data->stok) }} Kg</strong></p>
                </div>
                <div class="col text-center mt-2">
                    <a href="/lelang/invoice/{{ $data->id }}"><span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan </a>
                </div>
            </div>
            <hr>
    
            @endforeach
        </div>


  </div>
</div><!-- tutup side -->
</div>
</section>
@endsection
@section('js')
<script>
  $('#inputGroupFile02').on('change',function(){
            var fileName = $(this).val();
            $(this).next('.custom-file-label').html(fileName);
          });
</script>
@endsection