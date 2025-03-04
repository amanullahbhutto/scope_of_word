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
                            <div> <p class="lead mt-3 mt-md-0"> <strong>Slug</strong> {{ $product->slug }}</p></div>
                            <p class="lead mt-3 mt-md-0"> <strong>Description</strong> {{ $product->description }}</p>
                            <div>
                                <td> <strong> Category:</strong> 
                                    @if ($product->categories->isNotEmpty())
                                        {{ $product->categories->pluck('name')->join(', ') }}
                                    @else
                                        <p>No category</p>
                                    @endif
                                </td>
                            </div>
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

