@extends('jual-beli.layouts.app')
@section('title', 'Jual Beli | Beranda')
@section('sidebar')
@endsection
@section('content')


<div class="container mt-5">
    
    <!-- Simple Invoice - START -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                
                    <h2>Invoice for purchase #33221</h2>
                
                <hr>
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Billing Details</div>
                            <div class="panel-body">
                                <strong>David Peere:</strong><br>
                                1111 Army Navy Drive<br>
                                Arlington<br>
                                VA<br>
                                <strong>22 203</strong><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Payment Information</div>
                            <div class="panel-body">
                                <strong>Card Name:</strong> Visa<br>
                                <strong>Card Number:</strong> ***** 332<br>
                                <strong>Exp Date:</strong> 09/2020<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Order Preferences</div>
                            <div class="panel-body">
                                <strong>Gift:</strong> No<br>
                                <strong>Express Delivery:</strong> Yes<br>
                                <strong>Insurance:</strong> No<br>
                                <strong>Coupon:</strong> No<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                        <div class="panel panel-default height">
                            <div class="panel-heading">Shipping Address</div>
                            <div class="panel-body">
                                <strong>David Peere:</strong><br>
                                1111 Army Navy Drive<br>
                                Arlington<br>
                                VA<br>
                                <strong>22 203</strong><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="text-center"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Item Name</strong></td>
                                        <td class="text-center"><strong>Item Price</strong></td>
                                        <td class="text-center"><strong>Item Quantity</strong></td>
                                        <td class="text-right"><strong>Total</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Samsung Galaxy S5</td>
                                        <td class="text-center">$900</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$900</td>
                                    </tr>
                                    <tr>
                                        <td>Samsung Galaxy S5 Extra Battery</td>
                                        <td class="text-center">$30.00</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$30.00</td>
                                    </tr>
                                    <tr>
                                        <td>Screen protector</td>
                                        <td class="text-center">$7</td>
                                        <td class="text-center">4</td>
                                        <td class="text-right">$28</td>
                                    </tr>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"><strong>Subtotal</strong></td>
                                        <td class="highrow text-right">$958.00</td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                        <td class="emptyrow text-right">$20</td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"><strong>Total</strong></td>
                                        <td class="emptyrow text-right">$978.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
    
    .table > tbody > tr > .emptyrow {
        border-top: none;
    }
    
    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }
    
    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
    </style>
    
    <!-- Simple Invoice - END -->
    
    </div>
    
    </body>
    </html>


@endsection