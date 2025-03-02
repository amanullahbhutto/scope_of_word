@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <form action="{{ route('regions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="region_name" class="form-label">Region Name</label>
            <input type="text" class="form-control" id="region_name" name="region_name" required>
        </div>
        <div class="mb-3">
            <label for="province_id" class="form-label">Province ID</label>
            <input type="number" class="form-control" id="province_id" name="province_id">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
