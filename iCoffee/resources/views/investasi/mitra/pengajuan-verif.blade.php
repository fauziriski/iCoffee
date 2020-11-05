@extends('investasi.mitra.layout.master')
@section('title', 'Pengajuan Dana | Investasi')
@section('content')
<div class="col-md-8 mt-5 mx-auto">
    <div  class="card">
        <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Pengajuan Dana</h6>
            </header>
            <div class="card-body">
    @livewire('investasi.mitra.pengajuan-dana')
</div>
</article>
</div>
</div>
@endsection
