<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Pasien</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/css/vendor.bundle.base.css') }}">
    <link
        rel="stylesheet"href="{{ asset('assets/src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/src/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/js/select.dataTables.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/src/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">

</head>

<body>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <div class="me-3">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                    data-bs-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
            </div>
            <div>
                <a class="navbar-brand brand-logo" href="/panel/dashboardadmin">
                    <img src="{{ asset('assets/img/favicon.png') }}" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="index.html">
                    <img src="{{ asset('assets/img/favicon.png') }}" alt="logo" />
                </a>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
            <ul class="navbar-nav">
                <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                    <span class="text-black fw-bold" style="font-size:20px;">Pasien</span>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item d-none d-lg-block">
                    <div class="input-group date datepicker navbar-date-picker">
                        <span class="input-group-addon input-group-prepend border-right">
                            <span class="icon-calendar input-group-text calendar-icon"></span>
                        </span>
                        <input type="text" class="form-control" value="{{ date('d/M/Y') }}">
                    </div>
                </li>
                <li class="nav-item d-none d-lg-block">
                    <div class="input-group date datepicker navbar-date-picker">
                        <div class="clock" id="clock"></div>
                    </div>


                </li>
                <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                    <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img class="img-xs rounded-circle"
                            src="{{ asset('/assets/img/favicon.png') }}" alt="Profile image">
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>

    <div class="container-fluid page-body-wrapper d-flex">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            @include('layouts.sidebarPasien')
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-12 col-sm-12 col-md-9 ml-sm-auto col-lg-10 px-4 px-sm-3">
            @yield('content')
        </main>

    </div>

    <!-- plugins:js -->
<script src="{{ asset('assets/src/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/src/assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('assets/src/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/src/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/template.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/settings.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/src/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/src/assets/js/dashboard.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap Datepicker CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tanggal').datepicker({
            format: 'dd-mm-yyyy', // Format tanggal
            autoclose: true, // Menutup otomatis setelah memilih tanggal
            todayHighlight: true // Menyoroti tanggal hari ini
        });
    });
</script>

<script>
     function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = currentTime;
        }

        setInterval(updateClock, 1000); // Update clock every second
        updateClock(); // Initial call to display the clock immediately
</script>

</body>


</html>
