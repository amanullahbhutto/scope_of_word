@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Upload Media</h2>

    <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="file">Upload File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
    </form>
</div>
@endsection
