@extends('pic.mainPic')

@section('dashboard')
active bg-gradient-info
@endsection

@section('loc')
Dashboard
@endsection

@section('content')

<div class="container-fluid py-4">
   {{-- jumlah data --}}
   <div class="row">
      {{-- <div class="col-xl-4 col-sm-2 mb-xl-0 mb-4 col-md-2">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div
                  class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">account_circle</i>
               </div>
               <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Hi, Welcome.. </p>
                  <h4 class="mb-0">{{ session('username') }}</h4>
               </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               <div class="text-center">
                  <p class="mb-0">
                     NIK : {{ session('id_pic') }}
                  </p>
               </div>
            </div>
         </div>
      </div> --}}
      <div class="col-xl-4 col-sm-12 mb-xl-0 mb-4 col-md-4">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div
                  class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">done_all</i>
               </div>
               <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Jumlah List</p>
                  <h4 class="mb-0">{{ $jml_reminder }}</h4>
                  {{-- <h4>{{ session('time_log') }}</h4> --}}
               </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               <div class="text-center">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">{{ $jml_reminder_done }}
                     </span>Selesai, <span class="text-warning text-sm font-weight-bolder">{{ $jml_reminder_progress }}
                     </span> Progress, <span class="text-danger text-sm font-weight-bolder">{{ $jml_reminder_cancelled
                        }}
                     </span> Cancelled</p>
               </div>
            </div>
         </div>
      </div>
      {{-- --}}
      <div class="col-xl-8 col-sm-12 mb-xl-0 mb-4 col-md-8">
         <div class="card">
            <div class="card-header p-3 pt-2">
               <div
                  class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                  <i class="material-icons opacity-10">pets</i>
               </div>
               <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Jumlah Satwa</p>
                  <h4 class="mb-0">{{ $jml_satwa }}</h4>
               </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
               <div class="text-center">
                  <p class="mb-0">
                     {{-- Male : <span class="text-info text-sm font-weight-bolder">{{ $jml_satwa_male }} </span>,
                     Female : <span class="text-primary text-sm font-weight-bolder"> {{ $jml_satwa_female }} </span>
                     <br> --}}
                     @foreach ($r_anakan as $anakan)
                     <span class="text-info text-sm font-weight-bolder">{{ $v_induk[$anakan->keterangan_anakan] }}
                     </span>{{ $anakan->keterangan_anakan }},
                     @endforeach
                  </p>
               </div>
            </div>
         </div>
      </div>

      {{-- --}}
      <div class="list-wrapper mt-4">
         <div class="col-lg-12 row">
            {{-- list item --}}
            {{-- <div class="col-lg-3 col-md-6 col-sm-6 mt-4 list-item">
               <div class="content">
                  <a href="{{ url('admProfsat') }}">
                     <div class="content-overlay"></div>
                     <img class="content-image" src="../assets/img/airarti/1.jpg" />
                     <div class="content-details fadeIn-bottom">
                        <h3 class="content-title">Nama Satwa</h3>
                        <p class="content-text"><i class="fa fa-map-marker"></i> Russia</p>
                     </div>
                  </a>
               </div>
            </div> --}}
            @foreach ($data_satwa as $item_satwa)
            <div class="col-lg-3 col-md-6 col-sm-6 mt-0 list-item">
               <div class="content">
                  <a href="{{ url('admProfsat/'.$item_satwa->id_satwa) }}">
                     <div class="content-overlay"></div>
                     <img class="content-image" src="{{ asset($item_satwa->foto_satwa) }}"
                        alt="{{ $item_satwa->id_satwa }}" />
                     <div class="content-details fadeIn-bottom">
                        <h3 class="content-title">{{ $item_satwa->id_satwa }} - {{ $item_satwa->nama_satwa }}</h3>
                        <h6 class="text-white">{{ $item_satwa->nama_ras }}</h6>
                     </div>
                  </a>
               </div>
            </div>
            @endforeach




            {{-- end list item --}}
         </div>
      </div>
      {{-- paging --}}
      <div id="pagination-container" class="mt-2"></div>
      {{-- end paging --}}

      {{-- end content --}}
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

   @media only screen and (max-width: 600px) {
      .content {
         height: 300px;
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
      font-weight: 300;
      font-size: 1.7em;
      margin-bottom: 0.5em;
      text-transform: uppercase
   }

   .content-details p {
      color: #fff;
      font-size: 0.3em
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
var perPage = 8;

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
@endsection