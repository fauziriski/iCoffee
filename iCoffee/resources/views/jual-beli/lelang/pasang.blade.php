@extends('jual-beli.layouts.app')
@section('title', 'Lelang | Pasang Produk')
@section('content')


                    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                        <h3 class="text-center mt-2">Pasang Produk Lelang</h3>
                        <form action="/pasang-lelang/berhasil" method="post"  enctype="multipart/form-data">
                          @csrf
                          <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama_produk" required>
                                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="harga_awal">Harga Awal</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                      </div>
                                      <input type="text" id="harga_awal" class="form-control" placeholder="Contoh : 100.000" min="10000" name="harga_awal" required>
                                      <span class="text-danger">{{$errors->first('harga_awal')}}</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="kelipatan">Kelipatan</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                      </div>
                                      <input type="text" id="kelipatan" class="form-control" placeholder="Contoh : 1.000" min="1000" name="kelipatan" required>
                                      <span class="text-danger">{{$errors->first('kelipatan')}}</span>
                                    </div>
                                  </div>
                                </div>       
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="country">Jangka Waktu</label>
                                    <div class="select-wrap">
                                      <select name="lama_lelang" id="" class="form-control" required>
                                        <option value="1-Jam">1 Jam</option>
                                        <option value="3-Jam">3 Jam</option>
                                        <option value="12-Jam">12 Jam</option>
                                        <option value="3-Hari">3 Hari</option>
                                        <option value="4-Hari">4 Hari</option>
                                        <option value="5-Hari">5 Hari</option>
                                        <option value="6-Hari">6 Hari</option>
                                        <option value="7-Hari">7 Hari</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="country">Kategori</label>
                                    <div class="select-wrap">
                                      <select name="id_kategori" id="" class="form-control" required>
                                        @foreach ($category as $data)
                                        <option value="{{ $data->id }}">{{ $data->kategori }}</option>         
                                        @endforeach  
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="stok">Jumlah</label>
                                    <div class="input-group">
                                      <input type="text" id="stok" class="form-control" id="" placeholder="Satuan" name="stok" min="10" max="30" required>
                                      <span class="text-danger">{{$errors->first('stok')}}</span>
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">Kg</div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="summernote" rows="5" type="text" name="deskripsi" required></textarea>
                                    <span class="text-danger">{{$errors->first('summernote')}}</span>
                                  </div>
                                </div>
                                @foreach ($j as $item)
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="image-{{$item}}" id="inputGroupFile{{$item}}"/>
                                      <label class="custom-file-label" for="inputGroupFile{{ $item }}">Upload Foto Produk</label>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="row">
                              <div class="col-md-12 mt-3 text-center">
                                <button type="submit" id="tambahlelang" class="btn btn-primary py-3 px-4">Pasang Lelang</button>
                              </div>
                            </div>
                          </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<link rel="stylesheet" href="{{asset('Jualbeli/plugins/summernote/summernote-lite.css')}}">
<script>
  $('#inputGroupFile0').on('change',function(){
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
  });

  $('#inputGroupFile1').on('change',function(){
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
  });

  $('#inputGroupFile2').on('change',function(){
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
  });

  $('#inputGroupFile3').on('change',function(){
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
  });

  $('#inputGroupFile4').on('change',function(){
    var fileName = $(this).val();

    $(this).next('.custom-file-label').html(fileName);
  });
</script>

<script src="{{asset('JualBeli/plugins/customPlugin/rupiahFormat.js')}}"></script>
<script type="text/javascript">
		
  var kelipatan = document.getElementById('kelipatan');
  kelipatan.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    kelipatan.value = formatRupiah(this.value, 'Rp. ');
  });

  var harga_awal = document.getElementById('harga_awal');
  harga_awal.addEventListener('keyup', function(e){
    harga_awal.value = formatRupiah(this.value, 'Rp. ');
  });

  var stok = document.getElementById('stok');
  stok.addEventListener('keyup', function(e){
    stok.value = formatRupiah(this.value, 'Rp. ');
  });

  
</script>

<script src="{{asset('Jualbeli/plugins/summernote/summernote-lite.js')}}"></script>
<script>

  $('#summernote').summernote({
      placeholder: 'Tuliskan Deskripsi Produk Disini ...',
      tabsize: 2,
      height: 200,
      tabDisable: true,
      disableDragAndDrop: true,
      focus: true,
      disableResizeEditor: true,
      toolbar: false
  });
    
  // $('#summernote').summernote('fontName', 'Poppins');
  // $('#summernote').summernote('fontSize', 18);
  $('.note-statusbar').hide(); 
  
</script>

@endsection