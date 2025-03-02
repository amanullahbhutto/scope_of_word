@extends('admin.layouts.app')
@section('content')
<div class="container">
    <h2>Edit Team Member</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('management.team.update', $managementTeam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $managementTeam->name }}" required>
        </div>
        <div class="form-group">
            <label>Position:</label>
            <input type="text" name="position" class="form-control" value="{{ $managementTeam->position }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $managementTeam->email }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('management.team.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
