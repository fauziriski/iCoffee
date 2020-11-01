<div>
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
        <table id="invoiceitems" class=" table order-list">
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
                            <button wire:click.prevent="add" class="btn btn-info" >Tambah</button>
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
        <button type="submit" class="btn btn-success float-right mb-3">Submit</button>
    </form>

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

