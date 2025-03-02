@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Schools</h2>
    <a href="{{ route('schools.create') }}" class="btn btn-primary mb-3">Add School</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>School Name</th>
                <th>Region</th>
                <th>District</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
$(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('schools.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'school_name', name: 'school_name' },
            { data: 'region_name', name: 'region_name' },
            { data: 'district_name', name: 'district_name' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endsection
