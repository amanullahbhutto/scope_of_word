@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Categories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    {{--  @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif  --}}

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                @if (!empty($category->image))
                    
                    <img src="{{ asset('/'.$category->image) }}" alt="Category Image" width="50" height="50">
                @else
                    <p>No image available</p>
                @endif
            </td>
                </td>
                <td>
                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{--  {{ $categories->links() }}  --}}
</div>
@endsection
