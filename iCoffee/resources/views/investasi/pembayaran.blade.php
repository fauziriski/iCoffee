<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pembayaran | Investasi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
  
  <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{asset('investasi/css/open-iconic-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/animate.css') }}">
  
  <link rel="stylesheet" href="{{asset('investasi/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/magnific-popup.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/aos.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/ionicons.min.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/jquery.timepicker.css') }}">

  <link rel="stylesheet" href="{{asset('investasi/css/images.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/flaticon.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/icomoon.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/style.css') }}">
  <link rel="stylesheet" href="{{asset('investasi/css/gambar.less')}}">
  <style>
    @import url("https://fonts.googleapis.com/css?family=Work+Sans");
    body {
    font-family: "Work Sans", sans-serif;
    }

    .card {
    background: #ffffff;
    border-radius: 10px;
    max-width: 300px;
    display: block;
    margin: auto;
    padding: 20px;
    padding-left: 20px;
    padding-right: 20px;
    box-shadow: 2px 10px 40px #1cc98a;
    z-index: 99;
    max-height: 150px;
    }

    .logo-card {
    max-width: 50px;
    margin-bottom: 15px;
    margin-top: -19px;
    float: right;
    }

    label {
    display: flex;
    font-size: 10px;
    color: black;
    opacity: 0.8;
    }
    
    p{
      margin-bottom: 0px;
    }

    .cardnumber {
    display: block;
    font-size: 20px;
    }

    .pay-btn {
      border:none;
      background:#fff;
      line-height:2em;
      border-radius:10px;
      font-size:19px;
      font-size:1.2rem;
      color:#22a877;
      cursor:pointer;
      position:absolute;
      float:right;
      bottom:25px;
      width:calc(100% - 50px);
      -webkit-transition:all .2s ease;
              transition:all .2s ease;
    }
    .pay-btn:hover {
      background:#00ff8c;
        color:#eee;
      -webkit-transition:all .2s ease;
              transition:all .2s ease;
    }
    .name {
    display: block;
    font-size: 15px;
    max-width: 200px;
    float: left;
    margin-bottom: 15px;
    }

    .toleft {
    float: left;
    }
    .ccv {
    width: 50px;
    margin-top: -5px;
    font-size: 15px;
    }

    .receipt {
    background: #1cc98a;
    border-radius: 20px;
    padding: 5%;
    padding-top: 130px;
    max-width: 600px;
    display: block;
    margin: auto;
    margin-top: -90px;
    z-index: -999;
    position: relative;
    }

    .col {
    width: 100%;
    float: left;
    color: #ffffff;
    }

    .col .kanan{
      text-align: right;
      color: white;
    }
    .putih{
      color: white;
    }
    .bought-item {
    background: #ffffff;
    padding: 2px;
    }
    .bought-items {
    margin-top: -3px;
    color: #ffffff;
    }

    .cost {
    color: #ffffff;
    }
    .seller {
    color: #ffffff;
    }
    .description {
    font-size: 13px;
    }
    .price {
    font-size: 12px;
    }
    .comprobe {
    text-align: center;
    color: #ffffff;
    }
    h3{
      text-align: center;
      color: white;
    }
    .proceed {
    position: absolute;
    transform: translate(300px, 10px);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #1abc9c;
    border: none;
    color: white;
    transition: box-shadow 0.2s, transform 0.4s;
    cursor: pointer;
    }
    .proceed:active {
    outline: none;
    }
    hr.new1 {
      border-top: 1px solid white;
    }
    .proceed:focus {
    outline: none;
    box-shadow: inset 0px 0px 5px white;
    }
    .sendicon {
    filter: invert(100%);
    padding-top: 2px;
    }

    @media (max-width: 600px) {
    .proceed {
        transform: translate(250px, 10px);
    }
    .col {
        display: block;
        margin: auto;
        width: 100%;
        text-align: center;
    }
    }
    </style>
</head>
@section('header')
@include('investasi.layouts.header')
@show
@include('sweetalert::alert')
<br><br>
    
<div class="container">
    <div class="card">
      @if ($bank->id == 1)
        <label>Nomor Rekening:</label>
        <img src="\bca.svg" class="logo-card">
        <p>{{$bank->no_rekening}}</p>
        <label>Atas Nama:</label>
        <p>iCoffee</p>
      @elseif($bank->id == 2)
        <label>Nomor Rekening:</label>
        <img src="\bri.png" class="logo-card">
        <p>{{$bank->no_rekening}}</p>
        <label>Atas Nama:</label>
        <p>iCoffee</p>
      @elseif($bank->id == 3)
        <label>Nomor Rekening:</label>
        <img src="\bni.png" class="logo-card">
        <p>{{$bank->no_rekening}}</p>
        <label>Atas Nama:</label>
        <p>iCoffee</p>
      @elseif($bank->id == 4)
        <label>Nomor Rekening:</label>
        <img src="\mandiri.svg" class="logo-card">
        <p>{{$bank->no_rekening}}</p>
        <label>Atas Nama:</label>
        <p>iCoffee</p>
      @endif
      
    </div>
    <div class="receipt">
      <h3>Terima Kasih!</h3>
      <hr class="new1">
      <p class="putih">Selamat! Anda telas sukses membeli produk Investasi dibawah ini.</p>
      <div class="col">
        <p>Nama Produk: </p>
        {{$produk->nama_produk}}
        <br>
        <p>Kuantitas: {{$qty}} Unit</p>
        <p>Harga: @money($produk->harga)</p>
        <p>Kontrak: {{$produk->periode}} Tahun</p>
        <p>Total: @money($produk->harga*$qty)</p>
      </div>
      <p class="putih">Silahkan lakukan pembayaran ke rekening iCoffee yang tertera diatas.</p>
      <a class="btn btn-primary" href="invest/konfirmasi" role="button">Konfirmasi Pembayaran</a>
    </div>
  </div>
@section('footer')
@include('investasi.layouts.footer')
@show

<script src="{{asset('investasi/js/jquery.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('investasi/js/popper.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('investasi/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('investasi/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('investasi/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('investasi/js/aos.js')}}"></script>
<script src="{{asset('investasi/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('investasi/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('investasi/js/scrollax.min.js')}}"></script>
<script src="{{asset('investasi/js/images.js')}}"></script>
<script src="{{asset('investasi/js/google-map.js')}}"></script>
<script src="{{asset('investasi/js/main.js')}}"></script>
<script src="{{asset('js/google-map.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.2.0/less.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>


</body>
</html>