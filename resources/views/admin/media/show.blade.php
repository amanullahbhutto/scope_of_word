@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Media Details</h2>

    <h4> Title: {{ $media->title }}</h4>

    <div class="mt-3">
        @if($media->is_image)
            <img src="{{ $media->file_path }}" width="300" alt="Image">
        @elseif($media->is_video)
            <video width="400" controls>
                <source src="{{ $media->file_path }}" type="video/{{ $media->file_extension }}">
                Your browser does not support the video tag.
            </video>
        @else
            <a href="{{ $media->file_path }}" download>
                <i class="fas fa-download" style="font-size: 24px;"></i> Download File
            </a>
        @endif
    </div>

    <a href="{{ route('media.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
