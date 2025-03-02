
{{--  @extends('admin.layout.app')  --}}
@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Product List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    
    {{--  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif  --}}

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>description</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>

                
            </tr>
        </thead>
        <tbody>
            
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>@if (!empty($product->image))
                    <img src="{{ asset($product->image) }}" alt="Product Image" width="50">
                @else
                    <p>No image available</p>
                @endif</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->qty }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection