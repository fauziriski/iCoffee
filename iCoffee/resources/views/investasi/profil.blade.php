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
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          @livewire('investasi.profil')
        </div>
        {{-- Rekening --}}
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        @livewire('investasi.bank')
        </div>
        {{-- Saldo --}}
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          @livewire('investasi.rekening')
        </div>
      </div>
</section>
@endsection