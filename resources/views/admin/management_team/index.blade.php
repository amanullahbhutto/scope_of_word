@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Management Team</h2>
    <a href="{{ route('management.team.create') }}" class="btn btn-primary mb-3">Add Member</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Position</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teamMembers as $key => $member)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->email }}</td>
                <td>
                    <a href="{{ route('management.team.edit', $member->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <form action="{{ route('management.team.destroy', $member->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
