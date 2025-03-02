@extends('frontend.layouts.master') @section('content')
<div class="card">
    <h1 class="styled-heading">
        Empowering Citizens, Improving Schools.<br>
        <span class="highlight">Taking responsibility to monitor the school(s) in my area.</span>
    </h1>
</div>
<div class="frontpage-row-6 frontpage-row centered-heading mb-5" bis_skin_checked="1">


    <h4>People are uniting, schools are being monitored for improvement</h4>

    <p class="row-subtitle"> School Monitoring Data uploaded by Volunteers</p>


    <div class="offers-container" bis_skin_checked="1">

        <div class="offer" bis_skin_checked="1">
            <h5>Total Schools</h5>
            <div class="" bis_skin_checked="1"> {{ number_format($school) }}
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
<table id="example" class="table table-striped table-bordered mt-4">
    <thead>
        <tr>
            <th>District</th>
            <th>Total Schools</th>
            <th>Adopted</th>
            <th>Total Teachers</th>
            <th>Total Students</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($totalschooldist as $item)
        <tr>
            <td><a href="{{ route('district.show', ['distname' => $item->distname]) }}"> {{ $item->distname }} </a></td>

            <td>{{ $item->totalschools }}</td>
            <td>0</td>
            <!-- Show region_name here -->
            <td>{{ $item->total_teachers_staff }}</td>
            <td>{{ $item->totalstudent }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection @push('scripts')
<script>
    $(document).ready(function() {
       
        $('#example').DataTable({
            pageLength: 25, 
        lengthMenu: [25, 50, 100],
        });
    });
</script>
@endpush