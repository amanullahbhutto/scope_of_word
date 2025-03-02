@extends('admin.layouts.app')


@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h2 class="card-title mb-0">{{ $product->name }}</h2>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            @if (!empty($product->image))
                            <img src="{{ asset($product->image) }}" alt="Product Image">
                        @else
                            <p>No image available</p>
                        @endif
                        </div>
                        <div class="col-md-6">
                            <p class="lead mt-3 mt-md-0">{{ $product->description }}</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Price:</strong>
                                    <span class="text-success fw-bold">${{ number_format($product->price, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <strong>Quantity:</strong>
                                    <span class="fw-bold">{{ $product->qty }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
