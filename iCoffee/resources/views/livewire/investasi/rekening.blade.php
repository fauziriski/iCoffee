<div>
    <div class="row">
        <div align="center" class="col-lg-4 mt-5 mb-4">
            <h3>Rp. 0,-</h3>
            <small class="text-muted">Saldo Tersedia</small>
        </div>
        <div class="col-lg-8 col-sm-12">
            <label for="country">Rekening Bank</label>
                <form method="post">
                <div class="form-group">
                    <div class="select-wrap">
                        <select name="id_bank" class="form-control" required>
                            <option selected disabled="disabled" value="">Pilih Rekening Bank</option>
                            @foreach ($banks as $item)
                                <option value="{{$item->id}}">{{$item->bank_name}} - {{$item->name}} - {{$item->norek}}</option>
                            @endforeach 
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga">Jumlah</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp</div>
                        </div>
                        <input type="number" class="form-control" placeholder="Dalam Rupiah" min="0"  name="jumlah" required>
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right py-2">Tarik Saldo</button>
                </div>
                </form>
            </div>
        </div>
        <p class="font-weight-bold mt-3 mb-1">Riwayat Pembayaran</p>
        
        <table class="table table-sm table-responsive-sm table-hover">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Bank</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td colspan="5">
                <p class="text-center">Data Tidak Tersedia</p>
                  </td>
                {{-- <td>Ahmad Fathoni</td>
                <td>Mandiri</td>
                <td>Rp. 1.000.000,-</td>
                <td>20-10-2020</td>
                <td><span class="badge badge-success">Sukses</span></td> --}}
              </tr>
            </tbody>
        </table>
</div>
