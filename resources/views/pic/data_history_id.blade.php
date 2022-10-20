@extends('pic.mainPic')

@section('data-history')
active bg-gradient-info
@endsection

@section('loc')
Data History
@endsection

@section('content')

<div class="container-fluid py-4">
   <div class="row">
      <div class="d-grid gap-2 d-md-flex justify-content-md-top p-2">
         <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
      </div>
      <div class="card">
         <div class="card-body">
            <h5 class="card-title">Table History - {{ $nama_satwa }} ( {{ $id_satwa }} )</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>Status</th>
                        <th>BB</th>
                        <th>Tinggi</th>
                        <th>Panjang</th>
                        <th>Lokasi</th>
                        <th>Last Update</th>
                        <th>Note</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)
                     <tr>
                        <td>@if ($item->id_status == 1)
                           <span class="text-success">{{ $item->status }}</span>
                           @else
                           <span class="text-danger">{{ $item->status }}</span>
                           @endif
                        </td>
                        <td>{{ $item->bb }} KG</td>
                        <td>{{ $item->tinggi }} CM</td>
                        <td>{{ $item->panjang }} CM</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->update_oleh }} - {{ $item->update_akhir }}</td>
                        <td>{{ $item->note }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {
            $('#dt_table').dataTable({
               dom: 'Bfrtip',
               buttons: [ 'excel', 'pdf'],
               "pagingType": "numbers"
            });
         });
   
</script>
@endsection