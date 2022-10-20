@extends('pic.mainPic')

@section('satwa-saya')
active bg-gradient-info
@endsection

@section('loc')
Satwa Saya
@endsection

@section('content')

<div class="container-fluid py-4">
   <div class="row">
      <div class="card">
         <div class="card-body">
            <h5 class="card-title">Table Satwa {{ session('id_pic') }}</h5>
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>ID Satwa</th>
                        <th>Nama Satwa</th>
                        <th>Ras</th>
                        <th>Kelamin</th>
                        <th>Usia</th>
                        <th>Kategori</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($response as $item)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <a href="" class="text-primary" data-bs-toggle="modal"
                              data-bs-target="#{{ $item->id_satwa }}">{{
                              $item->id_satwa }}</a></td>
                        <td>{{ $item->nama_satwa }}</td>
                        <td>{{ $item->nama_ras }}</td>
                        <td>@if ($item->jk == 1)
                           Jantan
                           @else
                           Betina
                           @endif</td>
                        <td>
                           {{ $item->umur_thn }} Thn/ {{ $item->umur_bln -
                           ($item->umur_thn*12) }} Bln/ {{
                           $item->umur_hari - ($item->umur_bln*30) }} Hari
                        </td>
                        <td>
                           @for ($i = 0; $i < $total_anakan; $i++) @if ($item->umur_bln <= $anakan[$i] -> max_usia and
                                 $item->umur_bln >= $anakan[$i]->min_usia)

                                 @if ( $anakan[$i]->keterangan_anakan == 'Indukan' AND $item->jk == 1)
                                 Pejantan
                                 @elseif($anakan[$i]->keterangan_anakan == 'Indukan' AND $item->jk == 2)
                                 Indukan
                                 @elseif($anakan[$i]->keterangan_anakan == 'Tua' AND $item->jk == 1)
                                 {{ $anakan[$i]->keterangan_anakan }} Jantan
                                 @elseif($anakan[$i]->keterangan_anakan == 'Tua' AND $item->jk == 2)
                                 {{ $anakan[$i]->keterangan_anakan }} Betina
                                 @else
                                 {{ $anakan[$i]->keterangan_anakan }}
                                 @endif
                                 @endif
                                 @endfor

                        </td>
                     </tr>
                     {{-- modal --}}
                     <div class="modal fade" id="{{ $item->id_satwa }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="staticBackdropLabel">Data - {{ $item->id_satwa }}</h5>
                                 <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close"><i class="fa fa-times"></i></button>
                              </div>
                              <div class="modal_body">
                                 <div class="col-sm-12">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <img src="{{ asset($item->foto_satwa) }}" style="width: 80% !important;"
                                             alt="foto satwa">
                                       </div>
                                       <div class="col-sm-6">
                                          <dl class="row mt-3">
                                             <dd class="col-sm-3">Nama Satwa</dd>
                                             <dt class="col-sm-9">: {{ $item->nama_satwa }}</dt>
                                             <dd class="col-sm-3">Ras</dd>
                                             <dt class="col-sm-9">: {{ $item->nama_ras }}</dt>
                                             <dd class="col-sm-3">Jenis Kelamin</dd>
                                             <dt class="col-sm-9">:
                                                @if ($item->jk == 1)
                                                Jantan
                                                @else
                                                Betina
                                                @endif</dt>
                                             <dd class="col-sm-3">Usia</dd>
                                             <dt class="col-sm-9">: {{ $item->umur_thn }} Thn/ {{ $item->umur_bln -
                                                ($item->umur_thn*12) }} Bln/ {{
                                                $item->umur_hari - ($item->umur_bln*30) }} Hari</dt>
                                             <dd class="col-sm-3">Tgl Lahir</dd>
                                             <dt class="col-sm-9">: {{ $item->tgl_lhr }}</dt>
                                             <dd class="col-sm-3">Takaran</dd>
                                             <dt class="col-sm-9">: {{ $item->takaran }} <i
                                                   class="text-success">gram/day</i>
                                             </dt>
                                             <hr>
                                             <dd class="col-sm-3">PIC PJ</dd>
                                             <dt class="col-sm-9">:
                                                @if ($item->pic_pj == null)
                                                -
                                                @else
                                                {{ $item->pic_pj }}
                                                @endif
                                             </dt>
                                          </dl>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            <h5 class="modal-title" id="staticBackdropLabel">Tambah Satwa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ url('new_satwa') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-12">
                     <div class="input-group input-group-static my-3">
                        <label>Nama Satwa</label>
                        <input type="text" name="nama_satwa" required class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static my-3">
                        <label>Foto Satwa <span class="text-danger">(MAX 2MB)</span></label>
                        <input type="file" name="foto_satwa" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Ras</label>
                        <select name="ras" class="form-control" id="exampleFormControlSelect1" required>
                           <option value="" disabled selected>-- select --</option>
                           @foreach ($ras as $itemras)
                           <option value="{{ $itemras->id_ras }}"> {{ $itemras->nama_ras }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select name="jk" class="form-control" id="exampleFormControlSelect1" required>
                           <option value="" disabled selected>-- select --</option>
                           <option value="1">Jantan</option>
                           <option value="2">Betina</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Induk Jantan</label>
                        <select name="induk_jantan" class="form-control" id="exampleFormControlSelect1" required>
                           <option value="" disabled selected>-- select --</option>
                           @foreach ($induk_jantan as $ij)
                           <option value="{{ $ij->id_satwa }}">{{ $ij->id_satwa }} - {{ $ij->nama_satwa }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Induk Betina</label>
                        <select name="induk_betina" class="form-control" id="exampleFormControlSelect1" required>
                           <option value="" disabled selected>-- select --</option>
                           @foreach ($induk_betina as $ib)
                           <option value="{{ $ib->id_satwa }}">{{ $ib->id_satwa }} - {{ $ib->nama_satwa }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static my-3">
                        <label>Tgl Lahir</label>
                        <input type="date" name="tgl_lhr" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">PIC PJ</label>
                        <select name="pic_pj" class="form-control" id="exampleFormControlSelect1" required>
                           <option value="" disabled selected>-- select --</option>
                           @foreach ($dt_pic as $pic)
                           <option value="{{ $pic->id_pic }}">{{ $pic->id_pic }} - {{ $pic->nama_pic }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="input-group input-group-static my-3">
                        <label>Takran gram/day</label>
                        <input type="text" name="takaran" required class="form-control">
                     </div>
                  </div>
                  {{-- --}}
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
               buttons: [ 'excel', 'pdf'],
               "pagingType": "numbers"
            });
         });
   
</script>
@endsection