@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <a href="{{ route('districts.create') }}" class="btn btn-primary mb-3">Add District</a>
    <table class="table table-bordered" id="districts-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>District Name</th>
                <th>Region Name</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(function() {
        $('#districts-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('districts.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'district_name', name: 'district_name' },
                { data: 'region_name', name: 'region_name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
