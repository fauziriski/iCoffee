<div>
    <div class="container">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Riwayat Laporan Penjualan</h1>
        </div>
        
    <div class="table-responsive">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Kode Produk</th>
            <th scope="col">Total Berat</th>
            <th scope="col">Total Penjualan</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @forelse($riwayats as $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->kode_produk}}</td>
              <td>{{$data->total_berat}} Kg</td>
              <td>@money($data->total_penjualan)</td>
              <td>
                @if($data->status == 1)
                  <span class="badge badge-warning">Belum Divalidasi</span>
                @elseif($data->status == 0)
                  <span class="badge badge-danger">Ditolak</span>
                @elseif($data->status == 2)
                  <span class="badge badge-success">Divalidasi</span>
                @elseif($data->status == 3)
                  <span class="badge badge-info">On Progress</span>
                @endif
              </td>
              <td>
                <button class="btn btn-sm btn-primary">Konfirmasi Pembayaran</button>
                <button class="btn btn-sm btn-danger">Hapus</button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6"><h5 class="text-center">Data Tidak Tersedia</h5></td>
            </tr>
            @endforelse
        </tbody>
      </table>
    </div>
	</div>
</div>
