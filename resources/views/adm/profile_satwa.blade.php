@extends('adm.mainAdm')

@section('cari-satwa')
active bg-gradient-info
@endsection

@section('loc')
Profile Satwa
@endsection

@section('content')

<div class="container-fluid py-4">
   <div class="row">
      <div class="card">
         <img class="card-img-top" src="holder.js/100x180/" alt="">
         <div class="card-body">
            <h4 class="card-title">Profile Satwa</h4>
            <form>
               <div class="row">
                  <div class="col-md-3">
                     <img class="profile-satwa" src="{{ asset($response[0]->foto_satwa) }}"
                        style="max-height:500px; width:100%;" alt="">
                  </div>
                  <div class="col-md-5">
                     <dl class="row">
                        <dt class="col-sm-4">ID Satwa</dt>
                        <dd class="col-sm-8">: {{ $response[0]->id_satwa }}</dd>
                        <dt class="col-sm-4">Nama Satwa</dt>
                        <dd class="col-sm-8">: {{ $response[0]->nama_satwa }}</dd>
                        <dt class="col-sm-4">TRAH</dt>
                        <dd class="col-sm-8">: {{ $response[0]->nama_ras }}</dd>
                        <dt class="col-sm-4">Induk Jantan</dt>
                        <dd class="col-sm-8">:
                           @if ($response[0]->id_ayah == 0)
                           Tidak Ada
                           @else
                           {{ $response[0]->id_ayah }}
                           @endif
                        </dd>
                        <dt class="col-sm-4">Induk Betina</dt>
                        <dd class="col-sm-8">:
                           @if ($response[0]->id_ibu == 0)
                           Tidak Ada
                           @else
                           {{ $response[0]->id_ibu }}
                           @endif
                        </dd>
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8">: @if ($response[0]->jk == 1)
                           Jantan
                           @else
                           Betina
                           @endif </dd>
                        <dt class="col-sm-4">Usia</dt>
                        <dd class="col-sm-8">: {{ $usia[0]->umur_thn }} Thn/ {{ $usia[0]->umur_bln -
                           ($usia[0]->umur_thn*12) }} Bln/ {{
                           $usia[0]->umur_hari - ($usia[0]->umur_bln*30) }} Hari</dd>
                        <dt class="col-sm-4">Kategori</dt>
                        <dd class="col-sm-8">:
                           @for ($i = 0; $i < $total_anakan; $i++) @if ($usia[0]->umur_bln <= $anakan[$i] -> max_usia
                                 and $usia[0]->umur_bln >= $anakan[$i]->min_usia)
                                 @if ( $anakan[$i]->keterangan_anakan == 'Indukan' AND $response[0]->jk == 1)
                                 Pejantan
                                 @elseif($anakan[$i]->keterangan_anakan == 'Indukan' AND $response[0]->jk == 2)
                                 Indukan
                                 @else
                                 {{ $anakan[$i]->keterangan_anakan }}
                                 @endif
                                 @endif
                                 @endfor</dd>
                     </dl>
                  </div>
                  <div class="col-md-4">
                     <dl class="row">
                        <dt class="col-sm-5">Tanggal Lahir</dt>
                        <dd class="col-sm-7">: {{ $response[0]->tgl_lhr }}</dd>
                        {{-- <dt class="col-sm-5">Kondisi</dt>
                        <dd class="col-sm-9">: 7akit</dd> --}}
                        {{-- <dt class="col-sm-5">Status</dt>
                        <dd class="col-sm-9">: 7ens</dd> --}}
                        <dt class="col-sm-5">Berat </dt>
                        <dd class="col-sm-7">: {{ $response[0]->bb }} Kg</dd>
                        <dt class="col-sm-5">Tinggi </dt>
                        <dd class="col-sm-7">: {{ $response[0]->tinggi }} Cm</dd>
                        <dt class="col-sm-5">Panjang </dt>
                        <dd class="col-sm-7">: {{ $response[0]->panjang }} Cm</dd>
                        <dt class="col-sm-5">Lokasi</dt>
                        <dd class="col-sm-7">: {{ $response[0]->lokasi }}</dd>
                        <dt class="col-sm-5">PIC</dt>
                        <dd class="col-sm-7">:
                           @if ($response[0]->pic_pj == null)
                           -
                           @else
                           {{ $response[0]->pic_pj }}
                           @endif </dd>
                        <dt class="col-sm-5">Update History By</dt>
                        <dd class="col-sm-7">: {{ $response[0]->pic_update }} </dd>
                     </dl>
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-center p-2">
                     <a href="{{ url('admCarisat') }}" class="btn btn-info"><i class="fas fa-caret-left"></i>
                        Kembali</a>
                     <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop1"><i class="fas fa-history"></i>
                        History</button>
                     <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop3"><i class="fas fa-bell"></i>
                        Reminder</button>
                  </div>
               </div>
            </form>
         </div>
      </div>

   </div>
</div>
{{-- modal 1 --}}
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">History {{ $response[0]->id_satwa }} - {{
               $response[0]->nama_satwa }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table id="dt_table" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>Status</th>
                        <th>BB</th>
                        <th>Tinggi</th>
                        <th>Panjang</th>
                        <th>Lokasi</th>
                        <th>Update</th>
                        <th>PIC</th>
                        <th>Note</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($history as $item)
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
                        <td>{{ $item->update_akhir }}</td>
                        <td>{{ $item->update_oleh }}</td>
                        <td>{{ $item->note }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
         </div>
      </div>
   </div>
</div>

{{-- modal 3 --}}
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-xl">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Reminder {{ $response[0]->id_satwa }} - {{
               $response[0]->nama_satwa }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table id="dt_table2" class="display table table-striped" style="width:100%">
                  <thead>
                     <tr>
                        <th>Keterangan</th>
                        <th>Tgl Kegiatan</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>PIC</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($reminder as $item)
                     <tr>
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
                        <td>{{ $item->note }}</td>
                        <td>{{ $item->pic_r }}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
         </div>
      </div>
   </div>
</div>
@endsection

@section('style')
<style>
   .simple-pagination ul {
      margin: 0 0 20px;
      padding: 0;
      list-style: none;
      text-align: center;
   }

   .simple-pagination li {
      display: inline-block;
      margin-right: 5px;
   }

   .simple-pagination li a,
   .simple-pagination li span {
      color: #666;
      padding: 5px 10px;
      text-decoration: none;
      border: 1px solid #EEE;
      background-color: #FFF;
      box-shadow: 0px 0px 10px 0px #EEE;
   }

   .simple-pagination .current {
      color: #FFF;
      background-color: #4087f1;
      border-color: #7197ff;
   }

   .simple-pagination .prev.current,
   .simple-pagination .next.current {
      background: #4e64e0;
   }

   /* image */


   .content {
      position: relative;
      /* margin: auto; */
      height: 230px;
      overflow: hidden;
   }

   @media only screen and (min-width: 1399px) {
      .content {
         height: 300px;
      }
   }

   @media only screen and (max-width: 1024px) {
      .content {
         height: 200px;
      }
   }

   .content .content-overlay {
      background: rgba(0, 0, 0, 0.5);
      position: absolute;
      height: 80%;
      width: 100%;
      left: 0;
      top: 0;
      bottom: 0;
      right: 0;
      opacity: 0;
      -webkit-transition: all 0.4s ease-in-out 0s;
      -moz-transition: all 0.4s ease-in-out 0s;
      transition: all 0.4s ease-in-out 0s
   }

   .content:hover .content-overlay {
      opacity: 1
   }

   .content-image {
      height: 80%;
      width: 100%;
   }

   img {
      box-shadow: 1px 1px 5px 1px rgba(0, 0, 0, 0.1);
      border-radius: 5px
   }

   .content-details {
      position: absolute;
      text-align: center;
      padding-left: 1em;
      padding-right: 1em;
      width: 100%;
      top: 50%;
      left: 50%;
      opacity: 0;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      -webkit-transition: all 0.3s ease-in-out 0s;
      -moz-transition: all 0.3s ease-in-out 0s;
      transition: all 0.3s ease-in-out 0s
   }

   .content:hover .content-details {
      top: 50%;
      left: 50%;
      opacity: 1
   }

   .content-details h3 {
      color: #fff;
      letter-spacing: 0.15em;
      margin-bottom: 0.5em;
      text-transform: uppercase
   }

   .content-details p {
      color: #fff;
      font-size: 0.5em
   }

   .fadeIn-bottom {
      top: 50%
   }
</style>
@endsection

@section('script')
{{-- <script src="http://flaviusmatis.github.io/simplePagination.js/"></script> --}}
<script>
   var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 4;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});
</script>

<script type="text/javascript">
   $(document).ready(function() {
            $('#dt_table').dataTable({
               dom: 'Bfrtip',
               buttons: ['excel', 'pdf'],
               "pagingType": "numbers"
            });
         });
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('#dt_table1').dataTable({
   dom: 'Bfrtip',
   buttons: ['excel', 'pdf'],
   "pagingType": "numbers"
   });
   });
   $(document).ready(function() {
   $('#dt_table2').dataTable({
   dom: 'Bfrtip',
   buttons: ['excel', 'pdf'],
   "pagingType": "numbers"
   });
   });
   
</script>
@endsection