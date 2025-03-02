@extends('frontend.layouts.master')

@section('content')
   

    <div class="frontpage-row-6 frontpage-row centered-heading mb-5" bis_skin_checked="1">

    <h3>Schools in District: {{ $district->district_name }}</h3>
    
    <h4>People are uniting, schools are being monitored for improvement</h4>

    <p class="row-subtitle"> School Monitoring Data uploaded by Volunteers</p>


    <div class="offers-container" bis_skin_checked="1">

        <div class="offer" bis_skin_checked="1">
            <h5>Total Schools</h5>
            <div class="" bis_skin_checked="1">{{ number_format($totalSchools) }}
                <span>Total government schools</span>
            </div>



        </div>
        <!-- offer -->


        <div class="offer" bis_skin_checked="1">
            <h5>Adopted for Monitoring</h5>
            <div class="" bis_skin_checked="1">{{ number_format($totalAdoptedSchools) }} <span>schools adopted for monitoring and reporting </span>
            </div>



        </div>
        <!-- offer -->

        <div class="offer" bis_skin_checked="1">
            <h5>Latest adopted schools are </h5>

           <div class="" bis_skin_checked="1">{{ number_format($latestAdoptedSchools) }} <span>schools adopted for monitoring and reporting </span>
            </div>


        </div>
        <!-- offer -->

    </div>
    <!-- offers-container -->

</div>


    <!-- DataTable Example -->
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>School Name</th>
                <th>Adopted</th>
                <th>Total Teachers</th>
                <th>Total Students</th>
                <th>District</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td><a href="{{ route('school.show', ['id' => $school->school_id]) }}">{{ $school->school_name }}</a></td>
                    <td>No</td>
                    <td>{{ $school->total_teachers_staff }}</td>
                    <td>{{ $school->total_enrolled }}</td>
                    <td>{{ $school->distname }}</td>
                    <td>{{ $school->region_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            processing: true,
                pageLength: 25, 
        lengthMenu: [25, 50, 100],
        });
    });
</script>
@endpush
