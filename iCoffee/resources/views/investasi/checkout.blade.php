@extends('investasi.layouts.app')
@section('title', 'Biayai Produk Investasi')
@section('css')
<style>
  body,html {
    height:100%;
    margin:0;
    font-family:lato;
  }
  .kontainer {
    -ms-flex-pack:center;
    justify-content:center;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
  
  }
  h2 {
    margin-bottom:0px;
    margin-top:25px;
    font-weight:200;
    font-size:19px;
    font-size:1.2rem;
    
  }
  div.desc {
    max-width: 500px;
    min-width: 100px;
  }
  .dropdown-select.visible {
    display:block;
  }
  .dropdown {
    position:relative;
  }
  ul {
    margin:0;
    padding:0;
  }
  ul li {
    list-style:none;
    cursor:pointer;
  }
  ul li:hover {
    background:rgba(255,255,255,0.1);
  }
  .dropdown-select {
    position:absolute;
    background:#1cc98a;
    text-align:left;
    box-shadow:0px 3px 5px 0px rgba(0,0,0,0.1);
    border-bottom-right-radius:5px;
    border-bottom-left-radius:5px;
    width:90%;
    left:2px;
    line-height:2em;
    margin-top:2px;
    box-sizing:border-box;
  }
  .thin {
    font-weight:400;
  }
  .small {
    font-size:12px;
    font-size:.8rem;
  }
  .half-input-table {
    border-collapse:collapse;
    width:100%;
  }
  .half-input-table td:first-of-type {
    border-right:10px solid #1cc98a;
    width:50%;
  }
  .window {
    height:540px;
    width:800px;
    background:#fff;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
    border-radius:30px;
    z-index:10;
  }
  .order-info {
    height:100%;
    width:50%;
    padding-left:25px;
    padding-right:25px;
    box-sizing:border-box;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
        -ms-flex-pack:center;
            justify-content:center;
    position:relative;
  }
  .price {
    bottom:0px;
    position:absolute;
    right:0px;
    color:#1cc98a;
  }
  .order-table td:first-of-type {
    width:25%;
  }
  .order-table {
      position:relative;
  }
  .line {
    height:1px;
    width:100%;
    margin-top:10px;
    margin-bottom:10px;
    background:#ddd;
  }
  .order-table td:last-of-type {
    vertical-align:top;
    padding-left:25px;
  }
  .order-info-content {
    table-layout:fixed;

  }

  .full-width {
    width:100%;
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
    /* position:absolute; */
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

  .total {
    margin-top:25px;
    font-size:20px;
    font-size:1.3rem;
    position:absolute;
    bottom:30px;
    right:27px;
    left:35px;
  }
  .dense {
    line-height:1.2em;
    font-size:16px;
    font-size:1rem;
  }
  .input-field {
    background:rgba(255,255,255,0.1);
    margin-bottom:10px;
    margin-top:3px;
    line-height:1.5em;
    font-size:20px;
    font-size:1.3rem;
    border:none;
    padding:5px 10px 5px 10px;
    color:#fff;
    box-sizing:border-box;
    width:100%;
    margin-left:auto;
    margin-right:auto;
  }
  .credit-info {
    background:#1cc98a;
    height:100%;
    width:50%;
    color:#eee;
    -webkit-box-pack:center;
    -webkit-justify-content:center;
        -ms-flex-pack:center;
            justify-content:center;
    font-size:14px;
    font-size:.9rem;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    box-sizing:border-box;
    padding-left:25px;
    padding-right:25px;
    border-top-right-radius:30px;
    border-bottom-right-radius:30px;
    position:relative;
  }
  .dropdown-btn {
    background:rgba(255,255,255,0.1);
    width:100%;
    border-radius:5px;
    text-align:center;
    line-height:1.5em;
    cursor:pointer;
    position:relative;
    -webkit-transition:background .2s ease;
            transition:background .2s ease;
  }
  .dropdown-btn:after {
    content: '\25BE';
    right:8px;
    position:absolute;
  }
  .dropdown-btn:hover {
    background:rgba(255,255,255,0.2);
    -webkit-transition:background .2s ease;
            transition:background .2s ease;
  }
  .dropdown-select {
    display:none;
  }
  .credit-card-image {
    display:block;
    max-height:80px;
    margin-left:auto;
    margin-right:auto;
    margin-top:35px;
    margin-bottom:15px;
  }
  .credit-info-content {
    margin-top:25px;
    -webkit-flex-flow:column;
        -ms-flex-flow:column;
            flex-flow:column;
    display:-webkit-box;
    display:-webkit-flex;
    display:-ms-flexbox;
    display:flex;
    width:100%;
  }
  @media (max-width: 800px) {
    .window {
      width: 100%;
      height: 100%;
      display:block;
      border-radius:0px;
    }
    .order-info {
      width:100%;
      height:auto;
      padding-bottom:100px;
      border-radius:0px;
    }
    .credit-info {
      width:100%;
      height:auto;
      padding-bottom:100px;
      border-radius:0px;
    }
    .pay-btn {
      border-radius:10px;
    }
  }
  .chartist-tooltip {
    opacity: 0;
    position: absolute;
    margin: 20px 0 0 10px;
    background: rgba(0, 0, 0, 0.8);
    color: #FFF;
    padding: 5px 10px;
    border-radius: 4px;
  }

  .chartist-tooltip.tooltip-show {
    opacity: 1;
  }
</style>	
@endsection
@section('sidebar')
@endsection
@section('content')
<section class="ftco-section">
	<div class='kontainer'>
		<div class='window ftco-animate'>
		  <div class='order-info'>
			<div class='order-info-content'>
			  <h2>Produk Investasi</h2>
				<div class='line'></div>
					<table class='order-table'>
						<tbody>
						<tr>
              <td><img src="{{ asset('Uploads/Investasi/Produk/'.$produk->kode_produk.'/'.$produk->gambar) }}" style="border-radius: 40%" class='full-width'>
							</td>
							<td>
							<br> <span class='thin'>{{$produk->nama_produk}}</span>
							<br> <span class='thin small'> Kontrak: {{$produk->periode}} Tahun &nbsp;&nbsp; ROI: {{$produk->roi}}%<br></span>
							<span class="thin small">Qty: {{$qty}} Unit</span>
							</td>
			
						</tr>
						<tr>
							<td>
							<div class='price'>@money($produk->harga*$qty)</div>
							</td>
						</tr>
						</tbody>
			
					</table>
          <div class='line'></div>
          <br>
          
			  
	  </div>
	  </div>
			  <div class='credit-info'>
				<div class='credit-info-content'>
				  <table class='half-input-table'>
					<tr><td>Pilih Bank Pembayaran: </td><td><div class='dropdown' id='card-dropdown'><div class='dropdown-btn' id='current-card'>Bank BNI</div>
						<div class='dropdown-select'>
						<ul>
							<li>Bank BCA</li>
							<li>Bank Mandiri</li>
							<li>Bank BRI</li>
							</ul></div>
						</div>
						</td></tr>
					</table>
					<img src='\bni.png' height='80' class='credit-card-image' id='credit-card-image'>
					<div id="norek">Nomor Rekening : 187823287 a.n. iCoffee</div>
					<form action="/invest/checkout/berhasil" method="POST">
						@csrf
						<input type="hidden" name="qty" value="{{$qty}}">
						<input type="hidden" name="total" value="{{$produk->harga*$qty}}">
						<input type="hidden" name="id_produk" value="{{$produk->id}}">
            <input type="hidden" name="id_mitra" value="{{$produk->id_mitra}}">
            <input type="hidden" name="id_bank" id="bank" value="3">
            <div class="text-justify mt-5">
              <input class="form-check-input" type="checkbox" name="snk" required>
              <label class="form-check-label" for="defaultCheck1">
                  Dengan ini saya mendaftar dan menyetujui <a href="#exampleModal" data-toggle="modal" data-target="#exampleModal"> Syarat dan Ketentuan</a> pengguna.
              </label>
              <button class='pay-btn'>Mulai Membiayai Petani</button>
            </div>
            
					</form>
				  
	  
				</div>
	  
			  </div>
			</div>
	  </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Syarat dan Ketentuan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <ul>
                    <li><p class="text-justify">⚫ Pembagian Hasil Investasi adalah: 40% Petani, 40% Investor, 20% iCoffee.</p></li>
                    <li><p class="text-justify">⚫ Jika terjadi gagal panen, maka iCoffee tidak memiliki kewajiban untuk mengembalikan dana investor.</p></li>
                    <li><p class="text-justify">⚫ Investor berhak mendapatkan pertanggungjawaban dalam bentuk progress untuk setiap produk investasi yang dibiayai.</p></li>
                    <li><p class="text-justify">⚫ Dengan menekan tombol checklist, investor dianggap menyetujui seluruh syarat & ketentuan yang berlaku.</p></li>
                  </ul>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
    @php
      $loop = $produk->periode/$produk->profit_periode;
      $profit = $produk->harga*($produk->roi/100)*$qty;
      $collection = collect([0]);
      $collect = collect([0]);
      for($i=1;$i<=$loop+1;$i++){
        $collection->push($i);
      }
      for($i=1;$i<=$loop;$i++){
        $collect->push($profit);
      }
      $collect->push(0);
    @endphp
</section>
@endsection
@section('scripts')
<script>
var cardDrop = document.getElementById('card-dropdown');
var activeDropdown;
cardDrop.addEventListener('click',function(){
  var node;
  for (var i = 0; i < this.childNodes.length-1; i++)
    node = this.childNodes[i];
    if (node.className === 'dropdown-select') {
      node.classList.add('visible');
       activeDropdown = node; 
    };
})

window.onclick = function(e) {
  console.log(e.target.tagName)
  console.log('dropdown');
  console.log(activeDropdown)
  if (e.target.tagName === 'LI' && activeDropdown){
    if (e.target.innerHTML === 'Bank BCA') {
      document.getElementById('credit-card-image').src = '/bca.svg';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank BCA';
      document.getElementById('bank').value = 1;
      document.getElementById('norek').innerHTML = 
      "1. Masukkan Kartu Anda. <br/>" +
      "2. Pilih Bahasa. <br/>" +
      "3. Masukkan PIN ATM Anda. <br/>" +
      "4. Pilih 'Menu Lainnya'. <br/>" +
      "5. Pilih 'Transfer'. <br/>" +
      "6. Pilih Jenis rekening yang akan Anda gunakan (Contoh: 'Dari Rekening Tabungan'). <br/>";
      }
    else if (e.target.innerHTML === 'Bank Mandiri') {
         document.getElementById('credit-card-image').src = '/mandiri.svg';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank Mandiri';
	    document.getElementById('norek').innerHTML = 'Bank Mandiri';
      document.getElementById('bank').value = 4;  
    }
    else if (e.target.innerHTML === 'Bank BNI') {
         document.getElementById('credit-card-image').src = '/bni.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank BNI';
      document.getElementById('norek').innerHTML = 'Bank BNI';
      document.getElementById('bank').value = 3;
    }
	else if (e.target.innerHTML === 'Bank BRI') {
         document.getElementById('credit-card-image').src = '/bri.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank BRI';
	    document.getElementById('norek').innerHTML = 'Bank BRI';
      document.getElementById('bank').value = 2;
    }
  }
  else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
    activeDropdown.classList.remove('visible');
    activeDropdown = null;
  }
}
</script>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  // Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  // Chart.defaults.global.defaultFontColor = '#1cc88a';
  
  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
  
  // Area Chart Example
  var ctx = document.getElementById("myAreaChart");
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: {!! json_encode($collection)!!},
      datasets: [{
        label: "Profit",
        lineTension: 0.3,
        backgroundColor: "#f2fcf3",
        borderColor: "#1cc88a",
        pointRadius: 3,
        pointBackgroundColor: "#1cc88a",
        pointBorderColor: "#1cc88a",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: {!! json_encode($collect)!!},
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'date'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return 'Rp. ' + number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        intersect: false,
        mode: 'index',
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
          }
        }
      }
    }
  });
  </script>
  <script src="{{asset('investasi/mitra/vendor/chart.js/Chart.min.js')}}"></script>
  <link href="{{asset('investasi/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{asset('investasi/css/style.css') }}" rel="stylesheet" type="text/css">
@endsection
