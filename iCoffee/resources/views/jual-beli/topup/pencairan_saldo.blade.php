@extends('jual-beli.layouts.app')
@section('title', 'Profle | Pencairan Saldo')
@section('content')

                    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                        <h3 class="mt-3 text-center">Pencairan Saldo</h3>

                        <form action="/profile/saldo/tarik" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly required>
                                                <span class="text-danger">{{$errors->first('email')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="bank">Bank</label>
                                                <div class="select-wrap">
                                                    <select name="bank" id="" class="form-control" required>
                                                    <option value="BCA">BCA</option>
                                                    <option value="BRI">BRI</option>  
                                                    <option value="BNI">BNI</option>  
                                                    <option value="Mandiri">Mandiri</option>       
                                                    </select>
                                                </div>
                                                <span class="text-danger">{{$errors->first('bank')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="no_rek">No Rekening</label>
                                                <input type="tel" class="form-control" name="no_rek" min="" required>
                                                <span class="text-danger">{{$errors->first('no_rek')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pemilik">Pemilik Rekening</label>
                                                <input type="text" class="form-control" name="pemilik" min="" required>
                                                <span class="text-danger">{{$errors->first('pemilik')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jumlah">Jumlah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <div style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;"  class="input-group-text">Rp</div>
                                                    </div>
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" min="10000" max="{{ $cek_saldo->saldo }}" required>
                                                </div>
                                                <span class="text-danger">{{$errors->first('jumlah')}}</span>
                                            </div> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" required>
                                                <span class="text-danger">{{$errors->first('password')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-end mt-2 mb-5 justify-content-center">
                                        <div class="col-md-3 text-center mt-3">
                                            <button type="submit" class="btn btn-primary py-3 px-4">Tarik Saldo</button>
                                        </div>
                                    </div>
                      
                                </div>
                            </div>
                        </form>
                       
                    </main>
                </div>
            </div>
        </div>
    </div>

    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="{{asset('/JualBeli/js/customplugin/rupiahformat.js')}}"></script>
<script type="text/javascript">
		
  var harga = document.getElementById('jumlah');
  harga.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    harga.value = formatrupiah(this.value, 'Rp. ');
  });

  
</script>

@endsection

@section('footer')
    
@endsection