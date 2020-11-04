@extends('investasi.layouts.app')
@section('title', 'Investasi | Beranda')
@section('sidebar')
@endsection
@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url('images/petani.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda</a></span></p>
            <h1 class="mb-0 bread">Investasi</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        @livewire('investasi.index')
      </div>
    </section>
    
  </body>
</html>

@endsection