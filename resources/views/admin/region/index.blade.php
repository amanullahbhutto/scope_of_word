@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <a href="{{ route('regions.create') }}" class="btn btn-primary mb-3">Add Region</a>
    <table class="table table-bordered" id="regions-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Region Name</th>
                <th>Province ID</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $(function() {
        $('#regions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('regions.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'region_name', name: 'region_name' },
                { data: 'province_id', name: 'province_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endsection
