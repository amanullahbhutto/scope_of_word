@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-13">
            <h2 class="text-center">Edit Contact</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ $contact->first_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ $contact->last_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $contact->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" required>{{ $contact->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-success mx-2">Update</button>
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary mx-2">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</div>
@endsection
