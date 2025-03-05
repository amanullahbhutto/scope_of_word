@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Contacts List</h2>
    <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Add Contact</a>
    
    {{--  @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif  --}}
 
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->first_name }}</td>
                            <td>{{ $contact->last_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->description }}</td>
                            <td>
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
