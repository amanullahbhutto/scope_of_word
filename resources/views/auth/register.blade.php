<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-card {
            max-width: 500px;
            width: 100%;
            padding: 2rem;
            border-radius: 10px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.2);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12 col-md-6">
                <div class="card shadow-lg register-card bg-white mx-auto">
                    <h2 class="text-center fw-bold mb-4">Create an Account</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Full Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="text-danger small mt-1" />
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email Address</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="text-danger small mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="text-danger small mt-1" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-medium">Confirm Password</label>
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger small mt-1" />
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-primary small">Already registered?</a>
                            <button type="submit" class="btn btn-primary fw-bold">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
