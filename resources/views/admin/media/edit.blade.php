@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Media</h2>

    <form action="{{ route('media.update',$media->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $media->title }}" required>
        </div>

        <div class="mb-3">
            <label>Current File:</label><br>
            @if(in_array(pathinfo($media->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'jfif', 'gif', 'webp']))
                <img src="{{ asset($media->file_path) }}" width="100">
            @elseif(in_array(pathinfo($media->file_path, PATHINFO_EXTENSION), ['mp4', 'mov', 'avi', 'webm']))
                <video width="150" controls>
                    <source src="{{ asset($media->file_path) }}" type="video/{{ pathinfo($media->file_path, PATHINFO_EXTENSION) }}">
                </video>
            @else
                <a href="{{ asset($media->file_path) }}" download>Download File</a>
            @endif
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Upload New File (Optional)</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
