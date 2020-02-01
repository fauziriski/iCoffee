@extends('investasi.layouts.app')
@section('title', 'Biayai Produk Investasi')
@section('css')
<style>
body,html {
  height:100%;
  margin:0;
  font-family:lato;
}
.container {
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
  position:absolute;
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
	<div class='container'>
		<div class='window ftco-animate'>
		  <div class='order-info'>
			<div class='order-info-content'>
			  <h2>Produk Investasi</h2>
				<div class='line'></div>
					<table class='order-table'>
						<tbody>
						<tr>
							<td><img src="{{ asset('Uploads/Investasi/Produk/{'.$produk->kode_produk.'}/'.$produk->gambar) }}" style="border-radius: 40%" class='full-width'></img>
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
          <h2>Simulasi Keuntungan</h2>
          <br>
          <div class="ct-chart"></div>
				  {{-- <table class='order-table'>
					<tbody>
						<h2>Mitra Proyek</h2>
					<tr>
						<td><img src="{{ asset('Uploads/Investasi/Logo.jpg')}}" style="border-radius: 40%" class='full-width'></img>
						</td>
						<td>
						 <span class='thin'>{{$mitra->nama}}</span>
						<br> <span class='thin small'> Email: {{$mitra->email}} <br>Petani: {{$mitra->jumlah_petani}} Orang<br></span>
					</td>
		
					</tr>
						
				
					</tbody>
					
				</table>
				<div class="desc" align="justify">{{ Str::limit('Untuk program kemitraan pembenihan jagung kali ini akan dilakukan oleh Kelompok Tani Eko Proyo yang berada di Desa Sukoanyar, Kecamatan Wajak, Kabupaten Malang, Provinsi Jawa Timur yang akan memberdayakan ± 120 orang lebih petani jagung dengan rencana luas garapan ± 40 hektar serta estimasi produksi benih jagung hibrida sebesar ± 2 ton per hektar dalam 1 (satu) siklus produksi.',285) }}</div> --}}
			  
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
					<img src='\bni.png' height='80' class='credit-card-image' id='credit-card-image'></img>
					<div id="norek">Nomor Rekening : 187823287 a.n. iCoffee</div>
					<form action="/invest/checkout/berhasil" method="POST">
						@csrf
						<input type="hidden" name="qty" value="{{$qty}}">
						<input type="hidden" name="total" value="{{$produk->harga*$qty}}">
						<input type="hidden" name="id_produk" value="{{$produk->id}}">
            <input type="hidden" name="id_mitra" value="{{$produk->id_mitra}}">
            <input type="hidden" name="id_bank" id="bank" value="3">
						<button class='pay-btn'>Mulai Membiayai Petani</button>
					</form>
				  
	  
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
      "6. Pilih Jenis rekening yang akan Anda gunakan (Contoh: 'Dari Rekening Tabungan')." +
      "7. Pilih 'Virtual Account Billing'. <br/>" +
      "8. Masukkan nomor Virtual Account Anda (contoh: 8277895360122288). <br/>";
      }
    else if (e.target.innerHTML === 'Bank Mandiri') {
         document.getElementById('credit-card-image').src = '/mandiri.svg';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank Mandiri';
	    document.getElementById('norek').innerHTML = 'Bank BCA';
      document.getElementById('bank').value = 4;  
    }
    else if (e.target.innerHTML === 'Bank BNI') {
         document.getElementById('credit-card-image').src = '/bni.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank BNI';
      document.getElementById('norek').innerHTML = 'Bank BCA';
      document.getElementById('bank').value = 3;
    }
	else if (e.target.innerHTML === 'Bank BRI') {
         document.getElementById('credit-card-image').src = '/bri.png';
          activeDropdown.classList.remove('visible');
      activeDropdown = null;
      e.target.innerHTML = document.getElementById('current-card').innerHTML;
      document.getElementById('current-card').innerHTML = 'Bank BRI';
	    document.getElementById('norek').innerHTML = 'Bank BCA';
      document.getElementById('bank').value = 2;
    }
  }
  else if (e.target.className !== 'dropdown-btn' && activeDropdown) {
    activeDropdown.classList.remove('visible');
    activeDropdown = null;
  }
}
</script>
<link rel="stylesheet" href="{{asset('investasi/css/chartist.css')}}">
<script src="{{asset('investasi/js/chartist.js')}}"></script>
<script src="{{asset('investasi/js/point-labels.js')}}"></script>
<script src="https://igrow.asia/api/public/vendor/chartist/plugins/chartist-plugin-axistitle.js"></script>
<script>
new Chartist.Line('.ct-chart', {
  labels: {!! json_encode($collection)!!},
  series: [{!! json_encode($collect)!!}]
}, {
  chartPadding: {
    top: 20,
    right: 0,
    bottom: 30,
    left: 60
  },
  low: 0,
  showArea: true,
  axisY: {
    onlyInteger: true
  },    
  plugins: [
    Chartist.plugins.ctAxisTitle({
      axisX: {
        axisTitle: 'Tahun',
        axisClass: 'ct-axis-title',
        offset: {
          x: 0,
          y: 50
        },
        textAnchor: 'middle',
        flipTitle: true,
        onlyInteger: true
      },
      axisY: {
        axisTitle: 'Profit',
        axisClass: 'ct-axis-title',
        offset: {
          x: 0,
          y: 0
        },
        textAnchor: 'middle',
        flipTitle: false,
        onlyInteger: true
      }
    }),
    Chartist.plugins.ctPointLabels({
      textAnchor: 'middle',
      labelInterpolationFnc: function(value) {
        return 'Rp ' + value
      }
    })
  ]
});
</script>
@endsection
