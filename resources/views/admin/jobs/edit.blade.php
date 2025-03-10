@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Edit Job</h2>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                       <div class="row ">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control summernote" placeholder="Description">{{ old('description', $job->description) }}</textarea>
                                </div>
                            </div>

                          <div class="col-md-6">
                            <div class="mb-3 text-center">
                                <label class="form-label">Current Image</label><br>
                                @if (!empty($job->file))
                                    <img src="{{ asset($job->file) }}" alt="Job Image" class="img-thumbnail" width="100">
                                @else
                                    <p>No image available</p>
                                @endif
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload New Image</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                          </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Deadline</label>
                                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline) }}" required>
                                </div>
                            </div>

                          

                           
                       </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-4">Create Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary mx-2">Go Back</a>
                             </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
