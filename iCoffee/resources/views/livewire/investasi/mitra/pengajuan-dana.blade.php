<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form wire:submit.prevent="pengajuan">
        <div class="form-group mt-0">
            <label for="exampleInputEmail1">Produk Investasi</label>
            <div class="select-wrap">
                <select wire:model="product" class="form-control" required>
                    <option selected value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option  value="{{$product->kode_produk}}">{{$product->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Judul Pengajuan</label>
            <input wire:model="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea wire:model="desc" class="form-control" ></textarea>
        </div>
        <p>Rincian Pengajuan</p>
        <table id="invoiceitems" class=" table table-responsive order-list">
            <thead>
                <tr>
                    <td>Nama Produk</td>
                    <td>Harga</td>
                    <td>Qty</td>
                    <td>Jumlah</td>
                </tr>
            </thead>
            <tbody>
                @foreach($inputs as $key => $value)
                <tr class="product">
                    <td width="50%">
                        <input type="text" wire:model="inputs.{{$key}}.produk_name" class="regular-text form-control" required/>
                    </td>
                    <td width="15%">
                        <input type="number" min="1" wire:model="inputs.{{$key}}.price"  class="price form-control" required />
                    </td>
                    <td width="10%">
                        <input type="number" min="1" wire:model="inputs.{{$key}}.qty" class="quantity form-control" required />
                    </td>
                    <td width="15%">
                        <div wire:ignore>
                        Rp. <span class="subtotal"></span>
                        </div>
                    </td>
                    <td width="5%">
                        @if ($key == 0)
                            <button wire:click.prevent="add"  class="btn btn-info" >Tambah</button>
                        @else
                            <button wire:click.prevent="remove({{$key}})" class="btn btn-danger" >Hapus</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Total:</td>
                    <td>
                        <div wire:ignore>
                        Rp. <span  class="grandtotal"></span>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Riwayat Pengajuan</button>
        <button type="submit" class="btn btn-success float-right mb-3">Submit</button>
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Riwayat Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="accordion" id="accordionExample">
                        @forelse($pengajuan_dana as $item)
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                            #{{$loop->iteration}} - {{$item->judul}}
                                            @if($item->status == 1)
                                                <span class="badge badge-warning float-right">Belum Divalidasi</span>
                                            @elseif($item->status == 2)
                                                <span class="badge badge-danger float-right">Ditolak</span>
                                            @elseif($item->status == 3)
                                                <span class="badge badge-success float-right">Divalidasi</span>
                                                @elseif($item->status == 4)
                                                <span class="badge badge-info float-right">On Progress</span>
                                            @endif
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Produk</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <p class="mb-0">Tanggal: {{Carbon::parse( $item->created_at )->translatedFormat('l, d F Y')}}</p>
                                                <p>Deskripsi: {{$item->deskripsi}}</p>
                                                @foreach($item->rincian_pengajuan as $i)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$i->produk}}</td>
                                                    <td>{{$i->harga}}</td>
                                                    <td>{{$i->qty}}</td>
                                                    <td>@money($i->jumlah)</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4" class="font-weight-bold text-right">Total</td>
                                                    <td>@money($item->total)</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Data Tidak Tersedia</p>
                        @endforelse
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
      
    @section('js')
    <script>
        $(document).ready(function () {
          $('table#invoiceitems').on('keyup', '.quantity , .price',function () {
              UpdateTotals(this);
          });
      });

      function UpdateTotals(elem) {
          // This will give the tr of the Element Which was changed
          var $container = $(elem).parent().parent();
          var quantity = $container.find('.quantity').val();
          var price = $container.find('.price').val();
          var subtotal = parseInt(quantity) * parseFloat(price);
          $container.find('.subtotal').text(subtotal.toFixed(2));
          CalculateTotal();
      }
      
      function CalculateSubTotals() {
          // Calculate the Subtotals when page loads for the 
          // first time
          var lineTotals = $('.subtotal');
          var quantity = $('.quantity');
          var price = $('.price');
          $.each(lineTotals, function (i) {
              var tot = parseInt($(quantity[i]).val()) * parseFloat($(price[i]).val());
              $(lineTotals[i]).text(tot.toFixed(2));
          });
      }
      
      function CalculateTotal() {
          // This will Itearate thru the subtotals and
          // claculate the grandTotal and Quantity here
          var lineTotals = $('.subtotal');
          var quantityTotal = $('.quantity');
          var grandTotal = 0.0;
          var totalQuantity = 0;
          $.each(lineTotals, function (i) {
              grandTotal += parseFloat($(lineTotals[i]).text());
              totalQuantity += parseInt($(quantityTotal[i]).val())
          });
          $('.totalquantity').text(totalQuantity);
          $('.grandtotal').text(parseFloat(grandTotal).toFixed(2));
      }
      </script>
    

    @endsection
</div>

