@extends('pic.mainPic')

@section('cari-satwa')
active bg-gradient-info
@endsection

@section('loc')
Cari Satwa
@endsection

@section('content')

<div class="container-fluid py-4">
   <div class="col-lg-12">
      <div class="row">
         <div class="col-lg-3">
            <div class="card">
               <img class="card-img-top" src="holder.js/100x180/" alt="">
               <div class="card-body">
                  <h4 class="card-title">Cari Profile Satwa</h4>
                  <form method="post" action="{{ url('admCarisatwa') }}">
                     @csrf
                     <div class="row">
                        <div class="col-md-12">
                           <div class="input-group input-group-outline my-3">
                              <label class="form-label">ID Satwa</label>
                              <input type="text" name="id_satwa" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-outline my-3">
                              <label class="form-label">Nama Satwa</label>
                              <input type="text" name="nama_satwa" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Ras Satwa</label>
                              <select class="form-control" name="ras" id="exampleFormControlSelect1">
                                 <option value="">-- select --</option>
                                 @foreach ($ras as $item)
                                 <option value="{{ $item->id_ras }}">{{ $item->nama_ras }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group input-group-static mb-4">
                              <label for="exampleFormControlSelect1" class="ms-0">Jenis Kelamin</label>
                              <select class="form-control" name="jk" id="exampleFormControlSelect1">
                                 <option value="">-- select --</option>
                                 <option value="1">Jantan</option>
                                 <option value="2">Betina</option>
                              </select>
                           </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center p-2">
                           <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-lg-9">
            <div class="d-grid gap-2 d-md-flex justify-content-md-center p-2 mt-2">
               <h3 class="mx-auto">RESULT : {{ $total }}</h3>
            </div>
            {{-- --}}
            <div class="list-wrapper">
               <div class="col-lg-12 row">
                  {{-- list item --}}
                  @foreach ($response as $item_satwa)
                  <div class="col-lg-3 col-md-6 col-sm-6  list-item">
                     <div class="content">
                        <a href="{{ url('admProfsat/'.$item_satwa->id_satwa) }}">
                           <div class="content-overlay"></div>
                           <img class="content-image" src="{{ asset($item_satwa->foto_satwa) }}" />
                           <div class="content-details fadeIn-bottom">
                              <h3 class="content-title">{{ $item_satwa->id_satwa }} - {{ $item_satwa->nama_satwa }}</h3>
                           </div>
                        </a>
                     </div>
                  </div>
                  @endforeach

                  {{-- end list item --}}
               </div>
            </div>
            {{-- paging --}}
            @if ($total < 5) @else <div id="pagination-container" class="mt-2">
               @endif
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