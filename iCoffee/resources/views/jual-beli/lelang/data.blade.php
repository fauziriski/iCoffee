


<table class="table" id="table_id">
      
    <tr class="text-center">
      <th>No</th>
      <th>Nama</th>
      <th>Jumlah Tawar</th>
    </tr>
    
  @foreach ($penawar as $data)

    <tr class="item{{$data->id}}">
      <td>{{ $i++ }}</td>

      <td>{{ $data->nama }}</td>
      
      <td>Rp {{  number_format($data->penawaran,0,",",".") }}</td>
  

  </tr><!-- END TR-->

  @endforeach


</table>
