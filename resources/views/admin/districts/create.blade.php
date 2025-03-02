@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <form action="{{ route('districts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="district_name" class="form-label">District Name</label>
            <input type="text" class="form-control" id="district_name" name="district_name" required>
        </div>
        <div class="mb-3">
            <label for="region_id" class="form-label">Region</label>
            <select class="form-control" id="region_id" name="region_id">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
