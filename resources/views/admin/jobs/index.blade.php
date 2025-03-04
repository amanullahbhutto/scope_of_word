@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Job Listings</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Create New Job</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Deadline</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ Str::limit(strip_tags($job->description), 50) }}</td> <!-- Shortened Description -->
                    
                    <td>
                        @if (!empty($job->file))
                            <img src="{{ asset($job->file) }}" alt="Job Image" width="50" class="img-thumbnail">
                        @else
                            <p>No image available</p>
                        @endif
                    </td>

                    <td>{{ $job->deadline }}</td>
                    <td>{{ $job->publish_date }}</td>

                    <td>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
