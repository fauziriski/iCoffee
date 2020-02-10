@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Beranda')
@section('sidebar')
@endsection
@section('content')


<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 pl-4 md-5 pr-2 ftco-animatee">
                <div class="home-slider owl-carousel">
                  
          
                  <div class="slider-item">
                    <img class="img-fluid" src="{{ asset('Uploads/Lelang/{'.$products->kode_lelang.'}/'.$products->gambar) }}" alt="Colorlib Template">
                  </div>
      
                  @foreach($image as $data)
                  <div class="slider-item">
                    <img class="img-fluid" src="{{ asset('Uploads/Lelang/{'.$products->kode_lelang.'}/'.$data->nama_gambar) }}" alt="Colorlib Template">
                  </div>
                  @endforeach
                </div>
            </div>


            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
              <h3>{{ $products->nama_produk}}</h3>
                <!-- <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p>
                    </div> -->


              <div class="row">
                <p class="text-left">

                  <div class="col-5">
                    <i class="fa fa-money"></i> Harga Awal
                  </div>
                  <div class="col">
                    <span class="mr-4" style="color: #bbb;">Rp {{ $products->harga_awal}}</span>
                  </div>
       
                </p>
              </div>

              <div class="row">
                <p class="text-left">

                  <div class="col-5">
                    <i class="oi oi-transfer"></i> Penawaran Terakhir
                  </div>
                  <div class="col">
                    <span class="mr-4" id="penawaran_terakhir" style="color: #bbb;">Rp {{ $proses->penawaran }}</span>
                  </div>
              
                </p>
              </div>

              <div class="row mt-2">
                <p class="text-left">
                  <div class="col">
                    <h4 id="demo1" style="color:#ee4d2c;"></h4>
                  </div>
                </p>
              </div>
                        
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group d-flex">
                              <!-- <div class="select-wrap"> -->
                              <!-- <div class="icon"><span class="ion-ios-arrow-down"></span></div> -->
                              <!-- <select name="" id="" class="form-control">
                                  <option value="">Small</option>
                                <option value="">Medium</option>
                                <option value="">Large</option>
                                <option value="">Extra Large</option>
                              </select> -->
                            <!-- </div> -->
                          </div>
                      </div>
                      <div class="w-100"></div>
                      <div class="col-md-12">
                        <p style="color: #000;">Harga Tawar</p>
                      </div>
                      <div class="input-group col-md-6 d-flex mb-3">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <div class="input-group-text">Rp</div>
                              </div>
                            <input type="text" id="penawaran_coba" name="penawaran" class="form-control input-number" value="{{ $tawar }}" readonly>
                          </div>

                      </div>
              
                      </div>
                  <form  method="post" id="sample_form" >
                    @csrf
                    <input type="hidden" name="id_produk" value="{{$products->id}}">
                    <input type="hidden" name="id_pelelang" value="{{$products->id_pelelang}}">
                    <input type="hidden" name="id_penawar" value="{{ Auth::user()->id}}">
                    <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="penawaran" id="penawaran"  value="{{ $tawar }}">
                    <input type="hidden" name="kelipatan" value="{{ $products->kelipatan }}">
                    <p><input class="btn btn-primary py-3 px-1" id="tawar" value="Tawar" readonly></p>
                  </form>
            </div>
    </div>
      

        <ul class="col nav nav-pills" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" color="white">Deskripsi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Penawaran</a>
          </li>
          
        </ul>
        <br>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
              <div class="col mb-5 ftco-animate">
                  <p>{{ $products->desc_produk }}</p>
              </div>
            </div>
          </div>

          
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="col-md-12 ftco-animate">
            <div class="cart-list">
              <table class="table" id="table_id">
      
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah Tawar</th>
                  </tr>
                  
                @foreach ($penawar as $data)

                  <tr class="item{{$data->id}}">
                    <td>{{ $i++ }}</td>

                    <td>{{ $data->nama }}</td>
                    
                    <td>Rp {{ $data->penawaran }}</td>
                
            
                </tr><!-- END TR-->

                @endforeach
            
         
              </table>
       
          </div>
          </div>
          

      </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
        <h2 class="mb-4">Produk Terkait</h2>
      </div>
    </div>   		
    </div>
    <div class="container">
        <div class="row">
        @foreach ($produk_terkait as $data)
        <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
                <a href="/lelang/produk/{{ $data->id }}" class="img-prod"><img class="img-fluid" src="{{ url('/Uploads/Lelang/{'.$data->kode_lelang.'}/'.$data->gambar) }}" alt="Colorlib Template">
                    <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="/lelang/produk/{{ $data->id }}">{{ $data->nama_produk }}</a></h3>
                    <p class="demo" id="{{ $data->id }}" name="{{ $data->id }}"  style="color:#ee4d2c;"></p>     
                </div>
            </div>
        </div>
            
        @endforeach


        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
  // Set the date we're counting down to
  var  u = {!!json_encode($products)!!};
  var id = u.tanggal_berakhir;

  var countDownDate = new Date(id).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
      
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
    // Output the result in an element with id="demo"
    document.getElementById("demo1").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

      
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      $('#tawar').replaceWith('<input class="btn btn-primary py-3 px-1" id="selesai" value="Selesai" readonly>');
      var penawar_terakhir = {!!json_encode($penawar)!!};
            console.log(penawar_terakhir);
      document.getElementById("demo1").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>


<script>
  
  // Set the date we're counting down to
  var sis = 27;

  var data = {!!json_encode($data->tanggal_berakhir)!!};
  var  u = {!!json_encode($produk_terkait)!!};
  var p = u;

  var length = p.length;
  var panjang =  {!!json_encode($panjang)!!};
   
  
  // var countDownDate = new Date("2020-01-21 15:37:25").getTime();
  // Update the count down every 1 second
    var x = setInterval(function() {
      for (i = 0; i < length; i++) {
        var array = p[i];
        var id = array.id;
       
        var y =  array.tanggal_berakhir;
        var count = new Date(y).getTime();
        // Get today's date and time
        var now = new Date().getTime();
          
        // Find the distance between now and the count down date
        var distance = count - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
        // Output the result in an element with id="demo"
        document.getElementById(id).innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
      
      // If the count down is over, write some text 
          if (distance < 0) {

            clearInterval(x);
            document.getElementById(id).innerHTML = "EXPIRED";
          }
      }
          
    }, 1000);
  
  </script>

<script>

$(document).ready(function() {
   
   $('#tawar').on('click', function() {
    var data = $('#sample_form').serialize();
    $.ajax({
					url:"/lelang/produk/tawar",
					method:"POST",
					data: data,
					success:function(response, data)
					{
            
            if(response.response == 'Berhasil'){
              var penawaranselanjutnya = parseInt(response.data.penawaran) + parseInt(response.data.kelipatan);
              $('#penawaran_coba').replaceWith('<input type="text" id="penawaran_coba" name="penawaran_coba" class="form-control input-number" value="'+ penawaranselanjutnya +'" readonly>');
              $('#penawaran').replaceWith('<input type="hidden" id="penawaran" name="penawaran" value="'+ penawaranselanjutnya +'">');
              $('#penawaran_terakhir').replaceWith('<span class="mr-4" id="penawaran_terakhir" style="color: #bbb;">Rp '+ response.data.penawaran +'</span>');
              $('#table_id').load("/lelang/produk/data/"+ response.data.id_produk); 
            }
            else if(response.response == 'Saldo'){
              swal(
                'Gagal',
                'Saldo Anda Tidak Mencukupi',
                'error'
              );
            }
            else{
              swal(
                'Gagal',
                'Penawaran Anda Gagal',
                'error'
              );
            }
  
					}
				});

  });
});

</script>
 

@endsection