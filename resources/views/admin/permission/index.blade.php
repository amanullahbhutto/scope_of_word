@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container mt-5">
        <a href="{{ route('roles.index') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ route('users.index') }}" class="btn btn-warning mx-1">Users</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                {{--  @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif  --}}

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permissions
                            @can('create permission')
                            <a href="{{ route('permissions.create') }}" class="btn btn-primary float-end">Add Permission</a>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-success">Edit</a>
                                        @endcan

                                      
                                        @can('delete user')
                                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        @endcan

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection