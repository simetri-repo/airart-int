@extends('adm.mainAdm')

@section('data-user')
active bg-gradient-info
@endsection

@section('loc')
Data User
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
            <h5 class="card-title">Table User</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>ID_PIC</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <a href="" class="text-primary" data-bs-toggle="modal"
                              data-bs-target="#D{{ $item->id_pic }}">{{
                              $item->id_pic }}</a></td>
                        <td>{{ $item->username }}</td>
                        <td> @if ($item->role == 1)
                           ADMIN
                           @else
                           PIC
                           @endif</td>
                        <td> @if ($item->status == 9)
                           <span class="text-danger">Blocked</span>
                           @elseif ($item->status == 1)
                           <span class="text-success">Online</span>
                           @elseif ($item->status == 3)
                           <span class="text-secondary">Offline</span>
                           @endif
                        </td>
                     </tr>
                     {{-- modal --}}
                     <div class="modal fade" id="D{{ $item->id_pic }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="staticBackdropLabel">User - {{ $item->id_pic }}</h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <form action="{{ url('update_user/'. $item->id_pic) }}" method="post">
                                       @csrf
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static my-3">
                                             <label>Username</label>
                                             <input type="text" name="username" value="{{ $item->username }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static mb-4">
                                             <label for="exampleFormControlSelect1" class="ms-0">Role</label>
                                             <select name="role" class="form-control" id="exampleFormControlSelect1">
                                                @if ($item->role == 1)
                                                <option selected value="1">Admin</option>
                                                <option value="9">PIC</option>
                                                @else
                                                <option value="1">Admin</option>
                                                <option selected value="9">PIC</option>
                                                @endif
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-12">
                                          <div class="input-group input-group-static mb-4">
                                             <label for="exampleFormControlSelect1" class="ms-0">Status</label>
                                             <select name="status" class="form-control" id="exampleFormControlSelect1">
                                                @if ($item->status == 9)
                                                <option selected value="9">Blocked</option>
                                                {{-- <option value="1">Online</option> --}}
                                                <option value="3">Active</option>
                                                @elseif ($item->status == 3)
                                                <option value="9">Blocked</option>
                                                <option selected value="3">Active</option>
                                                @elseif ($item->status == 1)
                                                <option value="9">Blocked</option>
                                                <option selected value="3">Active</option>
                                                @endif
                                             </select>
                                          </div>
                                       </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                 <button type="submit" class="btn btn-info"
                                    onclick="return confirm('Apakah anda akan melakukan update data?')">Update</button>
                                 <a href="{{ url('reset_pass/'.$item->id_user) }}" class="btn btn-warning"
                                    onclick="return confirm('Reset Password?')">Reset Password</a>
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
            <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="row">
               <form action="{{ url('new_user') }}" method="post">
                  @csrf
                  <div class="col-md-12">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Pilih PIC</label>
                        <select name="id_pic" class="form-control" id="exampleFormControlSelect1">
                           <option>-- Select --</option>
                           @foreach ($data_pic as $items)
                           <option value="{{ $items->id_pic }}">{{ $items->id_pic }} - {{ $items->nama_pic }}</option>
                           @endforeach

                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-outline my-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Role</label>
                        <select name="role" class="form-control" id="exampleFormControlSelect1">
                           <option>-- Select --</option>
                           <option value="1">Admin</option>
                           <option value="9">PIC</option>
                        </select>
                     </div>
                  </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Buat Akun</button>
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