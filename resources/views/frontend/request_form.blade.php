@extends('frontend.layouts.master')
<style>
.card{
  text-align: left !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}

.is-invalid + .invalid-feedback {
    display: block;
    color: #dc3545;
}
</style>
@section('content')
<div id="loader" class="spinner-border text-primary" role="status" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
    <span class="visually-hidden">Loading...</span>
</div>

  <div class="container mt-5">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">Request For Monitoring School</h2>

            <!-- Request Form -->
          <form id="monitoringForm" action="{{route('addopted.submit')}}" method="POST">
                  @csrf
                  <div class="row mb-4">
                      <!-- Full Name -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="fullName">Full Name</label>
                              <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                          </div>
                      </div>

                      <!-- Email -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="email">Email Address</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                          </div>
                      </div>

                      <!-- Phone Number -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="phone">Phone Number</label>
                              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                          </div>
                      </div>
                  </div>

                  <div class="row mb-4">
                      <!-- Region -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="region">Region</label>
                              <select class="form-control" id="region" name="region" required>
                                  <option value="">Select Region</option>
                                  @foreach($regin as $req)
                                      <option value="{{ $req->id }}">{{ $req->region_name }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <!-- District -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="district">District</label>
                              <select class="form-control" id="district" name="district" required>
                                  <option value="">Select District</option>
                              </select>
                          </div>
                      </div>

                      <!-- Tehsil -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="tehsil">Tehsil</label>
                              <select class="form-control" id="tehsil" name="tehsil" required>
                                  <option value="">Select Tehsil</option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="row mb-4">
                      <!-- School Id -->
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="school_id">School Id</label>
                              <input type="text" class="form-control" id="school_id" name="school_id" placeholder="Enter School Id" required>
                          </div>
                      </div>

                      <!-- OTP Section (Initially Hidden) -->
                      <div class="col-md-4 d-none" id="otpSection">
                          <div class="form-group">
                              <label for="otp">OTP</label>
                              <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required>
                          </div>
                      </div>
                  </div>

                  <div class="row mb-4">
                      <!-- Address -->
                      <div class="col-md-12">
                          <label for="address">Address</label>
                          <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address" required></textarea>
                      </div>
                  </div>

                  <!-- OTP and Submit Buttons -->
                  <div class="d-flex justify-content-center">
                      <button type="submit" id="sendOtpButton" class="btn btn-primary px-5" style="background-color: #194a30de;">Send OTP</button>
                      <button type="submit" id="verifyOtpButton" class="btn btn-success px-5 d-none" style="margin-left: 10px;">Verify OTP</button>
                  </div>
              </form>

        </div>
    </div>
</div>



@endsection

@push('scripts')
  
<script>

 $(document).ready(function() {
    console.log('Form initialized');
    // jQuery Validation
    $("#monitoringForm").validate({
        rules: {
            fullName: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 11
            },
            region: {
                required: true
            },
            district: {
                required: true
            },
            tehsil: {
                required: true
            },
            address: {
                required: true,
                minlength: 10
            }
        },
        messages: {
            fullName: {
                required: "Please enter your full name",
                minlength: "Your name must be at least 3 characters long"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
                minlength: "Your phone number must be at least 13 digits"
            },
            region: {
                required: "Please select your region"
            },
            district: {
                required: "Please select your district"
            },
            tehsil: {
                required: "Please select your tehsil"
            },
            address: {
                required: "Please enter your address",
                minlength: "Your address must be at least 10 characters long"
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
           console.log('Validation passed, attempting form submission');
            if ($('#otpSection').hasClass('d-none')) {
                sendOtp(form);
            } else {
                verifyOtpBeforeSubmit(form);
            }
        }
    });

    // Send OTP function
    function sendOtp(form) {
      $('#loader').show();
        const formData = new FormData(form);

        fetch("{{ route('api.sendOtp') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
           $('#loader').hide();
            if (data.success) {
                $('#otpSection').removeClass('d-none');
                $('#verifyOtpButton').removeClass('d-none');
                $('#sendOtpButton').addClass('d-none');
                toastr.success("OTP sent successfully!");
            } else {
                toastr.warning("Failed to send OTP. Please try again.");
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Verify OTP before form submission
    function verifyOtpBeforeSubmit(form) {
        const otp = $('#otp').val();
        $('#loader').show();
        if (!otp) {
            toastr.warning("Please enter the OTP.");
            return;
        }

        const formData = new FormData(form);
        formData.append('otp', otp);

        fetch("{{ route('api.verifyOtp') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
           $('#loader').hide();
            if (data.success) {
                toastr.success("OTP verified successfully! Submitting the form.");
                form.submit(); // Submit the form
            } else {
                toastr.warning("Invalid OTP. Please try again.");
            }
        })
        .catch(error => console.error("Error:", error));
         $('#loader').hide();
    }

    // Fetch districts based on selected region
    $('#region').on('change', function() {
        const regionId = $(this).val();
        $('#loader').show();

        if (regionId) {
            $.ajax({
                url: '{{ route("get.districts") }}',
                type: 'GET',
                data: { region_id: regionId },
                success: function(data) {
                   $('#loader').hide();
                    $('#district').html('<option value="">Select District</option>');
                    $('#tehsil').html('<option value="">Select Tehsil</option>');

                    data.districts.forEach(function(district) {
                        $('#district').append(`<option value="${district.id}">${district.district_name}</option>`);
                    });
                },
                error: function() {
                   $('#loader').hide();
                    toastr.error('Error fetching districts.');
                }
            });
        } else {
           $('#loader').hide();
            $('#district').html('<option value="">Select District</option>');
            $('#tehsil').html('<option value="">Select Tehsil</option>');
        }
    });

    // Fetch tehsils based on selected district
    $('#district').on('change', function() {
      $('#loader').show();
        const districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: '{{ route("get.tehsils") }}',
                type: 'GET',
                data: { district_id: districtId },
                success: function(data) {
                   $('#loader').hide();
                    $('#tehsil').html('<option value="">Select Tehsil</option>');
                    data.tehsils.forEach(function(tehsil) {
                        $('#tehsil').append(`<option value="${tehsil.id}">${tehsil.tehsil_name}</option>`);
                    });
                },
                error: function() {
                   $('#loader').hide();
                    toastr.error('Error fetching tehsils.');
                }
            });
        } else {
           $('#loader').hide();
            $('#tehsil').html('<option value="">Select Tehsil</option>');
        }
    });
});

</script>

@endpush
