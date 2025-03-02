@extends('seic.app')

@section('title', 'Add Company Information')

@section('custom_styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background */
        }

        .form-control {
            border-radius: 0.5rem; /* Rounded corners */
        }

        .btn-primary {
            background-color: #0056b3; /* Custom button color */
        }
    </style>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Company Information</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form id="companyInfoForm" action="#" method="POST" class="p-4 bg-light rounded shadow">
        @csrf

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="name_of_company" class="form-label">Name of Company</label>
                <input type="text" name="business_name" class="form-control" id="business_name" required>
            </div>
            <div class="col-sm-4 mb-3">
                <label for="business_name" class="form-label">Owner Name</label>
                <input type="text" name="name_of_company" class="form-control" id="name_of_company" required>
            </div>
            <div class="col-sm-4 mb-3">
                <label for="province" class="form-label">Province</label>
                <input type="text" name="province" class="form-control" id="province" required>
            </div>
        </div>

        <div class="row">
        <div class="col-sm-4 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="city" required>
            </div>
            <div class="col-sm-4 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
            </div>

            <div class="col-sm-4 mb-3">
                <label for="addition_information" class="form-label">Additional Information</label>
                <textarea name="addition_information" class="form-control" id="addition_information" rows="3"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" name="type" class="form-control" id="type" required placeholder="SOFTWARE & IT CONSULTANTS" >
            </div>

            <div class="col-sm-4 mb-3">
                <label for="service" class="form-label">Service</label>
                <input type="text" name="service" class="form-control" id="service" required placeholder="Electronic payment processing solutions, ATM switch, Card management systems">
            </div>

            <div class="col-sm-4 mb-3">
                <label for="products" class="form-label">Products</label>
                <input type="text" name="products" class="form-control" id="products" placeholder="Cloud-based EHR, Practice management software, Patient portal solutions">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="revenue" class="form-label">Revenue</label>
                <input type="number" name="revenue" class="form-control" id="revenue" step="0.01" >
            </div>

            <div class="col-sm-4 mb-3">
                <label for="capital" class="form-label">Capital</label>
                <input type="number" name="capital" class="form-control" id="capital" step="0.01" >
            </div>

            <div class="col-sm-4 mb-3">
                <label for="no_of_employees" class="form-label">Number of Employees</label>
                <input type="number" name="no_of_employees" class="form-control" id="no_of_employees" >
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="head_office_city" class="form-label">Head Office City</label>
                <input type="text" name="head_office_city" class="form-control" id="head_office_city" required>
            </div>

            <div class="col-sm-4 mb-3">
                <label for="international_presence" class="form-label">International Presence</label>
                <select name="international_presence" class="form-select" id="international_presence">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="col-sm-4 mb-3">
                <label for="web_address" class="form-label">Web Address</label>
                <input type="url" name="web_address" class="form-control" id="web_address">
            </div>
        </div>

        <h5 class="my-4">Contact Information</h5>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="contact_person" class="form-label">Contact Person</label>
                <input type="text" name="contact_person" class="form-control" id="contact_person" required>
            </div>

            <div class="col-sm-4 mb-3">
                <label for="telephone_no" class="form-label">Telephone Number</label>
                <input type="text" name="telephone_no" class="form-control" id="telephone_no" required>
            </div>

            <div class="col-sm-4 mb-3">
                <label for="email_address" class="form-label">Email Address</label>
                <input type="email" name="email_address" class="form-control" id="email_address" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4 mb-3">
                <label for="stn_no" class="form-label">STN Number</label>
                <input type="text" name="stn_no" class="form-control" id="stn_no">
            </div>
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

 <script>
    // SweetAlert Confirmation on form submission
    document.addEventListener('DOMContentLoaded', function() {
    
        document.getElementById('companyInfoForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            swal({
                title: "Are you sure?",
                text: "You are about to submit the company information.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willSubmit) => {
                if (willSubmit) {
                    this.submit(); // Submit the form if the user confirms
                }
            });
        });
    });
</script>
