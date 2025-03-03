@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Media List</h2>
    <a href="{{ route('media.create') }}" class="btn btn-primary">Upload Media</a>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example1" class=" mt-3 table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Preview</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($media as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                @if($item->is_image)
                                    <img src="{{ $item->file_path }}" width="100" height="100" alt="Image">
                                @elseif($item->is_video)
                                    <video width="150" controls>
                                        <source src="{{ $item->file_path }}" type="video/{{ $item->file_extension }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <a href="{{ $item->file_path }}" download>
                                        <i class="fas fa-download" style="font-size: 24px;"></i> Download File
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('media.show', $item->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('media.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('media.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
