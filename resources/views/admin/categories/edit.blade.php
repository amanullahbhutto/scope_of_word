@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg border-0 rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Category</h4>
                </div>
                <div class="card-body">
                    {{--  @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  --}}

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $category->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                       
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Image</label><br>
                                @if (!empty($category->image))
                                    <img src="{{ asset('/'.$category->image) }}" alt="Category Image" class="img-thumbnail" width="100">
                                @else
                                    <p class="text-muted">No image available</p>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Upload New Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            @can('update category')
                                <button type="submit" class="btn btn-success px-4 shadow-sm">
                                    <i class="fas fa-save"></i> Update Category
                                </button>
                            @endcan
                        
                            @can('view category')
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary ms-3 shadow-sm">
                                    <i class="fas fa-arrow-left"></i> Go Back
                                </a>
                            @endcan
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
