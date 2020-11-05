<div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Kuantitas</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($detail_ajuan as $item)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$item->produk}}</td>
                    <td>@money($item->harga)</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->jumlah}}</td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
</div>
