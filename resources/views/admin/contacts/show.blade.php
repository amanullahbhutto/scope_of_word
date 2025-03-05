@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Contact Details</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>First Name:</strong> {{ $contact->first_name }}</p>
            <p><strong>Last Name:</strong> {{ $contact->last_name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Description:</strong> {{ $contact->description }}</p>
            <a href="{{ route('contacts.index') }}" class="btn btn-primary">Back</a>
            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
