@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
    <div class="card">
   
      <article class="card-group-item">
       <header class="card-header">
         <ul class="nav nav-pills" id="pills-tab" role="tablist">
         <li class="nav-item">
           <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Beli</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Jual 
            @if ( !empty($count_order['count_order_produk']))
            <div class="badge badge-pill badge-danger">{{ $count_order['count_order_produk'] }}</div>
            @endif 
        </a>  

         </li>
         <li class="nav-item">
            <a class="nav-link" id="pills-topup-tab" data-toggle="pill" href="#pills-topup" role="tab" aria-controls="pills-topup" aria-selected="false">Top Up</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="pills-cair-tab" data-toggle="pill" href="#pills-cair" role="tab" aria-controls="pills-cair" aria-selected="false">Penarikan Saldo</a>
          </li>
       </ul>
       </header>


       <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="col" style="border-radius: 400px;">
            @for ($i = 0; $i < $hitung_invoice; $i++)

                <div class="row mt-3">
                    <div class="col">
                        <p>Tanggal : <strong>{{ $tanggal[$i] }}</strong></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <p>Invoice : <strong style="color:#ee4d2c">{{ $invoice[$i] }}</strong></p>
                    </div>
                    <div class="col">
                        <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($cek_data[$i]) }}</strong></p>
                    </div>
                    <div class="col">
                        <a href="/jual-beli/invoice/{{ $invoice[$i] }}"><span class="oi oi-eye"></span>&nbsp; Detail Pesanan </a>
                    </div>
                </div>
                <hr>
        
                @endfor
            </div>

        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="container" style="border-radius: 400px;">
                @for ($i = 0; $i < $jumlah_transaksi_penjual; $i++)
                    
                    <div class="row mt-3">
                        <div class="col">
                            <p>Tanggal : <strong>{{ $transaksipenjual[$i]->updated_at }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <p>Invoice : <strong style="color:#ee4d2c">{{ $transaksipenjual[$i]->invoice }}</strong></p>
                        </div>
                        <div class="col">
                            <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($total_bayar[$i]) }}</strong></p>
                        </div>
                        <div class="col">
                            <a href="/jual-beli/invoice_penjual/{{ $transaksipenjual[$i]->invoice }}"><span class="oi oi-eye"></span>&nbsp; Detail Pesanan </a>
                        </div>
                    </div>
                    <hr>
            
                    @endfor
                </div>
        </div>

        <div class="tab-pane fade" id="pills-cair" role="tabpanel" aria-labelledby="pills-cair-tab">
            <div class="container" style="border-radius: 400px;">
                @foreach ($transaksi_penarikan as $data)
                    
                    <div class="row mt-3">
                        <div class="col">
                            <p>Tanggal : <strong>{{ $data->updated_at }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <p>Invoice : <strong style="color:#ee4d2c">{{ $data->invoice }}</strong></p>
                        </div>
                        <div class="col">
                            <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($data->jumlah) }}</strong></p>
                        </div>
                        <div class="col">
                            <a href="" data-toggle="modal" data-target="#saldoModal" name="detailinvoicesaldo" value="{{ $data->invoice }}" target="_blank" data-whatever="@mdo"><span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan </a>
                        </div>
                    </div>
                    <hr>

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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                {{-- <a href="" class="btn btn-primary" style="color: #fff;height: 0px;width: 0px;overflow:hidden;" id="konfirm" >Selesai</a> --}}
                                
                            </div>
                         </div>
                        
                        </div>
                    </div>
            
                    
                </div>
                @endforeach
        </div>

        <div class="tab-pane fade" id="pills-topup" role="tabpanel" aria-labelledby="pills-topup-tab">
            <div class="container" style="border-radius: 400px;">
                @for ($i = 0; $i < $count_transaksi_top_up; $i++)
                    
                    <div class="row mt-3">
                        <div class="col">
                            <p>Tanggal : <strong>{{ $transaksi_top_up[$i]->updated_at }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <p>Invoice : <strong style="color:#ee4d2c">{{ $transaksi_top_up[$i]->invoice }}</strong></p>
                        </div>
                        <div class="col">
                            <p>Pembayaran : <strong style="color:#ee4d2c">Rp {{ number_format($transaksi_top_up[$i]->jumlah) }}</strong></p>
                        </div>
                        <div class="col">
                            <a href="" data-toggle="modal" data-target="#exampleModal" name="detailinvoice" value="{{ $transaksi_top_up[$i]->invoice }}" target="_blank" data-whatever="@mdo"><span class="oi oi-eye align-middle"></span>&nbsp; Detail Pesanan </a>
                        </div>
                    </div>
                    <hr>

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
                                    <div class="alert alert-warning text-center" id="status" role="alert">
                                    
                                    </div>
                                    </div>
                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="" class="btn btn-primary" style="color: #fff;height: 0px;width: 0px;overflow:hidden;" id="konfirm" >Selesai</a>
                                
                            </div>
                         </div>
                        
                        </div>
                    </div>
            
                    @endfor
                </div>
        </div>
    </div>
    </article> 
    </div>
</div><!-- tutup side -->

</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script>
    $(document).ready(function() {

        $('a[name="detailinvoice"]').on('click', function() {
            var href = $(this).attr('value');      
            if(href) {
                $.ajax({
                    url: '/profil/top_up/detailinvoice/'+encodeURI(href),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
         
                        $.each(data, function(key, value) {
                            
                            $('#tanggal').replaceWith('<p class="tanggal" id="tanggal">Checkout berhasil pada tanggal, '+ data.invoice.created_at+' WIB</p>');
                            $('#invoice').replaceWith('<input type="text" class="form-control" id="invoice" value="'+ data.invoice.invoice +'" name="invoice" readonly>');
                            $('#email').replaceWith('<input type="email" class="form-control" id="email"  value="'+ data.invoice.email +'" name="email" readonly>');
                            $('#harga_edit').replaceWith('<input type="number" class="form-control" id="harga_edit" value="'+ data.invoice.jumlah.toLocaleString("id-ID") +'" name="harga_edit" readonly>');
                            $('#payment').replaceWith('<input type="text" class="form-control" value="'+ '(' + data.invoice.payment + ') '+ data.bank.no_rekening +'" id="payment"  name="payment" readonly>');
                            if ( data.invoice.status == 1) 
                            {
                                $('#status').replaceWith('<div class="alert alert-warning text-center" id="status" role="alert">Menunggu Pembayaran</div>');
                                $('#konfirm').replaceWith('<a href="/profil/konfirmasi/top_up" class="btn btn-primary" style="color: #fff;" id="konfirm" >Konfirmasi Pembayaran</a>');
                                
                            }
                            else if( data.invoice.status == 2) 
                            {
                                $('#status').replaceWith('<div class="alert alert-danger text-center" id="status" role="alert">Konfirmasi Pembayaran Ditolak</div>');
                                $('#konfirm').replaceWith('<a href="/profil/konfirmasi/top_up" class="btn btn-primary" style="color: #fff;" id="konfirm" >Konfirmasi Pembayaran</a>');
                            }else if ( data.invoice.status == 3)
                            {
                                $('#status').replaceWith('<div class="alert alert-success text-center" id="status" role="alert">Konfirmasi Pembayaran Diterima</div>');
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
                            $('#invoice_dana').replaceWith('<strong><td class="align-middle" id="invoice_dana">'+ data.invoice +'</td></strong>');
                            $('#pemilik_rekening_dana').replaceWith('<strong><td class="text-md-center" id="pemilik_rekening_dana">'+ data.pemilik_rekening +'</td></strong>');
                            $('#bank_dana').replaceWith('<strong><td id="bank_dana">'+ data.bank +'</td></strong>');
                            $('#email_dana').replaceWith('<strong><td id="email_dana">'+ data.email +'</td></strong>');
                            $('#no_rek_dana').replaceWith('<strong><td class="align-middle" id="no_rek_dana">'+ data.no_rekening +'</td></strong>');
                            $('#jumlah_dana').replaceWith('<strong><td id="pemilik_rekening_dana">Rp '+ data.jumlah.toLocaleString("id-ID") +'</td></strong>');

                            if ( data.status == 1) 
                            {
                                $('#status_dana').replaceWith('<div class="alert alert-info text-center" id="status_dana" role="alert">Menunggu Konfirmasi Admin</div>');
                                
                            }
                            else if ( data.status == 2) 
                            {
                                $('#status_dana').replaceWith('<div class="alert alert-danger text-center" id="status_dana" role="alert">Gagal Mencairkan Dana</div>');
                                
                            }
                            else if ( data.status == 3) 
                            {
                                $('#status_dana').replaceWith('<div class="alert alert-success text-center" id="status_dana" role="alert">Dana Berhasil Dicairkan</div>');
                                
                            }
                            else if ( data.status == 4) 
                            {
                                $('#status_dana').replaceWith('<div class="alert alert-info text-center" id="status_dana" role="alert">Sedang dalam Proses</div>');
                                
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