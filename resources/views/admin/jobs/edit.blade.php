@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Job</h2>
    
    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
        </div>

        {{--  <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Description">{{ old('description', $job->description) }}</textarea>
            </div>
        </div>  --}}

        <div class="col-md-12">
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ old('description', $job->description) }}</textarea>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">image</label>
            <input type="file" name="file" class="form-control">
            <td>
                @if (!empty($job->file))
                    <img src="{{ asset($job->file) }}" alt="Job Image" width="50" class="img-thumbnail">
                @else
                    <p>No image available</p>
                @endif
            </td>
        </div>

        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
</div>
@endsection
