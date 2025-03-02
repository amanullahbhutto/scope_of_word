<footer class="text-center py-4 bg-light mt-auto">
    <p class="mb-0">© 2024 Stepon. All rights reserved. No parts of this site may be copied without our written permission.</p>
</footer>
<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- DataTables Bootstrap 4 Integration JS -->
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!-- Bootstrap 4 JS (required for DataTables Bootstrap 4 integration) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('front/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

<script>
toastr.options = {
    "closeButton": true,       // Allow closing the toastr with a button
    "debug": false,
    "newestOnTop": true,       // Toast appears at the top of the screen
    "progressBar": true,       // Show a progress bar
    "positionClass": "toast-top-right",  // Position on the screen
    "preventDuplicates": true, // Prevent multiple notifications of the same type
    "showDuration": "300",     // Animation duration
    "hideDuration": "1000",    // Hide animation duration
    "timeOut": "5000",         // Time before it disappears
    "extendedTimeOut": "1000"  // Time before disappearing when hovered
};

</script>

