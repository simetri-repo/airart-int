@extends('adm.mainAdm')

@section('data-pic')
active bg-gradient-info
@endsection

@section('loc')
Data PIC
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

            <h5 class="card-title">Table PIC</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama PIC</th>
                        <th>No Hp</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)

                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- <td><button class="btn btn-primary btn-sm">{{ $item->id_pic }}</button></td> --}}
                        <td> <a href="" class="text-primary" data-bs-toggle="modal"
                              data-bs-target="#D{{ $item->id_pic }}">{{
                              $item->id_pic }}</a></td>
                        <td>{{ $item->nama_pic }}</td>
                        <td>{{ $item->no_hp_pic }}</td>
                     </tr>
                     {{-- modal --}}
                     <div class="modal fade" id="D{{ $item->id_pic }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="staticBackdropLabel">Data - {{ $item->id_pic }}</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="{{ url('update_pic/'. $item->id_pic )}}" method="post">
                                       @csrf
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>NIK</label>
                                             <input type="text" name="nik" value="{{ $item->id_pic }}"
                                                class="form-control" disabled>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Nama PIC</label>
                                             <input type="text" name="nama_pic" value="{{ $item->nama_pic }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Tgl Lahir</label>
                                             <input type="date" name="tgl_lhr_pic" value="{{ $item->tgl_lahir_pic }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Nomor Tlp</label>
                                             <input type="tel" name="no_hp_pic" value="{{ $item->no_hp_pic }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-info"
                                    onclick="return confirm('Apakah anda akan melakukan update data?')">Update</button>
                                 {{-- <a href="" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda akan menghapus data ini?')">Delete</a> --}}
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
            <h5 class="modal-title" id="staticBackdropLabel">Tambah PIC</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <form action="{{ url('new_pic') }}" method="post">
                  @csrf
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">NIK</label>
                        <input type="text" name="nik" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama PIC</label>
                        <input type="text" name="nama_pic" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static my-3">
                        <label>Tgl Lahir</label>
                        <input type="date" name="tgl_lhr_pic" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nomor Tlp</label>
                        <input type="tel" name="no_hp_pic" class="form-control">
                     </div>
                  </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">save</button>
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