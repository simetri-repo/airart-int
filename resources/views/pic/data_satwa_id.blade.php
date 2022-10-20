@extends('pic.mainPic')

@section('data-satwa')
active bg-gradient-info
@endsection

@section('loc')
Data Satwa {{ $response[0]->nama_satwa }}
@endsection

@section('content')

<div class="container-fluid py-1">
   <div class="row">
      <div class="card">
         <div class="card-body">
            <form action="{{ url('update_satwa/'.$response[0]->id_satwa) }}" method="post"
               enctype="multipart/form-data">
               <div class="row">
                  @csrf
                  <div class="col-md-3" align="center">
                     <img src="{{ asset($response[0]->foto_satwa) }}" style="height: auto; width:200px">
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static my-3">
                        <label>Foto Satwa</label>
                        <input type="text" name="foto_satwa" readonly value="{{ $response[0]->foto_satwa }}"
                           class="form-control">
                     </div>
                     <div class="col-md-6">
                        <label>Ganti Foto Satwa <span class="text-danger">(MAX 2MB)</span></label>
                        <input type="file" name="foto_satwa_up" class="form-control">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4 my-5">
                        <label>Nama Satwa</label>
                        <input type="text" name="nama_satwa" value="{{ $response[0]->nama_satwa }}"
                           class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4 my-5">
                        <label for="exampleFormControlSelect1" class="ms-0">Ras</label>
                        <select name="ras" class="form-control" id="exampleFormControlSelect1">
                           <option value="{{ $response[0]->id_ras }}"> {{ $response[0]->nama_ras }}
                           </option>
                           <option>--------------------</option>
                           @foreach ($ras as $ras)
                           <option value="{{ $ras->id_ras }}"> {{ $ras->nama_ras }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                        <select name="jk" class="form-control" id="exampleFormControlSelect1">
                           @if ($response[0]->jk == 1)
                           <option selected value="1">Jantan</option>
                           <option value="2">Betina</option>
                           @else
                           <option value="1">Jantan</option>
                           <option selected value="2">Betina</option>
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Induk Jantan</label>
                        <select name="induk_jantan" class="form-control" id="exampleFormControlSelect1">
                           <option value="{{ $response[0]->id_ayah }}">
                              @if ($response[0]->id_ayah == 0)
                              Tidak ada
                              @else
                              {{ $response[0]->id_ayah }}
                              @endif
                           </option>
                           <option>--------------------</option>
                           @foreach ($induk_jantan as $ij)
                           <option value="{{ $ij->id_satwa }}">{{ $ij->id_satwa }} - {{
                              $ij->nama_satwa }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">Induk Betina</label>
                        <select name="induk_betina" class="form-control" id="exampleFormControlSelect1">
                           <option value="{{ $response[0]->id_ibu }}">
                              @if ($response[0]->id_ibu == 0)
                              Tidak ada
                              @else
                              {{ $response[0]->id_ibu }}
                              @endif
                           </option>
                           @foreach ($induk_betina as $ib)
                           <option value="{{ $ib->id_satwa }}">{{ $ib->id_satwa }} - {{
                              $ib->nama_satwa }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6 ">
                     <div class="input-group input-group-static mb-4">
                        <label>Tgl Lahir</label>
                        <input type="date" name="tgl_lhr" value="{{ $response[0]->tgl_lhr }}" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="input-group input-group-static mb-4">
                        <label for="exampleFormControlSelect1" class="ms-0">PIC PJ</label>
                        <select name="pic_pj" class="form-control" id="exampleFormControlSelect1" required>
                           @if ($response[0]->pic_pj == null)
                           <option value="" disabled selected>-- select --</option>
                           @else
                           <option value="{{ $response[0]->pic_pj }}" selected>{{$response[0]->pic_pj}}
                           </option>
                           @endif
                           @foreach ($dt_pic as $pic)
                           <option value="{{ $pic->id_pic }}">{{ $pic->id_pic }} - {{
                              $pic->nama_pic }}</option>
                           @endforeach
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6 ">
                     <div class="input-group input-group-static mb-4">
                        <label>Takaran gram/day</label>
                        <input type="text" name="takaran" value="{{ $response[0]->takaran }}" class="form-control"
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                     </div>
                  </div>
                  {{-- --}}
               </div>
         </div>
         <div class="card-footer">

            <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i>
               Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ url('hapus_satwa/'. $response[0]->id_satwa)}}" class="btn btn-danger"
               onclick="return confirm('Apakah anda akan menghapus data ini?')">Hapus</a>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection