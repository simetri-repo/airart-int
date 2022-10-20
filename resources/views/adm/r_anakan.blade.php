@extends('adm.mainAdm')

@section('r_agenda')
active bg-gradient-info text-white
@endsection

@section('loc')
Data Kategori Anakan
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
            <h5 class="card-title">Tabel Kategori Anakan</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>Kategori</th>
                        <th>Usia min (bln)</th>
                        <th>Usia max (bln)</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)
                     <tr>
                        {{-- <td>{{ $item->keterangan_anakan }}</td> --}}
                        <td> <a href="" class="text-primary" data-bs-toggle="modal"
                              data-bs-target="#aa{{ $item->id_anakan }}">{{
                              $item->keterangan_anakan }}</a></td>
                        <td>{{ $item->min_usia}}</td>
                        <td>@if ($item->max_usia > 9990 )
                           Max
                           @else
                           {{ $item->max_usia}}
                           @endif</td>
                        <td><a href="{{ url('hapus_anakan/'. $item->id_anakan) }}" class="text-danger">Hapus</a></td>
                     </tr>
                     {{-- modal --}}
                     <div class="modal fade" id="aa{{ $item->id_anakan }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="staticBackdropLabel">Kategori Update</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <form action="{{ 'update_anakan/'.$item->id_anakan }}" method="post">
                                    <div class="row">
                                       @csrf
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Kategori</label>
                                             <input type="text" name="kategori" value="{{ $item->keterangan_anakan }}"
                                                class="form-control">
                                          </div>
                                       </div>

                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Min Usia (Bulan)</label>
                                             <input type="number" min="0" name="min_usia" value="{{ $item->min_usia }}"
                                                class="form-control">
                                          </div>
                                       </div>

                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Max Usia (Bulan)</label>
                                             <input type="number" min="0" name="max_usia" value="{{ $item->max_usia }}"
                                                class="form-control">
                                          </div>
                                       </div>

                                    </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary">Update</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
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
            <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ url('new_anakan') }}" method="post">
               <div class="row">
                  @csrf
                  <div class="col-md-12">
                     <div class="input-group input-group-dynamic my-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control">
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="input-group input-group-dynamic my-3">
                        <label class="form-label">Min Usia (Bulan)</label>
                        <input type="number" min="0" name="min_usia" class="form-control">
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="input-group input-group-dynamic my-3">
                        <label class="form-label">Max Usia (Bulan)</label>
                        <input type="number" min="0" name="max_usia" class="form-control">
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