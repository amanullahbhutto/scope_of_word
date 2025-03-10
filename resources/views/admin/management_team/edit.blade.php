@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Team Member</h2>

    {{--  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif  --}}

    <form action="{{ route('management-teams.update', $managementTeam->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ $managementTeam->name }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Position:</label>
                    <input type="text" name="position" class="form-control" value="{{ $managementTeam->position }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $managementTeam->email }}" required>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success mx-2">Update</button>
                <a href="{{ route('management-teams.index') }}" class="btn btn-secondary mx-2">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
