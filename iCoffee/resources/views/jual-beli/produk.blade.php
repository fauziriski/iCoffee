@extends('jual-beli.layouts.app')
@section('title', 'Pasang Produk')
@section('content')

<div class="col-md-9">
 <div class="card">
   <article class="card-group-item">
    <header class="card-header"><h6 class="title">Produk Anda</h6></header>
    <div class="col" style="border-radius: 400px;">
        @foreach ($produk as $data)

            <div class="row mt-3">
                <div class="col">
                    <p>Nama Produk : <strong>{{  $data->nama_produk }}</strong></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-2 text-center">
                    <img class="img-fluid" src="{{ url('/Uploads/Produk/{'.$data->kode_produk.'}/'.$data->gambar) }}" width="70%" height="70%">
                </div>
                <div class="col-md-3">
                    <p>Kategori : <strong style="color:#ee4d2c">Rp {{ $data->category->kategori }}</strong></p>
                    <p>Harga : <strong style="color:#ee4d2c">Rp {{ number_format($data->harga) }}</strong></p>
                </div>
                <div class="col-md-4 mt-2">
                    <p>Stok : <strong style="color:#ee4d2c"> {{ $data->stok }} Kg</strong></p>
                    
                </div>
                <div class="col text-left mt-2">
                    <a href="/jual-beli/produk/{{ $data->slug }}"><span class="oi oi-eye align-middle"></span>&nbsp; Lihat Produk </a>
                    <br>
                    <a href="" data-toggle="modal" data-target="#exampleModal" name="edit_produk" value="{{$data->id}}" target="_blank" data-whatever="@mdo"><span class="oi oi-pencil align-middle"></span>&nbsp; Edit Produk </a>
                </div>
            </div>
            <hr>
    
            @endforeach
        </div>


  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
                    <h4 class="modal-title">Edit Produk</h4>
                </div>
                <div class="modal-body">
                    <form action="/jual-beli/edit/produk" method="POST" enctype="multipart/form-data" id="editproduk">
                    @csrf
                    <input type="hidden" id="produk_id" name="produk_id">
                    <div class="form-group">
                        <label for="nama_produk_edit" class="col-form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk_edit" name="nama_produk_edit">
                      </div>

                      <div class="form-group">
                        <label for="kategori_kopi_edit" class="col-form-label">Kategori Kopi</label>
                          <select name="kategori_kopi_edit" required id="kategori_kopi_edit" class="form-control">
                            <option value="" id="select_kategori_kopi_edit"></option>
                            @foreach ($category as $info)
                            <option value="{{ $info['id'] }}">{{ $info['kategori'] }}</option>
                            @endforeach

                          </select>
                      </div>

                      <div class="form-group">
                        <label for="harga_edit" class="col-form-label">Harga</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">Rp</div>
                            </div>
                            <input type="number" class="form-control" id="harga_edit" name="harga_edit">
                        </div>
                      </div>
    
                      <div class="form-group">
                        <label for="stok_edit" class="col-form-label">Stok</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="stok_edit" name="stok_edit">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Kg</div>
                            </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="desc_produk_edit" class="col-form-label">Deskripsi</label>
                        <div class="input-group">
                            <textarea class="form-control" rows="5" type="text" id="desc_produk_edit" name="desc_produk_edit"></textarea>
                        </div>
                      </div>
    
    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="ubahalamat">Edit Produk</button>
                </div>
            </div>
    
        </div>
    </div>
</div><!-- tutup side -->
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('a[name="edit_produk"]').on('click', function() {
            var href = $(this).attr('value');      
            if(href) {
                $.ajax({
                    url: '/jual-beli/produk/edit/'+encodeURI(href),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
         
                        $.each(data, function(key, value) {
                            $('#produk_id').replaceWith('<input type="hidden" id="produk_id" name="produk_id" required value="'+ data.produk.id +'">');
                            $('#nama_produk_edit').replaceWith('<input type="text" class="form-control" id="nama_produk_edit" name="nama_produk_edit" value="'+ data.produk.nama_produk+'" reuired>');
                            $('#harga_edit').replaceWith('<input type="number" class="form-control" id="harga_edit" name="harga_edit" value="'+ data.produk.harga+'" reuired>');
                            $('#select_kategori_kopi_edit').replaceWith('<option value="'+ data.produk.id_kategori +'" selected>'+ data.kategori +'</option>');
                            $('#stok_edit').replaceWith('<input type="number" class="form-control" id="stok_edit" name="stok_edit" value="'+ data.produk.stok+'" reuired>');
                            $('#desc_produk_edit').replaceWith('<textarea class="form-control" rows="5" type="text" id="desc_produk_edit" name="desc_produk_edit">'+ data.produk.detail_produk +'</textarea>');
                        });

                    }
                })
            }
            else{
                $('a[name="edit_produk"]').empty();
            }
        });

        $('#ubahalamat').on('click', function() {
            var data = $('#editproduk').serialize();

            $.ajax({
                url:"/jual-beli/produk/edit/berhasil",
                method:"POST",
                dataType: 'json',
                data: data,
                success:function(data){
                    swal(
                    'Berhasil',
                    'Edit Produk Berhasi',
                    'success'
                    );
                    location.reload();
                }
            });

        });


        

        
    });
</script>
@endsection