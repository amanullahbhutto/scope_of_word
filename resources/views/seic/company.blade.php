<!doctype html>
<html class="h-100" lang="en">

  <head>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
  <meta name="description" content="A growing collection of ready to use components for the CSS framework Bootstrap 5">
  <!-- <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png"> -->
<!--   <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('seic/img/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('seic/img/favicon-16x16.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('seic/.t/img/favicon.png')}}"> -->
  <meta name="author" content="Holger Koenemann">
  <meta name="generator" content="Eleventy v2.0.0">
  <meta name="HandheldFriendly" content="true">
  <title> IT Industry, Products and Services Registry</title>
  <link rel="stylesheet" href="{{ asset('seic/css/theme.min.css')}}">



    <link rel="stylesheet" href="{{ asset('seic/css/jquery.dataTables.min.css')}}">
    {{-- <link rel="stylesheet" href="{{ asset('seic/css/buttons.dataTables.min.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('seic/css/select2.min.css')}}">

    <script src="{{ asset('seic/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('seic/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
.additional-row {
    background-color: #f9f9f9;
}

.form-multi-select {
            width: 100%;
        }

        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.dataTables_filter{
    padding-bottom: 20px;
}
.dataTables_length{
    padding-top: 35px;
}

.paginate_button.active {
    background-color: #333; /* or whatever your desired active color is */
    color: #fff; /* text color */
}

/* inter-300 - latin */
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: local(''),
       url('./seic/fonts/inter-v12-latin-300.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./seic/fonts/inter-v12-latin-300.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}

@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: local(''),
       url('./seic/fonts/inter-v12-latin-500.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./seic/fonts/inter-v12-latin-500.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}
@font-face {
  font-family: 'Inter';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: local(''),
       url('./seic/fonts/inter-v12-latin-700.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
       url('./seic/fonts/inter-v12-latin-700.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
}
#navScroll {
    background-color: green;
}
#cityChart {
    width: 100% !important;
    height: auto !important;
}

</style>

  </head>

  <body data-bs-spy="scroll" data-bs-target="#navScroll">
  <!-- <nav id="navScroll" class="navbar navbar-expand-lg navbar-light fixed-top" tabindex="0">
    <div class="container">
       
        <a class="navbar-brand pe-4 fs-4" href="/">
            <img src="{{ asset('images/new-home/new-logo.png') }}" class="img-fluid" alt="Logo">
        </a>

    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <span class="nav-link ms-1 fw-bolder"  style="color :#fff;font-size: 24px; " >Information Science & Technology Department Government of Sindh</span>
                </li>
            </ul>
        </div>
    </div>
</nav> -->

    <main style="margin-top: 135px;">

    

<div class="position-relative overflow-hidden w-100 bg-light" id="gallery">




<div class="container-fluid">
    <!-- <div class="row justify-content-center" style="padding-top:22px;">
        <div class="col-md-6" style="border-bottom:1px solid #4a4a4a;">
            <canvas id="cityChart" width="200" height="100"></canvas>
        </div>
    </div> -->
    <!-- overflow-scroll -->
    <div class="row">
        
        <div class="col-9">
            <div class="mx-auto" bis_skin_checked="1">
                <h2 class="py-5 border-dark text-center aos-init aos-animate" data-aos="fade-center" style="font-weight: bold; font-size: 2rem; line-height: 1.5; color: #4A4A4A;">
                    IT Landscape Registry
                </h2>
            </div>
        </div>
        <div class="col-9">
            <div class="container">
                <div class="row">
                  
                    <!-- Dropdown for column visibility with checkboxes -->
                    <div class="col-md-12 mb-3">
                    <label for="multiple-select-tag" style="font-weight: bold;">Add or remove columns to display</label>
                      <select id="multiSelect" class="form-control" multiple>
                      <option value="1">Company Name</option>
                            <option value="2">Address</option>
                            <option value="3">Source Of Informatio</option>
                            <option value="4">Type</option>
                            <option value="5">Email Address</option>
                            <option value="6">Telephone No</option>  
                            <option value="7">Sector</option>     
                            <option value="8">Service</option>
                            <option value="9">Products</option>
                            <option value="10">Web Address</option>
                            <option value="11">Contact Person</option>
                            <option value="12">Addition</option>
                            <option value="13">Last Updated Date</option>
                            <option value="14">Source</option>
                            <option value="15">Revenue</option>
                            <option value="16">No. of Employees</option>
                            <option value="17">No. of Offices</option>
                            <option value="18">Head Office City</option>
                            <option value="19">Date of Establishment</option>
                            <option value="20">International Presence</option>
                            <option value="21">Other Addresses</option>
                        </select>
                    </div>
                    <!-- DataTable -->
                    <table id="example" class="table table-striped table-bordered styled-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th style="width: 48px;">Sr. No</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Source Of Informatio</th>
                                <th>Type</th>
                                <th>Email Address</th>
                                <th>Telephone No</th>
                                <th>Sector</th>
                                <th>Service</th>
                                <th>Products</th>
                                <th>Web Address</th>
                                <th>Contact Person</th>
                                <th>Addition</th>
                                <th>Last Updated Date</th>
                                <th>Source</th>
                                <th>Revenue</th>
                                <th>No. of Employees</th>
                                <th>No. of Offices</th>
                                <th>Head Office City</th>
                                <th>Date of Establishment</th>
                                <th>International Presence</th>
                                <th>Other Addresses</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>








    </main>

    
  <script src="{{ asset('seic/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('seic/js/popper.min.js')}}"></script>
<script src="{{ asset('seic/js/aos.js')}}"></script>
<script src="{{ asset('seic/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('seic/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('seic/js/jszip.min.js')}}"></script>
<script src="{{ asset('seic/js/pdfmake.min.js')}}"></script>
<script src="{{ asset('seic/js/vfs_fonts.js')}}"></script>
<script src="{{ asset('seic/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('seic/js/buttons.print.min.js')}}"></script>



 <script>
 AOS.init({
   duration: 800, // values from 0 to 3000, with step 50ms
 });
 </script>
<script type="text/javascript">
  $(document).ready(function() {
          
    $('#multiSelect').select2({
        placeholder: 'Select options',
        allowClear: true,
        width: 'resolve'
      }).val(['1','2','3','4','5','6','7','8','9','10']).trigger('change');

            // Initialize DataTable
            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('seics.data') }}",
                columns: [
                { data: null, name: 'sr_no', orderable: false, searchable: false, render: function (data, type, row, meta) { return meta.row + 1 + meta.settings._iDisplayStart; } },
                { data: 'name_of_company', name: 'name_of_company' },
                { data: 'complete_address', name: 'complete_address' }, // updated to match your table column
                { data: 'source_of_this_information', name: 'source_of_this_information' },
                { data: 'company_type', name: 'company_type' }, // updated to match your table column
                { data: 'email_address', name: 'email_address' },
                { data: 'telephone_no', name: 'telephone_no' },
                { data: 'sector', name: 'sector' },
                { data: 'service', name: 'service' },
                { data: 'product', name: 'product' }, // updated to match your table column
                { data: 'web_address', name: 'web_address' },
                { data: 'contact_person', name: 'contact_person', visible: false },
                { data: 'addition_information', name: 'addition_information', visible: false },
                { data: 'last_updated_date', name: 'last_updated_date', visible: false },
                { data: 'source_of_this_information', name: 'source_of_this_information', visible: false }, // updated to match your table column
                { data: 'company_annual_revenue', name: 'company_annual_revenue', visible: false }, // updated to match your table column
                { data: 'no_of_employees', name: 'no_of_employees', visible: false },
                { data: 'no_of_offices', name: 'no_of_offices', visible: false },
                { data: 'head_office_city', name: 'head_office_city', visible: false },
                { data: 'date_of_establishment', name: 'date_of_establishment', visible: false },
                { data: 'international_presence', name: 'international_presence', visible: false },
                { data: 'other_addresses', name: 'other_addresses', visible: false }
            ],

                dom: 'Blfrtip',
                buttons: [
                    { text: 'Download', action: function (e, dt, node, config) { dt.button('.buttons-csv').trigger(); } },
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],  
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], 
                pageLength: 10
            });

            function customHandler(event) {
                var selectedColumns = $(event.target).val(); // Get selected values
                // console.log('Selected columns:', selectedColumns);
                var customValue = "0"; // Define your custom value
                selectedColumns.push(customValue); 
                table.columns().every(function(index) {
                    var column = this;
                    if (selectedColumns.includes(index.toString())) {
                        column.visible(true);
                    } else {
                        column.visible(false);
                    }
                });

                // Optionally, reload DataTable if necessary
                table.ajax.reload(); // Reload data if required
            }

            // Attach custom handler to multi-select change event
            $('#multiSelect').on('change', customHandler);
        
            var ctx = document.getElementById('cityChart').getContext('2d');

        });
        
</script>



  </body>
</html>
