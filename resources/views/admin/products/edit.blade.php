@extends('admin.layouts.app')


@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{--  <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>  --}}

        

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


        
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $product->slug }}" readonly>	
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>


            <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id[]" id="category" class="form-control select2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#name").on('change', function() {
            var $input = $(this);
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: "{{ route('getSlug') }}", 
                type: "GET",
                data: { title: $input.val() },
                dataType: "json",
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status) {
                        $("#slug").val(response.slug);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    $("button[type=submit]").prop('disabled', false);
                }
            });
        });
    });
</script>


@endsection
