@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Management Team</h2>
    <a href="{{ route('management-teams.create') }}" class="btn btn-primary mb-3">Add Member</a>

    {{--  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif  --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
               
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="bg-success text-white">
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
                                    <a href="{{ route('management-teams.show', $member->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('management-teams.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('management-teams.destroy', $member->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               
            </div>
        </div>
    </div>

             

</div>
@endsection
@section('scripts')
<!-- jQuery & DataTables Scripts -->
{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  --}}
<script>
    $(document).ready(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endsection
