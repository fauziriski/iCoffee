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
           <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Jual</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-topup" role="tab" aria-controls="pills-profile" aria-selected="false">Top Up</a>
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
                                        <p>Checkout berhasil pada tanggal, 07 Desember 2019, 18:13 WIB</p>
                                        <div class="form-group">
                                            <label for="total_pembayaran" class="col-form-label">Nama Produk</label>
                                            <input type="text" class="form-control" id="total_pembayaran" name="total_pembayaran" readonly>
                                          </div>
                    
                                          <div class="form-group">
                                            <label for="kategori_kopi_edit" class="col-form-label">Kategori Kopi</label>
                                              <select name="kategori_kopi_edit" required id="kategori_kopi_edit" class="form-control">
                                                <option value="" id="select_kategori_kopi_edit"></option>
                                          
                                                <option value=""></option>
                       
                    
                                              </select>
                                          </div>
                    
                                          <div class="form-group">
                                            <label for="harga_edit" class="col-form-label">Harga</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" class="form-control" id="harga_edit" name="harga_edit">
                                            </div>
                                          </div>
                        
                                          <div class="form-group">
                                            <label for="stok_edit" class="col-form-label">Stok</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="stok_edit" name="stok_edit">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Kg</div>
                                                </div>
                                            </div>
                                          </div>
                    
                                          <div class="form-group">
                                            <label for="desc_produk_edit" class="col-form-label">Deskripsi</label>
                                            <div class="input-group">
                                                <textarea class="form-control" rows="5" type="text" id="desc_produk_edit" name="desc_produk_edit"></textarea>
                                            </div>
                                          </div>
                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="ubahalamat">Edit Produk</button>
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

<script>
    $(document).ready(function() {

        $('a[name="edit_produk"]').on('click', function() {
            var href = $(this).attr('value');      
            if(href) {
                $.ajax({
                    url: '/jual-beli/produk/edit/'+encodeURI(href),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
         
                        $.each(data, function(key, value) {
                            $('#produk_id').replaceWith('<input type="hidden" id="produk_id" name="produk_id" required value="'+ data.produk.id +'">');
                            $('#nama_produk_edit').replaceWith('<input type="text" class="form-control" id="nama_produk_edit" name="nama_produk_edit" value="'+ data.produk.nama_produk+'" reuired>');
                            $('#harga_edit').replaceWith('<input type="number" class="form-control" id="harga_edit" name="harga_edit" value="'+ data.produk.harga+'" reuired>');
                            $('#select_kategori_kopi_edit').replaceWith('<option value="'+ data.produk.id_kategori +'" selected>'+ data.kategori +'</option>');
                            $('#stok_edit').replaceWith('<input type="number" class="form-control" id="stok_edit" name="stok_edit" value="'+ data.produk.stok+'" reuired>');
                            $('#desc_produk_edit').replaceWith('<textarea class="form-control" rows="5" type="text" id="desc_produk_edit" name="desc_produk_edit">'+ data.produk.detail_produk +'</textarea>');
                        });

                    }
                })
            }
            else{
                $('a[name="edit_produk"]').empty();
            }
        });
    });
</script>


@endsection