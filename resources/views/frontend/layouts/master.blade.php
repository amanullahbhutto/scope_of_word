<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Provincial Assembly of Sindh</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="{{ asset('front/css/fonts.googleapis.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('front/css/step-style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



<!-- DataTables Bootstrap 4 Integration -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

<style>
    .header-background {
        background-color: #f6f6f6;
        padding: 40px;
        width: 90%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        margin: 0 auto; /* Centers the box horizontally */
        
    }

    .header-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        background: #fffbe0;
        z-index: -1;
        transform: rotate(-45deg) translate(-50%, 50%);
    }

    .line {
        border-top: 1px solid#00bf63;
        margin: 20px auto; /* Centers the line horizontally */
        width: 90%; /* Sets the line width to 80% of the container */
    }

    .footer-text {
        margin-bottom: 10px;
    }

    .table-container {
        margin-top: 30px;
    }

    .stats-table th {
        background-color:#00bf63;
        color: white;
    }

    .stats-table td {
        padding: 20px;
    }
</style>

</head>
<body class="d-flex flex-column min-vh-100">

    @include('frontend.layouts.header')

    <!-- Main Content Section -->
    <div class="container mt-5 flex-grow-1">
        @yield('content')
    </div>

    @include('frontend.layouts.footer')

 @stack('scripts')
</body>
</html>
