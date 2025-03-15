@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center">Add New Contact</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                    
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-success mx-2">Submit</button>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary mx-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection
