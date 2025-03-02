
@extends('admin.layouts.app')

@section('title', 'Monitrering rejected')

@section('content')
  <h1>Rejected Requests</h1>
  <table class="table table-bordered" id="monitoring">
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      @foreach($requests as $request)
        <tr>
          <td>{{ $request->id }}</td>
          <td>{{ $request->full_name }}</td>
          <td>{{ $request->email }}</td>
          <td>{{ $request->phone }}</td>
          <td>{{ ucfirst($request->status) }}</td>
          <td><a href="{{ route('monitrering.show', $request->id) }}">View</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>

   <script>
    $(function() {
        $('.monitoring').DataTable({
            processing: true,
            serverSide: true,
        });
    });
</script>


@endsection
