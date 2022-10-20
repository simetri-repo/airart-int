@extends('adm.mainAdm')

@section('r_ras')
active bg-gradient-info text-white
@endsection

@section('loc')
Data Ras
@endsection

@section('content')

<div class="container-fluid py-4">
   <div class="row">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end p-2">
         <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
               class="fa fa-plus"></i> ADD</button>
      </div>
      <div class="card">
         <div class="card-body">
            <h5 class="card-title">Data Ras</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Ras</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_ras }}</td>
                        <td><a href="{{ url('hapus_ras/'. $item->id_ras)}}" class="text-danger"
                              onclick="return confirm('Apakah anda akan menghapus data ini?')"><i
                                 class="fa fa-trash-alt"></i> Hapus</a></td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
{{-- modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Tambah Ras</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form action="{{ url('new_ras') }}" method="post">
            @csrf
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama Ras</label>
                        <input type="text" name="input_in" class="form-control">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {
            $('#dt_table').dataTable({
               dom: 'Bfrtip',
               buttons: ['excel', 'pdf'],
               "pagingType": "numbers"
            });
         });
   
</script>
@endsection