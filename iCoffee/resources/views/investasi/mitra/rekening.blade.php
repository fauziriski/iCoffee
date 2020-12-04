@extends('investasi.mitra.layout.master')
@section('title', 'Rekening Mitra | Investasi')
@section('content')

<div class="col-md-9 mx-auto">
    <div class="card">
        <article class="card-group-item">
            <header class="card-header">
                <h6 class="title">Rekening Mitra</h6>
            </header>
            <div class="card-body">
                <div class="row">
                    <div align="center" class="col-lg-4 mt-5 mb-4">
                        <h3>@money($saldo_tercatat)</h3>
                        <small class="text-muted">Saldo Tersedia</small>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <label for="country">Rekening Bank</label>
                        <button type="button" class="btn btn-sm btn-success float-right " data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle fa-sm"></i> Tambah Rekening</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening Bank</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post" action="\mitra/tambah-bank">
                                    @csrf
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label" required>Bank</label>
                                            <input type="text" class="form-control" name="bank_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label" required>Atas Nama</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label" required>Nomor Rekening</label>
                                            <input type="text" class="form-control" name="norek">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        <form method="post" action="\mitra/tarik-saldo">
                        @csrf
                            <div class="form-group">
                                <div class="select-wrap">
                                <select name="id_bank" class="form-control" required>
                                    <option selected disabled="disabled" value="">Pilih Rekening Bank</option>
                                    @foreach ($rekening as $item)
                                        <option value="{{$item->id}}">{{$item->bank_name}} - {{$item->name}} - {{$item->norek}}</option>
                                    @endforeach 
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga">Jumlah</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Dalam Rupiah" min="0" max="{{$saldo}}" name="jumlah" required>
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right py-2">Tarik Saldo</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <h6>Riwayat Penarikan Dana</h6>
                    <table id="table_id" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Bank</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < count($withdraws); $i++)
                                <tr>
                                    <th scope="row">{{$i+1}}</th>
                                    <td>{{$bank_withdraws[$i][0]->name}}</td>
                                    <td>{{$bank_withdraws[$i][0]->bank_name}}</td>
                                    <td>@money($withdraws[$i]->jumlah)</td>
                                    <td>{{$withdraws[$i]->created_at}}</td>
                                    <td>
                                        @if ($withdraws[$i]->status == 0)
                                            <span class="badge badge-danger">Ditolak</span></h5>
                                        @elseif( $withdraws[$i]->status == 1)
                                            <span class="badge badge-warning">Belum Divalidasi</span></h5>
                                        @elseif( $withdraws[$i]->status == 2)
                                            <span class="badge badge-success">Dikirim</span></h5>
                                        @elseif( $withdraws[$i]->status == 3)
                                            <span class="badge badge-success">Diproses</span></h5>
                                        @endif
                                    </td>
                                </tr>
                            @endfor
                    </table>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection