@extends('investasi.mitra.layout.master')
@section('title', 'Pengajuan Dana | Investasi')
@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('investasi/mitra/css/style.css')}}"/>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
@endsection
@section('content')

<div class="wizard-v1-content mx-auto">
    <div class="wizard-form">
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fa fa-seedling"></i> &nbsp;Pemupukan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fa fa-leaf"></i> &nbsp;Penyiangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fa fa-coffee"></i> &nbsp;Panen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-pasca-tab" data-toggle="pill" href="#pills-pasca" role="tab" aria-controls="pills-pasca" aria-selected="false"><i class="fa fa-sun"></i> &nbsp;Pasca Panen</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                {{-- Pengajuan Dana ke-1 --}}
                <br>
                @if(empty($status1))
                    <form class="form-register" id="form-register" action="\mitra/pengajuan-dana-1" method="post">
                        @csrf
                        <div id="form-total">
                            <!-- SECTION 1 -->
                            <div class="content clearfix">
                            <section>
                                <div class="inner">
                                    <table id="invoiceitems" class=" table order-list">
                                        <thead>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Qty</td>
                                                <td>Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="product">
                                                <td width="50%">
                                                    <input type="text" name="item[1][produk]" class="regular-text form-control" required/>
                                                </td>
                                                <td width="15%">
                                                    <input type="number" min="1" name="item[1][price]" class="price form-control" required />
                                                </td>
                                                <td width="10%">
                                                    <input type="number" min="1" name="item[1][quantity]" class="quantity form-control" required />
                                                </td>
                                                <td width="15%">
                                                    Rp. <span class="subtotal"></span>
                                                </td>
                                                <td width="5%">
                                                    <a class="deleteRow"></a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Total:</td>
                                                <td>
                                                    Rp. <span class="grandtotal"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block " id="buttonadd" value="Tambah Produk" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </section>
                            <input type="hidden" name="item[1][kode_produk]" value="{{$id}}" />
                            <button style="float:right; margin-top:10px;" type="submit" class="btn btn-info">Simpan</button>
                    </form>
                </div></div></div>
                @elseif( $status1 == '1')
                    <img src="\pengajuan-sedang.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @elseif ($status1 == '2')
                    <img src="\pengajuan-sudah.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @endif
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                {{-- Pengajuan Dana ke-2 --}}
                <br>
                @if(empty($status2))
                    @if( $status1 == '2'))
                        <form class="form-register" id="form-register" action="\mitra/pengajuan-dana-2" method="post">
                        @csrf
                        <div id="form-total">
                            <!-- SECTION 1 -->
                            <div class="content clearfix">
                            <section>
                                <div class="inner">
                                    <table id="invoiceitems" class=" table order-list">
                                        <thead>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Qty</td>
                                                <td>Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="product">
                                                <td width="50%">
                                                    <input type="text" name="item[1][produk]" class="regular-text form-control" />
                                                </td>
                                                <td width="15%">
                                                    <input type="text" name="item[1][price]" class="price form-control" />
                                                </td>
                                                <td width="10%">
                                                    <input type="text" name="item[1][quantity]" class="quantity form-control" />
                                                </td>
                                                <td width="15%">
                                                    Rp. <span class="subtotal"></span>
                                                </td>
                                                <td width="5%">
                                                    <a class="deleteRow"></a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Total:</td>
                                                <td>
                                                    Rp. <span class="grandtotal"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block " id="buttonadd" value="Tambah Produk" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </section>
                            <input type="hidden" name="item[1][kode_produk]" value="{{$id}}" />
                            <button style="float:right; margin-top:10px;" type="submit" class="btn btn-info">Simpan</button>
                        </form>
                        </div></div></div>
                    @else
                        <img src="\pengajuan-belum.png" width="100%" height="100%" style="border-radius: 10px;">
                        </div>
                    @endif
                @elseif( $status2 == '1')
                    <img src="\pengajuan-sedang.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @elseif ($status2 == '2')
                    <img src="\pengajuan-sudah.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @endif
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                {{-- Pengajuan Dana ke-3 --}}
                <br>
                @if(empty($status3))
                    @if($status2 == '2'))
                        <form class="form-register" id="form-register" action="\mitra/pengajuan-dana-3" method="post">
                        @csrf
                        <div id="form-total">
                            <!-- SECTION 1 -->
                            <div class="content clearfix">
                            <section>
                                <div class="inner">
                                    <table id="invoiceitems" class=" table order-list">
                                        <thead>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Qty</td>
                                                <td>Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="product">
                                                <td width="50%">
                                                    <input type="text" name="item[1][produk]" class="regular-text form-control" />
                                                </td>
                                                <td width="15%">
                                                    <input type="text" name="item[1][price]" class="price form-control" />
                                                </td>
                                                <td width="10%">
                                                    <input type="text" name="item[1][quantity]" class="quantity form-control" />
                                                </td>
                                                <td width="15%">
                                                    Rp. <span class="subtotal"></span>
                                                </td>
                                                <td width="5%">
                                                    <a class="deleteRow"></a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Total:</td>
                                                <td>
                                                    Rp. <span class="grandtotal"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block " id="buttonadd" value="Tambah Produk" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </section>
                            <input type="hidden" name="item[1][kode_produk]" value="{{$id}}" />
                            <button style="float:right; margin-top:10px;" type="submit" class="btn btn-info">Simpan</button>
                        </form>
                        </div></div></div>
                    @else
                        <img src="\pengajuan-belum.png" width="100%" height="100%" style="border-radius: 10px;">
                        </div>
                    @endif
                @elseif( $status3 == '1')
                    <img src="\pengajuan-sedang.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @elseif ($status3 == '2')
                    <img src="\pengajuan-sudah.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @endif
            <div class="tab-pane fade" id="pills-pasca" role="tabpanel" aria-labelledby="pills-pasca-tab">
                {{-- Pengajuan Dana ke-4 --}}
                <br>
                @if(empty($status4))
                    @if( $status3 == '2')
                        <form class="form-register" id="form-register" action="\mitra/pengajuan-dana-4" method="post">
                        @csrf
                        <div id="form-total">
                            <!-- SECTION 1 -->
                            <div class="content clearfix">
                            <section>
                                <div class="inner">
                                    <table id="invoiceitems" class=" table order-list">
                                        <thead>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td>Harga</td>
                                                <td>Qty</td>
                                                <td>Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="product">
                                                <td width="50%">
                                                    <input type="text" name="item[1][produk]" class="regular-text form-control" />
                                                </td>
                                                <td width="15%">
                                                    <input type="text" name="item[1][price]" class="price form-control" />
                                                </td>
                                                <td width="10%">
                                                    <input type="text" name="item[1][quantity]" class="quantity form-control" />
                                                </td>
                                                <td width="15%">
                                                    Rp. <span class="subtotal"></span>
                                                </td>
                                                <td width="5%">
                                                    <a class="deleteRow"></a>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>Total:</td>
                                                <td>
                                                    Rp. <span class="grandtotal"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="text-align: left;">
                                                    <input type="button" class="btn btn-lg btn-block " id="buttonadd" value="Tambah Produk" />
                                                </td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    
                                </div>
                            </section>
                            <input type="hidden" name="item[1][kode_produk]" value="{{$id}}" />
                            <button style="float:right; margin-top:10px;" type="submit" class="btn btn-info">Simpan</button>
                        </form>
                        </div></div></div>
                    @else
                        <img src="\pengajuan-belum.png" width="100%" height="100%" style="border-radius: 10px;">
                        </div>
                    @endif
                @elseif( $status4 == '1')
                    <img src="\pengajuan-sedang.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @elseif ($status4 == '2')
                    <img src="\pengajuan-sudah.png" width="100%" height="100%" style="border-radius: 10px;">
                    </div>
                @endif
</div>
</div><!-- tutup side -->
</div>
</section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
          $counter = 1;
          $('#buttonadd').click(function () {
              $counter++;
              $('#invoiceitems > tbody:last').append('<tr><td><input type="text" name="item[' + $counter + '][produk]" class="regular-text form-control" required /></td>\
              <td><input type="number" name="item[' + $counter + '][price]" class="price form-control" min="1" required /></td>\
              <td><input type="number" name="item[' + $counter + '][quantity]" class="quantity form-control" min="1" required /></td>\
              <td>Rp. <span class="subtotal"></span> </td>\
              <td><input type="button" class="buttondelete btn btn-md btn-danger "  value="Hapus"></td></tr>');
      
          });
          $('table#invoiceitems').on('keyup', '.quantity , .price',function () {
              UpdateTotals(this);
          });
      
          $counter = 1;
             $('table#invoiceitems').on('click','.buttondelete',function () {
              $counter++;
              if($('table#invoiceitems tbody tr').length==1){
                  alert('Cant delete single row');
                  return false;
              }
              $(this).closest('tr').remove();
          });
          CalculateSubTotals();
          CalculateTotal();
      });
      
      
      function UpdateTotals(elem) {
          // This will give the tr of the Element Which was changed
          var $container = $(elem).parent().parent();
          var quantity = $container.find('.quantity').val();
          var price = $container.find('.price').val();
          var subtotal = parseInt(quantity) * parseFloat(price);
          $container.find('.subtotal').text(subtotal.toFixed(2));
          CalculateTotal();
      }
      
      function CalculateSubTotals() {
          // Calculate the Subtotals when page loads for the 
          // first time
          var lineTotals = $('.subtotal');
          var quantity = $('.quantity');
          var price = $('.price');
          $.each(lineTotals, function (i) {
              var tot = parseInt($(quantity[i]).val()) * parseFloat($(price[i]).val());
              $(lineTotals[i]).text(tot.toFixed(2));
          });
      }
      
      function CalculateTotal() {
          // This will Itearate thru the subtotals and
          // claculate the grandTotal and Quantity here
          var lineTotals = $('.subtotal');
          var quantityTotal = $('.quantity');
          var grandTotal = 0.0;
          var totalQuantity = 0;
          $.each(lineTotals, function (i) {
              grandTotal += parseFloat($(lineTotals[i]).text());
              totalQuantity += parseInt($(quantityTotal[i]).val())
          });
          $('.totalquantity').text(totalQuantity);
          $('.grandtotal').text(parseFloat(grandTotal).toFixed(2));
      }
      </script>
@endsection
