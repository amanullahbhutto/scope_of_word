@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Management Team Member Details</h2>

    <div class="card">
        <div class="card-header bg-success text-white">
            {{ $member->name }} - {{ $member->position }}
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $member->name }}</p>
            <p><strong>Position:</strong> {{ $member->position }}</p>
            <p><strong>Email:</strong> {{ $member->email }}</p>

            @if (!empty($member->image))
                <img src="{{ asset($member->image) }}" alt="Member Image" width="150" height="150">
            @else
                <p>No image available</p>
            @endif

            <br>
            <a href="{{ route('management-teams.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection
