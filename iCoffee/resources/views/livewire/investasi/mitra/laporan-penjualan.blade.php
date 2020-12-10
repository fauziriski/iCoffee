<div>
    <div class="container">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">List Laporan Penjualan</h1>
      <div>
        <a class="btn btn-sm btn-secondary" role="button" href="/mitra/riwayat-penjualan"><i class="fas fa-history fa-sm text-white-50"></i> Riwayat Penjualan</a>
        <button type="button" data-toggle="modal" data-target="#exampleModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i>  Tambah Laporan</button>
      </div>
    </div>
        
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambal Laporan Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form wire:submit.prevent="addpenjualan">
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Produk</label>
                <select wire:model="product" class="form-control" required>
                  <option selected value="">Pilih Produk</option>
                  @foreach ($products as $product)
                    <option  value="{{$product->kode_produk}}">{{$product->nama_produk}}</option>
                  @endforeach
                </select>
              </div>
              <label for="berat">Berat Produk</label>
              <div class="input-group">
                <input wire:model="berat" type="number" id="berat" class="form-control" required>
                <div class="input-group-append">
                  <span class="input-group-text">Kg</span>
                </div>
              </div>
              <label for="Harga">Harga Jual</label>
              <div class="input-group mb-1">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp.</span>
                </div>
                <input wire:model="harga" type="number" id="Harga" class="form-control" required>
              </div>
              Foto Produk
              <div class="input-group">
                <div class="custom-file-produk">
                  <input wire:model="foto_produk" type="file" accept="image/*" id="foto-produk" required>
                </div>
              </div>
              <p class="mt-3 mb-0">Foto Kwitansi/Nota</p>
              <div class="input-group">
                <div class="custom-file">
                  <input wire:model="foto_nota" type="file" accept="image/*" id="foto-nota" required>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    
    <label for="cars">Produk Investasi:</label>
    <select wire:model="produk">
      <option>Pilih Produk</option>
      @foreach ($products as $produk)
        <option wire:key="{{$produk->kode_produk}}" value="{{$produk->kode_produk}}">{{$produk->nama_produk}}</option>
      @endforeach
    </select>
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif
    @if ($message = Session::get('suksesSetor'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }} <a href="/mitra/riwayat-penjualan">Cek Disini</a></strong>
      </div>
    @endif
    <div class="table-responsive">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Berat Produk</th>
            <th scope="col">Harga Produk</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse($penjualan as  $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->berat_produk}} Kg</td>
              <td>@money($data->harga_jual)</td>
              <td>{{Carbon::parse( $data->created_at )->translatedFormat('l, d F Y')}}</td>
              <td>
                <button class="btn btn-sm btn-primary">Lihat</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
              </td>
            </tr>
            @php
              $total = $total + $penjualan[$loop->index]->berat_produk;
              $harga_total = $harga_total + $penjualan[$loop->index]->harga_jual;
              $kode = $penjualan[0]->kode_produk;
            @endphp
            @if($loop->last == true)
              <tr>
                <td><p class="font-weight-bold">Total:</p></td>
                <td><p class="font-weight-bold">{{$total}} Kg</p></td>
                <td><p class="font-weight-bold">@money($harga_total)</p></td>
                <td></td>
                <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#setorPenjualan">Setor Penjualan</button></td>
              </tr>
            @endif
            @empty
            <tr>
              <td colspan="5"><h5 class="text-center">Data Tidak Tersedia</h5></td>
            </tr>
            @endforelse
        </tbody>
      </table>
    </div>
    <div class="modal fade" id="setorPenjualan" tabindex="-1" aria-labelledby="setorPenjualanLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="setorPenjualanLabel">Setor Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda akan melakukan Setor Penjualan untuk produk berikut ini.</p>
            <p>Kode Produk : {{$kode}}</p>
            <p>Berat Total : {{$total}} Kg</p>
            <p>Harga Jual : @money($harga_total)</p>
            <p>Silahkan transfer ke salah satu rekening iCoffee sejumlah <span class="font-weight-bold">@money($harga_total)</span></p>
            <p>Bank Mandiri a.n. iCoffee <span class="font-weight-bold">1238762987</span></p>
            <p>Bank BCA a.n. iCoffee <span class="font-weight-bold">1238762987</span></p>
            <p>Bank BNI a.n. iCoffee <span class="font-weight-bold">1238762987</span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button wire:click="setor('{{$kode}}', {{$total}}, {{$harga_total}})" type="button" class="btn btn-sm btn-success">Setor Penjualan</button>
          </div>
        </div>
      </div>
    </div>
	</div>
</div>
