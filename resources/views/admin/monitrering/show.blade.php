@extends('admin.layouts.app')

@section('title', 'Pending User Details')

@section('content')
<h1>Pending User Details</h1>

{{-- Display validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('pending.add_user', $request->id) }}">
    @csrf

    <div class="mb-3">
        <label for="full_name" class="form-label">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $request->full_name) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $request->phone) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="region" class="form-label">Region</label>
        <input type="text" id="region" name="region" value="{{ $request->region ? $request->region->region_name : 'N/A' }}" class="form-control" readonly>
        <input type="hidden" name="region_id" value="{{ old('region_id', $request->region_id) }}">
    </div>

    <div class="mb-3">
        <label for="district" class="form-label">District</label>
        <input type="text" id="district" name="district" value="{{ $request->district ? $request->district->district_name : 'N/A' }}" class="form-control" readonly>
        <input type="hidden" name="district_id" value="{{ old('district_id', $request->district_id) }}">
    </div>

    <div class="mb-3">
        <label for="tehsil" class="form-label">Tehsil</label>
        <input type="text" id="tehsil" name="tehsil" value="{{ $request->tehsil ? $request->tehsil->tehsil_name : 'N/A' }}" class="form-control" readonly>
        <input type="hidden" name="tehsil_id" value="{{ old('tehsil_id', $request->tehsil_id) }}">
    </div>

    <div class="mb-3">
        <label for="school" class="form-label">School</label>
        <input type="text" id="school" name="school" value="{{ $request->school ? $request->school->school_name : 'N/A' }}" class="form-control" readonly>
        <input type="hidden" name="school_id" value="{{ old('school_id', $request->school_id) }}">
    </div>

    <div class="mb-3">
        <label for="otp" class="form-label">OTP</label>
        <input type="text" id="otp" name="otp" value="{{ old('otp', $request->otp) }}" class="form-control">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea id="address" name="address" class="form-control">{{ old('address', $request->address) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ old('status', $request->status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="approved" {{ old('status', $request->status) == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ old('status', $request->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input 
            type="password" 
            name="password" 
            id="password" 
            class="form-control @error('password') is-invalid @enderror" 
            required
        >
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection
