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
                        <table id="myTable" class=" table order-list">
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
                                        <input type="text" name="item[1][paper]" class="form-control" placeholder="Nama Produk" required />
                                    </td>
                                    <td width="15%">
                                        <input type="number" name="item[1][price]" class="form-control price" required />
                                    </td>
                                    <td width="10%">
                                        <input type="number" name="item[1][per_pack]" class="form-control per_pack" required />
                                    </td>
                                    <td width="15%">
                                        <input type="number" class="subtotal form-control" readonly id="jumlah" name="jumlah" required>
                                    </td>
                                    <td width="5%">
                                        <a class="deleteRow"></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total: Rp. <label class="grandtotal"></label></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-lg btn-block " id="addrow" value="Tambah Produk" />
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
        var counter = 1;

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><input type="text" placeholder="Nama Produk" required class="form-control" id="produk" name="produk' + counter + '"/></td>';
            cols += '<td><input type="number" class="form-control item buyprice" id="kuantitas" required name="kuantitas' + counter + '"/></td>';
            cols += '<td><input type="number" class="form-control item sellprice" id="harga" required name="harga' + counter + '"/></td>';
            cols += '<td><input type="number" class="profit form-control" id="jumlah" required name="jumlah' + counter + '"/></td>';
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Hapus"></td>';
            newRow.append(cols);
            if (counter == 4) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
            $("table.order-list").append(newRow);
            counter++;
            
        });



        $("table.order-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });
        CalculateTotal();

    });

    function CalculateTotal() {
        // This will Itearate thru the subtotals and
        // claculate the grandTotal and Quantity here
        var lineTotals = $('.profit');
        var grandTotal = 0.0;
        $.each(lineTotals, function (i) {
            grandTotal += parseFloat($(lineTotals[i]).text());
        });
        $('.grandtotal').text(parseFloat(grandTotal).toFixed(2));
    }

    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('.profit').each(function () {
            grandTotal += +$(this).val();
        });
        $(".grandtotal").text(grandTotal.toFixed(2));
    }
    </script>
    <script type="text/javascript">
        $(function() {
            $("table").on("change", ".item", function () {
                var row = $(this).closest("tr");
                var sellprice = row.find('.sellprice').val();
                var buyprice = row.find('.buyprice').val();

                var profit = sellprice * buyprice;
                row.find('.profit').val(profit); 
                
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
        $('.cf-table-block').on('blur', 'input', sumtotal);
        function sumtotal() {
            var hour = 0;
            var rate = 0;
            var total = 0;
            var subtotal = 0;

            $('.cf-table-block tbody tr').each(function () {
                hour =  parseNumber($(this).find('.hour input').val()); 
                rate = parseNumber($(this).find('.rate input').val());
            
                subtotal = (hour * rate);

                $(this).find('.profit').val(subtotal);
                total += subtotal;
            });
            $('.Grandtotal input').val(total);
        }
        function parseNumber(n) {
            var f = parseFloat(n); //Convert to float number.
            return isNaN(f) ? 0 : f; //treat invalid input as 0;
        }
    });
    </script>
@endsection
