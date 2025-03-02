@extends('admin.layouts.app')


@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Image:</label>
            <input type="file" name="image" class="form-control">
            
            @if (!empty($product->image))
                <div class="mt-2">
                    @if (!empty($product->image))
                    <img src="{{ asset($product->image) }}" alt="Product Image" width="50">
                @else
                    <p>No image available</p>
                @endif
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label>Quantity:</label>
            <input type="number" name="qty" class="form-control" value="{{ $product->qty }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection