@extends('jual-beli.layouts.app')
@section('title', 'Profle | Riwayat Top Up')
@section('content')

                <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                    <ul class="nav nav-pills justify-content-md-start mt-2 border-bottom justify-content-sm-around" id="pills-tab" role="tablist">
                        <li class="nav-item p-2 flex-fill text-center">
                            <a class="nav-link active" id="pills-semua-tab" data-toggle="pill" href="#pills-semua" role="tab" aria-controls="pills-semua" aria-selected="true">
                                Semua
                            </a>
                        </li>
                        <li class="nav-item p-2 flex-fill text-center">
                            <a class="nav-link" id="pills-topup-masuk-tab" data-toggle="pill" href="#pills-topup-masuk" role="tab" aria-controls="pills-topup-masuk" aria-selected="true">
                                Saldo Masuk
                            </a>
                        </li>
                        <li class="nav-item p-2 flex-fill text-center">
                            <a class="nav-link" id="pills-topup-keluar-tab" data-toggle="pill" href="#pills-topup-keluar" role="tab" aria-controls="pills-topup-keluar" aria-selected="true">
                                Saldo Keluar
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-semua" role="tabpanel" aria-labelledby="pills-semua-tab">
                            @foreach ($allsaldo as $item)
                            @if ($item->title == 'top_up')

                            <div class="row mr-2 mt-2 ml-2 mb-2 " style=" border: 1px solid #ee4d2c;border-radius: 10px">
                                <div class="col-md-12">
                                    <div class="row mr-1 mt-2 ml-2">
                                        <div class="col-md-9 mt-2">
                                            <h4 class="font-weight-bold">
                                                Top Up
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2">
                                        <div class="col-md-7 mt-2">
                                            <div class="row mb-0" style="">
                                                <div class="col-md-2">
                                                    <p class="font-weight-bold d-none d-md-inline">Tanggal</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="">{{ $item->created_at }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 align-self-center">
                                                    <p class="">
                                                        Top Up saldo dari {{ $item->payment }} - {{ $item->invoice }} - {{ $item->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-md-1 align-self-center">
                                            <div class="row justify-content-start">
                                                <div class="col-md-12">
                                                    <center>
                                                        <p style="color: #ee4d2c">
                                                        Jumlah Penarikan : Rp {{ number_format($item->jumlah,0,",",".")  }}
                                                        </p>    
                                                    </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <center>
                                                        <a class="text-center" href="" data-toggle="modal" data-target="#exampleModal" name="detailinvoice" value="{{ $item->invoice }}" target="_blank" data-whatever="@mdo"><span class="oi oi-eye align-middle">
                                                            </span>&nbsp; Detail Pesanan 
                                                        </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2 text-center">
                                        <div class="col-md-12 align-self-center">
                                        <p class="text-center font-weight-bold">
                                            @if ( $item->status == 1)
                                            <div class="alert alert-warning text-center" role="alert">Menunggu Pembayaran</div>
                                            @elseif ( $item->status == 2)
                                            <div class="alert alert-danger text-center" role="alert">Konfirmasi Pembayaran Ditolak</div>
                                            @elseif ( $item->status == 3)
                                            <div class="alert alert-success text-center" role="alert">Konfirmasi Pembayaran Diterima</div>
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else

                            <div class="row mr-2 mt-2 ml-2 mb-2 " style=" border: 1px solid #ee4d2c;border-radius: 10px">
                                <div class="col-md-12">
                                    <div class="row mr-1 mt-2 ml-2">
                                        <div class="col-md-9 mt-2">
                                            <h4 class="font-weight-bold">
                                                Penarikan Saldo
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2">
                                        <div class="col-md-7 mt-2">
                                            <div class="row mb-0" style="">
                                                <div class="col-md-2">
                                                    <p class="font-weight-bold d-none d-md-inline">Tanggal</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="">{{ $item->created_at }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 align-self-center">
                                                    <p class="">
                                                        Penarikan saldo ke {{ $item->bank }} - {{ $item->no_rekening }} -  {{ $item->pemilik_rekening }} - {{ $item->created_at }} - {{ $item->invoice }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-md-1 align-self-center">
                                            <div class="row justify-content-start">
                                                <div class="col-md-12">
                                                    <div class="col-md-12">
                                                        <center>
                                                            <p style="color: #ee4d2c">
                                                            Jumlah Penarikan : Rp {{ number_format($item->jumlah,0,",",".")  }}
                                                            </p>    
                                                        </center>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <center>
                                                            <a href="" data-toggle="modal" data-target="#saldoModal" name="detailinvoicesaldo" value="{{ $item->invoice }}" target="_blank" data-whatever="@mdo">
                                                                <span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan 
                                                            </a>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2 text-center">
                                        <div class="col-md-12 align-self-center">
                                        <p class="text-center font-weight-bold">
                                            @if ($item->status == 5)
                                            <div class="alert alert-info text-center" role="alert">Menunggu Konfirmasi Admin</div>
                                            @elseif($item->status == 2)
                                            <div class="alert alert-danger text-center" role="alert">Gagal Mencairkan Dana</div>
                                            @elseif($item->status == 3)
                                            <div class="alert alert-success text-center" role="alert">Dana Berhasil Dicairkan</div>
                                            @elseif($item->status == 4)
                                            <div class="alert alert-info text-center" role="alert">Sedang dalam Proses</div>
                                            @elseif($item->status == 5)
                                            <div class="alert alert-danger text-center" role="alert">Penarikan Dibatalkan</div>
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                            @endforeach
                        </div>

                        <div class="tab-pane fade show" id="pills-topup-masuk" role="tabpanel" aria-labelledby="pills-topup-masuk-tab">
                            @foreach ($top_up as $item)

                            <div class="row mr-2 mt-2 ml-2 mb-2 " style=" border: 1px solid #ee4d2c;border-radius: 10px">
                                <div class="col-md-12">
                                    <div class="row mr-1 mt-2 ml-2">
                                        <div class="col-md-9 mt-2">
                                            <h4 class="font-weight-bold">
                                                Top Up
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2">
                                        <div class="col-md-7 mt-2">
                                            <div class="row mb-0" style="">
                                                <div class="col-md-2">
                                                    <p class="font-weight-bold d-none d-md-inline">Tanggal</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="">{{ $item->created_at }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 align-self-center">
                                                    <p class="">
                                                        Top Up saldo dari {{ $item->payment }} - {{ $item->invoice }} - {{ $item->created_at }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-md-1 align-self-center">
                                            <div class="row justify-content-start">
                                                <div class="col-md-12">
                                                    <center>
                                                        <p style="color: #ee4d2c">
                                                        Jumlah Penarikan : Rp {{ number_format($item->jumlah,0,",",".")  }} 
                                                        </p>    
                                                    </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <center>
                                                        <a class="text-center" href="" data-toggle="modal" data-target="#exampleModal" name="detailinvoice" value="{{ $item->invoice }}" target="_blank" data-whatever="@mdo"><span class="oi oi-eye align-middle">
                                                            </span>&nbsp; Detail Pesanan 
                                                        </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2 text-center">
                                        <div class="col-md-12 align-self-center">
                                        <p class="text-center font-weight-bold">
                                            @if ( $item->status == 1)
                                            <div class="alert alert-warning text-center" id="status" role="alert">Menunggu Pembayaran</div>
                                            @elseif ( $item->status == 2)
                                            <div class="alert alert-danger text-center" id="status" role="alert">Konfirmasi Pembayaran Ditolak</div>
                                            @elseif ( $item->status == 3)
                                            <div class="alert alert-success text-center" id="status" role="alert">Konfirmasi Pembayaran Diterima</div>
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>

                        <div class="tab-pane fade show" id="pills-topup-keluar" role="tabpanel" aria-labelledby="pills-topup-keluar-tab">
                            @foreach ($balance_withdrawal as $item)

                            <div class="row mr-2 mt-2 ml-2 mb-2 " style=" border: 1px solid #ee4d2c;border-radius: 10px">
                                <div class="col-md-12">
                                    <div class="row mr-1 mt-2 ml-2">
                                        <div class="col-md-9 mt-2">
                                            <h4 class="font-weight-bold">
                                                Penarikan Saldo
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2">
                                        <div class="col-md-7 mt-2">
                                            <div class="row mb-0" style="">
                                                <div class="col-md-2">
                                                    <p class="font-weight-bold d-none d-md-inline">Tanggal</p>
                                                </div>
                                                <div class="col-md-10">
                                                    <p class="">{{ $item->created_at }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 align-self-center">
                                                    <p class="">
                                                        Penarikan saldo ke {{ $item->bank }} - {{ $item->no_rekening }} -  {{ $item->pemilik_rekening }} - {{ $item->created_at }} - {{ $item->invoice }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-md-1 align-self-center">
                                            <div class="row justify-content-start">
                                                <div class="col-md-12">
                                                    <center>
                                                        <p style="color: #ee4d2c">
                                                        Jumlah Penarikan : Rp {{ number_format($item->jumlah,0,",",".")   }}
                                                        </p>    
                                                    </center>
                                                </div>
                                                <div class="col-md-12">
                                                    <center>
                                                        <a href="" data-toggle="modal" data-target="#saldoModal" name="detailinvoicesaldo" value="{{ $item->invoice }}" target="_blank" data-whatever="@mdo">
                                                            <span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan 
                                                        </a>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mr-1 ml-2 text-center">
                                        <div class="col-md-12 align-self-center">
                                        <p class="text-center font-weight-bold">
                                            @if ($item->status == 1)
                                            <div class="alert alert-info text-center" role="alert">Menunggu Konfirmasi Admin</div>
                                            @elseif($item->status == 2)
                                            <div class="alert alert-danger text-center" role="alert">Gagal Mencairkan Dana</div>
                                            @elseif($item->status == 3)
                                            <div class="alert alert-success text-center" role="alert">Dana Berhasil Dicairkan</div>
                                            @elseif($item->status == 4)
                                            <div class="alert alert-info text-center" role="alert">Sedang dalam Proses</div>
                                            @elseif($item->status == 5)
                                            <div class="alert alert-danger text-center" role="alert">Penarikan Dibatalkan</div>
                                            @endif
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>

                    </div>

                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <img src="{{asset('logo.png') }}" width="30%" height="25%" class="text-center mt-2">
                                            <h3 class="modal-title text-center mt-1">Invoice</h3>
                                </div>
                                <div class="modal-body">
                                    <p class="tanggal" id="tanggal">Checkout berhasil pada tanggal, 07 Desember 2019, 18:13 WIB</p>
                                    <div class="form-group">
                                        <label for="invoice" class="col-form-label">Invoice</label>
                                        <input type="text" class="form-control" id="invoice" name="invoice" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_edit" class="col-form-label">Jumlah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="number" class="form-control" id="harga_edit" name="harga_edit" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment" class="col-form-label">Metode Pembayaran</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="payment" name="payment">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="alert alert-warning text-center" id="status_topup" role="alert">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="border-radius: 10px" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="" class="btn btn-primary" style="color: #fff;height: 0px;width: 0px;overflow:hidden;" id="konfirm" >Selesai</a>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div class="modal bd-example-modal-lg" id="saldoModal" tabindex="-1" role="dialog" aria-labelledby="saldoModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <img src="{{asset('logo.png') }}" width="30%" height="25%" class="text-center mt-2">
                                    <h3 class="modal-title text-center mt-1">Invoice</h3>
                                </div>
                                <div class="modal-body">
                                    <p class="tanggal_dana" id="tanggal_dana">Checkout berhasil pada tanggal, 07 Desember 2019, 18:13 WIB</p>
                                        <table border="0">
                                            <tr>
                                                <th class="text-left">Invoice</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>	
                                                <th id="invoice_dana"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Pemilik Rekening</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th id="pemilik_rekening_dana"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Email</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>	
                                                <th id="email_dana"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Bank</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>	
                                                <th id="bank_dana"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-left">No Rekening</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>	
                                                <th id="no_rek_dana"></th>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Jumlah Penarikan</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>
                                                <th>:</th>
                                                <th>&nbsp;&nbsp;&nbsp;</th>	
                                                <th id="jumlah_dana"></th>
                                            </tr>
                                        </table>

                                    <div class="form-group">
                                        <div class="alert alert-warning text-center" id="status_dana" role="alert">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" style="border-radius: 10px" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="" class="btn btn-primary" style="color: #fff;height: 0px;width: 0px;overflow:hidden;" id="konfirm_dana_cair" >Selesai</a>
                                </div>
                            </div>
                        </div>
                    </div>
            

                </main>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(function(){
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });
        });
    
    });
</script>

<script>
    $(document).ready(function() {
        $('a[name="detailinvoice"]').on('click', function() {
            var href = $(this).attr('value');      
            if(href) {
                $.ajax({
                    url: '/profile/top_up/detailinvoice/'+encodeURI(href),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $.each(data, function(key, value) {
                            $('#tanggal').replaceWith('<p class="tanggal" id="tanggal">Checkout berhasil pada tanggal, '+ data.invoice.created_at+' WIB</p>');
                            $('#invoice').replaceWith('<input type="text" class="form-control" id="invoice" value="'+ data.invoice.invoice +'" name="invoice" readonly>');
                            $('#email').replaceWith('<input type="email" class="form-control" id="email"  value="'+ data.invoice.email +'" name="email" readonly>');
                            $('#harga_edit').replaceWith('<input type="number" class="form-control" id="harga_edit" value="'+ data.invoice.jumlah.toLocaleString("id-ID") +'" name="harga_edit" readonly>');
                            $('#payment').replaceWith('<input type="text" class="form-control" value="'+ '(' + data.invoice.payment + ') '+ data.bank.no_rekening +'" id="payment"  name="payment" readonly>');
                            if ( data.invoice.status == 1) {
                                $('#status_topup').replaceWith('<div class="alert alert-warning text-center" id="status" role="alert">Menunggu Pembayaran</div>');
                                $('#konfirm').replaceWith('<a href="/profil/konfirmasi/top_up" type="submit" class="btn btn-primary" id="konfirm" >Konfirmasi Pembayaran</a>');
                            }
                            else if( data.invoice.status == 2) {
                                $('#status_topup').replaceWith('<div class="alert alert-danger text-center" id="status" role="alert">Konfirmasi Pembayaran Ditolak</div>');
                                $('#konfirm').replaceWith('<a href="/profil/konfirmasi/top_up" class="btn btn-primary" style="color: #fff;" id="konfirm" >Konfirmasi Pembayaran</a>');
                            }else if ( data.invoice.status == 3) {
                                $('#status_topup').replaceWith('<div class="alert alert-success text-center" id="status" role="alert">Konfirmasi Pembayaran Diterima</div>');
                                $('#konfirm').replaceWith('<a href="" style="color: #fff;height: 0px;width: 0px;overflow:hidden;" id="konfirm" >Selesai</a>');
                            }
                            
                        });

                    }
                })
            }
            else{
                $('a[name="detailinvoice"]').empty();
            }
        });

        $('a[name="detailinvoicesaldo"]').on('click', function() {
            var dana = $(this).attr('value');
            if(dana) {
                $.ajax({
                    url: '/profil/tarikdana/'+encodeURI(dana),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $.each(data, function(key, value) {
                            $('#tanggal_dana').replaceWith('<p class="tanggal_dana" id="tanggal_dana">Checkout berhasil pada tanggal, '+ data.created_at +' WIB</p>');
                            $('#invoice_dana').replaceWith('<td class="align-middle" id="invoice_dana"><strong>'+ data.invoice +'</strong></td>');
                            $('#pemilik_rekening_dana').replaceWith('<td class="" id="pemilik_rekening_dana"><strong>'+ data.pemilik_rekening +'</strong></td>');
                            $('#bank_dana').replaceWith('<td id="bank_dana"><strong>'+ data.bank +'</strong></td>');
                            $('#email_dana').replaceWith('<td id="email_dana"><strong>'+ data.email +'</strong></td>');
                            $('#no_rek_dana').replaceWith('<td class="align-middle" id="no_rek_dana"><strong>'+ data.no_rekening +'</strong></td>');
                            $('#jumlah_dana').replaceWith('<td id="jumlah_dana"><strong> Rp '+ data.jumlah.toLocaleString("id-ID") +'</strong></td>');

                            if ( data.status == 1) {
                                $('#konfirm_dana_cair').replaceWith('<a href="/profil/batal/dana_cair/'+ data.invoice +'" type="submit" class="btn btn-primary" id="konfirm_dana_cair" >Batalkan Penarikan</a>');
                                $('#status_dana').replaceWith('<div class="alert alert-info text-center" id="status_dana" role="alert">Menunggu Konfirmasi Admin</div>');
                                
                            }
                            else if ( data.status == 2) {
                                $('#konfirm_dana_cair').replaceWith('<a type="hidden" href="#" style="height: 0px;width: 0px;overflow:hidden;display: none;" type="submit" class="btn btn-primary" id="konfirm_dana_cair" >Batalkan Penarikan</a>');
                                $('#status_dana').replaceWith('<div class="alert alert-danger text-center" id="status_dana" role="alert">Gagal Mencairkan Dana</div>');
                                
                            }
                            else if ( data.status == 3) {
                                $('#konfirm_dana_cair').replaceWith('<a type="hidden" href="#" style="height: 0px;width: 0px;overflow:hidden;display: none;" type="submit" class="btn btn-primary" id="konfirm_dana_cair" >Batalkan Penarikan</a>');
                                $('#status_dana').replaceWith('<div class="alert alert-success text-center" id="status_dana" role="alert">Dana Berhasil Dicairkan</div>');
                                
                            }
                            else if ( data.status == 4) {
                                $('#konfirm_dana_cair').replaceWith('<a type="hidden" href="#" style="height: 0px;width: 0px;overflow:hidden;display: none;" type="submit" class="btn btn-primary" id="konfirm_dana_cair" >Batalkan Penarikan</a>');
                                $('#status_dana').replaceWith('<div class="alert alert-info text-center" id="status_dana" role="alert">Sedang dalam Proses</div>');
                                
                            }
                            else if ( data.status == 5) {
                                $('#konfirm_dana_cair').replaceWith('<a type="hidden" href="#" style="height: 0px;width: 0px;overflow:hidden;display: none;" type="submit" class="btn btn-primary" id="konfirm_dana_cair" >Batalkan Penarikan</a>');
                                $('#status_dana').replaceWith('<div class="alert alert-danger text-center" id="status_dana" role="alert">Penarikan Dibatalkan</div>');
                                
                            }
                        });
                    }
                });
            }
            else{
                $('a[name="detailinvoicesaldo"]').empty();
            }
            
        });
    });
</script>


@endsection

@section('footer')
    
@endsection