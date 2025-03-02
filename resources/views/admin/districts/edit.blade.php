@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h2>Edit District</h2>
    <form action="{{ route('districts.update', $district->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="district_name" class="form-label">District Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="district_name" 
                name="district_name" 
                value="{{ old('district_name', $district->district_name) }}" 
                required>
        </div>

        <div class="mb-3">
            <label for="region_id" class="form-label">Region</label>
            <select class="form-control" id="region_id" name="region_id">
                <option value="">Select Region</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" 
                        {{ $district->region_id == $region->id ? 'selected' : '' }}>
                        {{ $region->region_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('districts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
