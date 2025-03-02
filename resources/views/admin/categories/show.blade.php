@extends('admin.layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="card-title mb-0">{{ $category->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            @if (!empty($category->image))
                                <img src="{{ asset($category->image) }}" alt="Category Image" class="img-fluid rounded">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p class="lead mt-3 mt-md-0">{{ $category->description }}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Status:</strong>
                                    <span class="fw-bold {{ $category->status ? 'text-success' : 'text-danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Categories
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
