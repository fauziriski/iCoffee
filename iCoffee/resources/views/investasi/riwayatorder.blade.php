@extends('investasi.layouts.app')
@section('title', 'Produk Investasi | Investasi')
@section('content')

    <div class="col-md-9">
      <div class="card">
        @livewire('investasi.pembiayaan')
      </div>
    </div><!-- tutup side -->
  </div>
</section>
@endsection