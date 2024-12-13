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



@stack('myscript')
