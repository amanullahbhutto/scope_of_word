@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h2 class="mb-3 text-primary">{{ $job->title }}</h2>
        
        <div class="mb-3">
            <strong class="d-block text-secondary">Description:</strong>
            <p class="text-dark">{{ $job->description }}</p>
        </div>

        <div class="mb-3">
            <strong class="d-block text-secondary">Deadline:</strong>
            <p class="badge bg-danger text-white">{{ $job->deadline }}</p>
        </div>

        <div class="mb-3">
            <strong class="d-block text-secondary">Job Image:</strong>
            @if (!empty($job->file) && file_exists(public_path($job->file)))
                <img src="{{ asset($job->file) }}" alt="Job Image" class="img-fluid rounded shadow" style="max-width: 200px;">
            @else
                <p class="text-muted">No image available</p>
            @endif
        </div>

        <a href="{{ route('jobs.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
    </div>
</div>
@endsection
