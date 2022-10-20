@extends('pic.mainPic')

@section('data-history')
active bg-gradient-info
@endsection

@section('loc')
Data History
@endsection

@section('content')

<div class="container-fluid py-4">

   <div class="col-12">
      <div class="row">
         {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end p-2">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                  class="fa fa-plus"></i> ADD</button>
         </div> --}}
         <div class="col-lg-4 col-sm-12 my-2">
            <div class="card">
               <div class="card-header">
                  Daily Update
               </div>
               <div class="card-body">
                  <form action="{{ url('new_history') }}" method="post">
                     <div class="row">
                        @csrf
                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Pilh Satwa</label>
                              <select name="id_satwa" class="form-control" id="exampleFormControlSelect1">
                                 @foreach ($satwa as $item)
                                 <option value="{{ $item->id_satwa }}"> {{ $item->id_satwa }} - {{ $item->nama_satwa }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                              <select name="status" class="form-control" id="exampleFormControlSelect1">
                                 @foreach ($status as $item)
                                 <option value="{{ $item->id_status }}">{{ $item->status }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-group input-group-outline mb-4">
                              <label class="form-label">Tinggi (cm)</label>
                              <input type="text" name="tinggi" min="1"
                                 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                 class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-group input-group-outline mb-4">
                              <label class="form-label">BB (kg)</label>
                              <input type="text" name="bb" min="1"
                                 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                 class="form-control">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-outline mb-4">
                              <label class="form-label">Panjang (cm)</label>
                              <input type="text" name="panjang" min="1"
                                 oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                 class="form-control">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Lokasi Kandang</label>
                              <select name="kandang" class="form-control" id="exampleFormControlSelect1">
                                 @foreach ($kandang as $item)
                                 <option value="{{ $item->id_lokasi }}">{{ $item->lokasi }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-12 mb-4">
                           <div class="input-group input-group-dynamic">
                              <textarea class="form-control" name="note" rows="4" placeholder="Note*"
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
         <div class="col-lg-8 col-sm-12 my-2">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Table History</h5>
                  <div class="table-responsive">
                     <table id="dt_table" class="display table table-striped" style="width:100%">
                        <thead>
                           <tr>
                              <th>ID Satwa</th>
                              <th>Nama Satwa</th>
                              <th>Ras</th>
                              <th>Kondisi</th>
                              <th>Lokasi</th>
                              <th>PIC PJ</th>
                              <th>Last Update</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($response as $item)
                           <tr>
                              <td> <a href="{{ url('show_history_id/'.$item->id_satwa.'/'.$item->nama_satwa) }}"
                                    class="text-primary">{{$item->id_satwa}}</a></td>
                              {{-- <td> <a href="" class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#{{ $item->id_satwa }}">{{
                                    $item->id_satwa }}</a></td> --}}
                              <td>{{ $item->nama_satwa }}</td>
                              <td>{{ $item->nama_ras }}</td>
                              <td>@if ($item->id_status == 1)
                                 <span class="text-success">{{ $item->status }}</span>
                                 @else
                                 <span class="text-danger">{{ $item->status }}</span>
                                 @endif
                              </td>
                              <td>{{ $item->lokasi }}</td>
                              <td>{{ $item->pic_pj }}</td>
                              <td>{{ $item->update_oleh }} - {{ $item->tgl_akhir }}</td>
                           </tr>
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