@extends('jual-beli.layouts.app')
@section('title', 'Edit Produk')
@section('content')

                    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
                        <h2 class="text-center">Edit Produk</h2>
                        <form action="/jual-beli/produk/edit/berhasil" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="row mt-2 pl-4 pr-4 mb-5">
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="nama">Nama Produk</label>
                                      <input type="text" class="form-control" name="nama_produk" value="{{$produk->nama_produk}}" required>
                                    </div>
                                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                                  </div>
                                
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="harga">Harga </label>
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="text" id="harga" class="form-control" placeholder="Min : 1000" value="{{ number_format($produk->harga,0,",",".") }}" min="1000" name="harga" required>
                                      </div>
                                      <span class="text-danger">{{$errors->first('harga')}}</span>
                                    </div>
                                  </div>
                                  
                      
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="stok">Stok</label>
                                      <div class="input-group">
                                        <input type="text" class="form-control" id="stok" placeholder="Contoh : 10" min="1" name="stok" value="{{ number_format($produk->stok,0,",",".") }}" required>
                                        <div class="input-group-prepend">
                                          <div class="input-group-text">Kg</div>
                                        </div>
                                      </div>
                                      <span class="text-danger">{{$errors->first('stok')}}</span>
                                    </div>
                                  </div>
                      
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="country">Kategori</label>
                                      <div class="select-wrap">
                                        <select name="id_kategori" id="" class="form-control" required>
                                          <option value="{{ $produk->id_kategori }}">{{ $kategori }}</option>  
                                          @foreach ($category as $data)
                                          <option value="{{ $data->id }}">{{ $data->kategori }}</option>         
                                          @endforeach  
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                      
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="deskripsi">Deskripsi</label>
                                      <textarea id="summernote" class="form-control" rows="5" type="text" name="detail_produk" required>
                                        {{$produk->detail_produk}}
                                      </textarea>
                                      <span class="text-danger">{{$errors->first('summernote')}}</span>
                                    </div>
                                  </div>

                                  <input type="hidden" name="old_image" value="{{$produk->gambar}}">

                                  @foreach ($images as $key => $value)
                                  <input type="hidden" name="old_images-{{$key}}" value="{{$value->nama_gambar}}">
                                  @endforeach
                                  
                                  @foreach ($j as $i)
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image-{{$i}}" id="inputGroupFile{{$i}}"/>
                                        <label class="custom-file-label" for="inputGroupFile{{ $i }}">Upload Foto Produk</label>
                                      </div>
                                    </div>
                                  </div>
                                
                                  @endforeach
                                </div>
                                <div class="row justify-content-center">
                                  <div class="col-md-12 text-center mt-3">
                                    <button type="submit" id="tambahproduk" class="btn btn-primary py-3 px-4">Edit Produk</button>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>

<link rel="stylesheet" href="{{asset('Jualbeli/plugins/summernote/summernote-lite.css')}}">
@endsection
@section('js')
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
    
    $('#summernote').summernote('fontName', 'Poppins');
    $('#summernote').summernote('fontSize', 18);
    $('.note-statusbar').hide(); 
    

</script>
<script src="{{asset('JualBeli/plugins/customPlugin/rupiahFormat.js')}}"></script>
<script type="text/javascript">
		
  var harga = document.getElementById('harga');
  harga.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    harga.value = formatRupiah(this.value, 'Rp. ');
  });

  var stok = document.getElementById('stok');
  stok.addEventListener('keyup', function(e){
    stok.value = formatRupiah(this.value, 'Rp. ');
  });

  
</script>


@endsection

@section('footer')
    
@endsection