<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html class="h-100" lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
      <meta name="description" content="A growing collection of ready to use components for the CSS framework Bootstrap 5">
      <meta name="author" content="Holger Koenemann">
      <meta name="generator" content="Eleventy v2.0.0">
      <meta name="HandheldFriendly" content="true">
      <title>@yield('title', 'Sindh IT Industry, Products and Services Registry')</title>

      <!-- CSS Files -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('seic/css/jquery.dataTables.min.css') }}">
      <link rel="stylesheet" href="{{ asset('seic/css/buttons.dataTables.min.css') }}">
      <link rel="stylesheet" href="{{ asset('seic/css/select2.min.css') }}">

 
      <!-- Custom Styles -->
      <style>
          /* Your existing styles here */
          .additional-row {
              background-color: #f9f9f9;
          }
          /* Additional table and font styles here */
          #navScroll {
              background-color: green;
          }
      </style>
      @yield('custom_styles') <!-- Section for adding page-specific styles -->
  </head>

  <body data-bs-spy="scroll" data-bs-target="#navScroll">
      <!-- Navbar -->
      <nav id="navScroll" class="navbar navbar-expand-lg navbar-light fixed-top" tabindex="0">
          <div class="container">
              <a class="navbar-brand pe-4 fs-4" href="/">
                  <img src="{{ asset('images/new-home/new-logo.png') }}" class="img-fluid" alt="Logo">
              </a>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                          <span class="nav-link ms-1 fw-bolder" style="color:#fff;font-size:24px;">
                              Information Science & Technology Department Government of Sindh
                          </span>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>

      <!-- Main Content -->
      <main style="margin-top: 100px;">
          @yield('content') <!-- This will render the content of the extending views -->
      </main>

      <!-- Scripts -->
      <script>
          @yield('custom_scripts') <!-- Section for adding page-specific scripts -->
      </script>
           <!-- JS Files -->
           <script src="{{ asset('seic/js/jquery-3.5.1.min.js') }}"></script>
      <script src="{{ asset('seic/js/select2.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>