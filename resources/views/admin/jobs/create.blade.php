@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create Job</h2>
    <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
          
    
            {{--  <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" id="editor" class="form-control"></textarea>
            </div>  --}}
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                </div>
            </div>
    
           <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Upload File</label>
                <input type="file" name="file" class="form-control">
            </div>
            </div>
    
           

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control">
                </div>
            </div>
    
             
        

        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success ">Create Job</button>
            <a href="{{ route('jobs.index') }}" class="btn btn-secondary mx-2">Go Back</a>
        </div>
    </form>
</div>
@endsection

