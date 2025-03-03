
{{--  @extends('admin.layout.app')  --}}
@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Product List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    
    {{--  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif  --}}

   

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>slug</th>
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
                            <td>{{ $product->slug }}</td>
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
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- jQuery & DataTables Scripts -->
{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  --}}
<script>
    $(document).ready(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endsection