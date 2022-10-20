<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
   <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
   <title>
      Intern AirArtiKennels
   </title>
   <!--     Fonts and icons     -->
   <link rel="stylesheet" type="text/css"
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
   <!-- Nucleo Icons -->
   <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
   <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
   <!-- Font Awesome Icons -->
   <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
   <!-- Material Icons -->
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
   <!-- CSS Files -->
   <!-- MDB -->
   {{--
   <link href={{ asset() }}"https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
   --}}

   <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
   @yield('style')
   <style>
      html,
      body {
         margin: 0;
         height: 100%;
         overflow: hidden
      }

      input[type=search] {
         background: rgb(247, 247, 247) !important;
         border: 1px solid rgb(189, 188, 188);
      }
   </style>
</head>

<body class="g-sidenav-show bg-gray-200">
   <aside
      class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
      id="sidenav-main">
      <div class="sidenav-header">
         <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
         <a class="navbar-brand m-0" href="{{ url('admHome') }}" target="_blank">
            <img src="{{ asset('assets/img/airarti/LOGO_AIRARTIKENNELS.jpeg')}}" class="navbar-brand-img h-100"
               alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">AIRARTIKENNELS</span>
         </a>
      </div>
      <hr class="horizontal light mt-0 mb-2">
      <div class="collapse navbar-collapse  w-auto m-2" style="height: 100%;" id="sidenav-collapse-main">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link text-white @yield('dashboard')" href="{{ url('admHome') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">dashboard</i>
                  </div>
                  <span class="nav-link-text ms-1">Dashboard</span>
               </a>
            </li>
            {{--
            <hr class="horizontal light mt-0 mb-2"> --}}
            <li class="nav-item">
               <a class="nav-link text-white @yield('data-satwa')" href="{{ url('admDatsat') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">table_view</i>
                  </div>
                  <span class="nav-link-text ms-1">Data Satwa</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white @yield('data-history')" href="{{ url('admDathistory') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">history</i>
                  </div>
                  <span class="nav-link-text ms-1">Data History</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white @yield('reminder')" href="{{ url('admRemin') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">notifications</i>
                  </div>
                  <span class="nav-link-text ms-1">Reminder</span>
               </a>
            </li>

            <hr class="horizontal light mt-0 mb-2">
            <li class="nav-item">
               <a class="nav-link text-white @yield('satwa-saya')" href="{{ url('picSatwaSaya') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">rounded_corner</i>
                  </div>
                  <span class="nav-link-text ms-1">Satwa Saya</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white @yield('cari-satwa')" href="{{ url('admCarisat') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">search</i>
                  </div>
                  <span class="nav-link-text ms-1">Profile Satwa</span>
               </a>
            </li>
            <hr class="horizontal light mt-0 mb-2">
            <li class="nav-item">
               <a class="nav-link text-white @yield('data_saya')" href="{{ url('dataSaya') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">account_circle</i>
                  </div>
                  <span class="nav-link-text ms-1">Data Saya</span>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white @yield('data_saya')" href="{{ url('Logout') }}">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                     <i class="material-icons opacity-10">exit_to_app</i>
                  </div>
                  <span class="nav-link-text ms-1">LogOut</span>
               </a>
            </li>
         </ul>
      </div>

   </aside>
   <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
         navbar-scroll="true">
         <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                  <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                  <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('loc')</li>
               </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
               <div class="ms-md-auto pe-md-3 d-flex align-items-center">

               </div>
               <ul class="navbar-nav  justify-content-end">

                  <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                     <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                           <i class="sidenav-toggler-line"></i>
                           <i class="sidenav-toggler-line"></i>
                           <i class="sidenav-toggler-line"></i>
                        </div>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- End Navbar -->

      @include('sweetalert::alert')
      {{-- content --}}
      @yield('content')
   </main>
   <!--   Core JS Files   -->
   <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
   <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
   <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
   <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
   <!-- Github buttons -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0')}}"></script>
   {{-- data table --}}
   <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
   <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/r-2.2.9/datatables.min.css" />

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
   <script type="text/javascript"
      src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-html5-2.0.1/b-print-2.0.1/r-2.2.9/datatables.min.js">
   </script>

   @yield('script')
</body>

</html>