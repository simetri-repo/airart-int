@extends('pic.mainPic')

@section('reminder')
active bg-gradient-info
@endsection

@section('loc')
Reminder
@endsection

@section('content')
<div class="container-fluid py-4">
   <div class="col-lg-12">
      <div class="row">
         {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end p-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                  class="fa fa-plus"></i> ADD</button>
         </div> --}}
         <div class="col-lg-3 my-2">
            <div class="card">
               <div class="card-header">
                  Buat Reminder
               </div>
               <div class="card-body">
                  <form action="{{ url('new_reminder') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Satwa</label>
                              <select name="id_satwa" class="form-control" id="exampleFormControlSelect1">
                                 @foreach ($satwa as $item)
                                 <option value="{{ $item->id_satwa }}">{{ $item->id_satwa }} - {{ $item->nama_satwa }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-group input-group-static mb-4">
                              <label>Tgl Kegiatan</label>
                              <input type="date" name="tgl_kegiatan" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Keterangan</label>
                              <select name="keterangan" class="form-control" id="exampleFormControlSelect1">
                                 @foreach ($keterangan as $item)
                                 <option value="{{ $item->id_keterangan }}">{{
                                    $item->keterangan }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-dynamic">
                              <textarea class="form-control" name="note" rows="5" placeholder="Note*"
                                 spellcheck="false"></textarea>
                           </div>
                        </div>
                     </div>
               </div>
               <div class="card-footer text-muted">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
               </form>
            </div>
         </div>
         <div class="col-lg-9 my-2">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Table Reminder</h5>
                  <div class="table-responsive">
                     <table id="dt_table" class="display table table-striped" style="width:100%">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Nama Satwa</th>
                              <th>Ras</th>
                              <th>Keterangan</th>
                              <th>Tgl Kegiatan</th>
                              <th>Status</th>
                              <th>Update by</th>
                              <th>PIC PJ</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($response as $item)
                           <tr>
                              <td> <a href="" class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#aa{{ $loop->iteration }}">{{
                                    $item->id_satwa }}</a></td>
                              <td>{{ $item->nama_satwa }}</td>
                              <td>{{ $item->nama_ras }}</td>
                              <td>{{ $item->keterangan }}</td>
                              <td>{{ $item->jadwal_kegiatan }}</td>
                              <td>@if ($item->status_remin == 9)
                                 <span class="text-warning">OnProgress</span> -
                                 @if ($item->sisa_hari > 0)
                                 <span class="text-danger"> H+{{$item->sisa_hari }}</span>
                                 @elseif ($item->sisa_hari == 0)
                                 <span class="text-success"> Today</span>
                                 @elseif ($item->sisa_hari < 0) <span class="text-info"> H{{$item->sisa_hari }}</span>
                                    @endif

                                    @elseif($item->status_remin == 7)
                                    <span class="text-danger">Cancelled</span>
                                    @else
                                    <span class="text-Success">Done</span>
                                    @endif
                              </td>
                              <td>{{ $item->pic_r }}</td>
                              <td>{{ $item->pic_pj }}</td>
                           </tr>
                           {{-- modal --}}
                           <div class="modal fade" id="aa{{ $loop->iteration }}" data-bs-backdrop="static"
                              data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                              aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="staticBackdropLabel">Reminder</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <form action="{{ url('update_reminder/'. $item->id_reminder) }}" method="post">
                                          @csrf
                                          <div class="row">
                                             <div class="col-md-12">
                                                <div class="input-group input-group-static mb-4">
                                                   <label for="exampleFormControlSelect1" class="ms-0">Satwa</label>
                                                   <input type="text"
                                                      value="{{ $item->id_satwa }} - {{ $item->nama_satwa }}" disabled
                                                      class="form-control">
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                   <label>Tgl Kegiatan</label>
                                                   <input type="text" value="{{ $item->jadwal_kegiatan }}" disabled
                                                      class="form-control">
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="input-group input-group-static mb-4">
                                                   <label>Keterangan</label>
                                                   <input type="text" value="{{ $item->keterangan }}" disabled
                                                      class="form-control">
                                                </div>
                                             </div>
                                             <div class="col-md-12">
                                                <div class="input-group input-group-dynamic">
                                                   <textarea class="form-control" name="note" rows="5"
                                                      placeholder="Note*"
                                                      spellcheck="false">{{ $item->note }}</textarea>
                                                </div>
                                             </div>

                                             @if ($item->status_remin == 9)
                                             <div class="col-md-6">
                                                <div class="input-group input-group-static my-4">
                                                   <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                                                   <select name="status" class="form-control"
                                                      id="exampleFormControlSelect1">
                                                      <option value="1">Done</option>
                                                      <option value="7">Cancelled</option>
                                                   </select>
                                                </div>
                                             </div>
                                             @elseif ($item->status_remin == 1)
                                             <div class="col-md-6">
                                                <div class="input-group input-group-outline my-3">
                                                   <label class="form-label">Status =<span
                                                         class="text-success ">DONE</span></label>
                                                   <input type="text" class="form-control" disabled>
                                                </div>
                                             </div>
                                             @elseif ($item->status_remin == 7)
                                             <div class="col-md-6">
                                                <div class="input-group input-group-outline my-3">
                                                   <label class="form-label">Status =<span
                                                         class="text-danger ">Cancelled</span></label>
                                                   <input type="text" class="form-control" disabled>
                                                </div>
                                             </div>
                                             @endif

                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary"
                                          data-bs-dismiss="modal">Close</button>
                                       @if ($item->status_remin == 9)
                                       <button type="submit" class="btn btn-primary">Simpan</button>
                                       @endif
                                    </div>
                                 </div>
                                 </form>
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