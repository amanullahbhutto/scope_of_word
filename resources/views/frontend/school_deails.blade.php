@extends('frontend.layouts.master')
<style>
    .card-body h5, .card-body p {
            display: block;
            margin-bottom: 0;
        }
        .details{
        text-align: left;
        }
        .live-broadcast {
            color: var(--Foundation-White-white-50, #fdfdfd);
            font-size: 19px;
            font-style: normal;
            font-weight: 700;
            line-height: 120%;
        }
        
        .nav-customs {
            color: #044523;
            text-align: center;
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: 140%;
            padding: 10px 20px;
            border: 1px solid #d9d9d9;
            transition: background-color 0.3s;
            position: relative;
        }
        .nav-customs.active {
            color: white;
            background-color: #044523;
        }

      

    

    table {
        width: 80%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: left;
        font-size: 16px;
    }

    th {
        background-color: #6c757d;
        color: white;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    thead th {
        border-bottom: 2px solid #ddd;
    }
</style>
@section('content')

<div class="container mt-5">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-header text-white text-center p-4 rounded-top" style="background-color: #03341b !important;">
            <h3 class="mb-0">School Details</h3>
        </div>
        <div class="row live-broadcast d-flex align-items-center mt-3 gx-0" bis_skin_checked="1">
            <div class="col-lg-2 col-md-6 col-12" bis_skin_checked="1">
                <button class="nav-customs w-100 active" id="tab1" onclick="showTabexplore('tab1')" aria-selected="false">School</button>
            </div>
            <div class="col-lg-2 col-md-6 col-12" bis_skin_checked="1">
                <button class="nav-customs w-100" id="tab2" onclick="showTabexplore('tab2')" aria-selected="false">Teachers details</button>
            </div>
            <div class="col-lg-2 col-md-6 col-12" bis_skin_checked="1">
                <button class="nav-customs w-100" id="tab3" onclick="showTabexplore('tab3')" aria-selected="false">Images</button>
            </div>
        </div>

        <div class="card-body p-5 details">
            <div id="tab1-tabx" class="tab-content active">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">School Name:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->school_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Region:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->regions->region_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">District:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->districts->district_name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Tehsil:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->tehsils->tehsil_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">UC:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->uc }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">School Address:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->school_address }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Gender:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->gender }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Shift:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->shift }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Status:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->status }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Level:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->level }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Building Availability:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->building_availability }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Construction Type:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->cunstruction_type }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Rooms:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->rooms }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Total Classrooms:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->classroom_total }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Primary Classrooms:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->primary_classrooms }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Post Primary Classrooms:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->post_primary_classrooms }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Drinking Water:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->drinking_water }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Electricity:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->electricity }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Toilet Availability:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->toilet }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Boundary Wall:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->boundary_wall }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Medium:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->medium }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Boys Enrolled:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->boys_enrolled }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Girls Enrolled:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->girls_enrolled }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Total Enrolled:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->total_enrolled }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Male Teachers:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->male_teachers }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Female Teachers:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->female_teahers }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Total Teachers/Staff:</h5>
                            <p class="lead d-inline ml-2">{{ $schoolDetails->total_teachers_staff }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <h5 class="font-weight-bold text-muted d-inline">Adopted : </h5>
                            <p class="lead d-inline ml-2">NO</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab2-tabx" class="tab-content" style="display:none">
                <h4>Teachers Details</h4>
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Designation</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1; ?>
                            @foreach($teachers as $key => $value)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$value->teacher_name}}</td>
                                <td>N/A</td>
                                <td>{{$value->designation}}</td>
                            </tr>
                            @endforeach


                    </tbody>
                </table>
            </div>

            <div id="tab3-tabx" class="tab-content" style="display:none">
                <h4>Images</h4>
            </div>


        </div>
        <!-- Card -->
    </div>
</div>

@endsection @push('scripts')
<script>
    function showTabexplore(tabId) {
         document.querySelectorAll('.tab-content').forEach(function(tabContent) {
            tabContent.style.display = 'none';
        });

        document.querySelectorAll('.nav-customs').forEach(function(button) {
            button.classList.remove('active');
        });
        document.getElementById(tabId).classList.add('active');
        console.log(tabId);
        // Add 'active' class to the clicked tab button
        document.getElementById(tabId + '-tabx').style.display = 'block';
    }

    // Optional: Trigger the first tab on page load
    window.onload = function() {
        showTabexplore('tab1');
    };
</script>
@endpush