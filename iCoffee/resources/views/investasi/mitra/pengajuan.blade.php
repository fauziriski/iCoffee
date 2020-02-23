@extends('investasi.mitra.layout.master')
@section('title', 'Pasang Produk | Investasi')
@section('css')
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('investasi/mitra/css/style.css')}}"/>
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
@endsection
@section('content')

<div class="wizard-v1-content mx-auto">
    <div class="wizard-form">
        <form class="form-register" id="form-register" action="#" method="post">
            <div id="form-total">
                <!-- SECTION 1 -->
                <h2>
                    <span class="step-icon"><i class="fa fa-seedling"></i></span>
                    <span class="step-number">Progress 1</span>
                    <span class="step-text">Pemupukan</span>
                </h2>
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
                                        <input type="text" name="item[1][paper]" class="regular-text form-control" />
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
                <!-- SECTION 2 -->
                <h2>
                    <span class="step-icon"><i class="fa fa-sun"></i></span>
                    <span class="step-number">Progress 2</span>
                    <span class="step-text">Penyiangan</span>
                </h2>
                <section>
                    <div class="inner">
                        <div class="form-row">
                            <div class="form-holder form-holder-2">
                                <label for="card-type">Card Type</label>
                                <select name="card-type" id="card-type" class="form-control">
                                    <option value="" disabled selected>Select Credit Card Type</option>
                                    <option value="Business Credit Cards">Business Credit Cards</option>
                                    <option value="Limited Purpose Cards">Limited Purpose Cards</option>
                                    <option value="Prepaid Cards">Prepaid Cards</option>
                                    <option value="Charge Cards">Charge Cards</option>
                                    <option value="Student Credit Cards">Student Credit Cards</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-holder form-holder-3">
                                <label for="card-number">Card Number</label>
                                <input type="text" name="card-number" class="card-number" id="card-number" placeholder="ex: 489050625008xxxx">
                            </div>
                            <div class="form-holder">
                                <label for="cvc">CVC</label>
                                <input type="text" name="cvc" class="cvc" id="cvc" placeholder="xxx">
                            </div>
                        </div>
                        <div class="form-row form-row-2">
                            <div class="form-holder">
                                <label for="month">Expiry Month</label>
                                <select name="month" id="month" class="form-control">
                                    <option value="" disabled selected>Expiry Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="February">February</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                </select>
                            </div>
                            <div class="form-holder">
                                <label for="year">Expiry Year</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="" disabled selected>Expiry Year</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECTION 3 -->
                <h2>
                    <span class="step-icon"><i class="fa fa-leaf"></i></span>
                    <span class="step-number">Progress 3</span>
                    <span class="step-text">Panen</span>
                </h2>
                <section>
                    <div class="inner">
                        <h3>Comfirm Details</h3>
                        <div class="form-row table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="space-row">
                                        <th>Username:</th>
                                        <td id="username-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Email Address:</th>
                                        <td id="email-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Card Type:</th>
                                        <td id="card-type-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Card Number:</th>
                                        <td id="card-number-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>CVC:</th>
                                        <td id="cvc-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Expiry Month:</th>
                                        <td id="month-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Expiry Year:</th>
                                        <td id="year-val"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                <h2>
                    <span class="step-icon"><i class="fa fa-coffee"></i></span>
                    <span class="step-number">Progress 4</span>
                    <span class="step-text">Pasca Panen</span>
                </h2>
                <section>
                    <div class="inner">
                        <h3>Comfirm Details</h3>
                        <div class="form-row table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr class="space-row">
                                        <th>Username:</th>
                                        <td id="username-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Email Address:</th>
                                        <td id="email-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Card Type:</th>
                                        <td id="card-type-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Card Number:</th>
                                        <td id="card-number-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>CVC:</th>
                                        <td id="cvc-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Expiry Month:</th>
                                        <td id="month-val"></td>
                                    </tr>
                                    <tr class="space-row">
                                        <th>Expiry Year:</th>
                                        <td id="year-val"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <button style="float:right; margin-top:10px;" type="submit" class="btn btn-info">Simpan</button>
        </form>
    </div>
</div><!-- tutup side -->
</div>
</section>
@endsection
@section('js')
    <script src="{{asset('investasi/mitra/js/jquery.steps.js')}}"></script>
    <script src="{{asset('investasi/mitra/js/demo/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
          $counter = 1;
          $('#buttonadd').click(function () {
              $counter++;
              $('#invoiceitems > tbody:last').append('<tr><td><input type="text" name="item[' + $counter + '][paper]" class="regular-text form-control" /></td>\
              <td><input type="text" name="item[' + $counter + '][price]" class="price form-control" /></td>\
              <td><input type="text" name="item[' + $counter + '][quantity]" class="quantity form-control"/></td>\
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
