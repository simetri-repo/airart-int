<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/airarti/LOGO_AIRARTIKENNELS.png') }}">
   <link rel="icon" type="image/png" href="{{ asset('assets/airarti/LOGO_AIRARTIKENNELS.png') }}">
   <title>
      AirArtiKennels
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
   <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="bg-gray-200">

   <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
         <div class="col-12">
            <!-- Navbar -->
            @include('sweetalert::alert')
            {{-- <nav
               class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
               <div class="container-fluid ps-2 pe-0">
                  <div class="collapse navbar-collapse" id="navigation">
                     <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                           <a class="nav-link d-flex align-items-center me-2 active" aria-current="page">
                              <i class="fa fa-paw opacity-6 text-dark me-1"></i>
                              Intern-AIRARTIKENNELS
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav> --}}
            <!-- End Navbar -->
         </div>
      </div>
   </div>
   <main class="main-content  mt-0">
      <div class="page-header align-items-start min-vh-100"
         style="background-image:url({{ asset('assets/img/airarti/background.jpg') }});');">
         <span class="mask bg-gradient-dark opacity-6"></span>
         <div class="container my-auto">
            <div class="row">
               <div class="col-lg-4 col-md-8 col-12 mx-auto">
                  <div class="card z-index-0 fadeIn3 fadeInBottom">
                     <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-primary border-radius-lg py-3 pe-1 text-center">
                           {{-- <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">AirArtiKennels</h4> --}}
                           <img src="{{ asset('assets/img/airarti/LOGO_AIRARTIKENNELS.jpeg') }}"
                              style="height:100px; border-radius:10px" alt="">
                           {{-- <div class="row mt-3">
                              <div class="col-2 text-center ms-auto">
                                 <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-facebook text-white text-lg"></i>
                                 </a>
                              </div>
                              <div class="col-2 text-center px-1">
                                 <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-github text-white text-lg"></i>
                                 </a>
                              </div>
                              <div class="col-2 text-center me-auto">
                                 <a class="btn btn-link px-3" href="javascript:;">
                                    <i class="fa fa-google text-white text-lg"></i>
                                 </a>
                              </div>
                           </div> --}}
                        </div>
                     </div>
                     <div class="card-body">
                        <form role="form" class="text-start" method="post" action="{{ url('Login') }}">
                           @csrf
                           <div class="input-group input-group-outline my-3">
                              <label class="form-label">Username / NIK</label>
                              <input type="text" name="username" class="form-control">
                           </div>
                           <div class="input-group input-group-outline mb-3">
                              <label class="form-label">Password</label>
                              <input type="password" name="password" class="form-control">
                           </div>
                           <div class="text-center">
                              <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </main>
   <!--   Core JS Files   -->
   <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
   <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
   <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
   <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
   <script>
      var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
   </script>
   <!-- Github buttons -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
</body>

</html>