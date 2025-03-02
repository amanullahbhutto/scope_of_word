@extends('frontend.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">Thank You!</h2>
            <p class="text-center">Your request has been successfully submitted. We will get back to you shortly.</p>
            
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-primary">Go Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
