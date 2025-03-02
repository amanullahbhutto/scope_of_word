@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Current Image:</label><br>
            @if (!empty($category->image))
                    
                    <img src="{{ asset('/'.$category->image) }}" alt="Category Image" width="50" height="50">
                @else
                    <p>No image available</p>
                @endif
        </div>
        <div class="mb-3">
            <label>New Image:</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
