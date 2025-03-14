<form method="post" action="{{ route('profile.update') }}" class="mt-4 p-4 border rounded shadow bg-white">
    @csrf
    @method('patch')

    <h2 class="mb-3 text-primary fw-bold">Update Profile</h2>

    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
        <div class="text-danger small mt-1">
            <x-input-error :messages="$errors->get('name')" />
        </div>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
        <div class="text-danger small mt-1">
            <x-input-error :messages="$errors->get('email')" />
        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 alert alert-warning small">
                <p>Your email address is unverified.</p>
                <button form="send-verification" class="btn btn-link p-0">Click here to re-send the verification email.</button>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-1 text-success">A new verification link has been sent to your email address.</p>
                @endif
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary px-4">Save</button>

        @if (session('status') === 'profile-updated')
            <p class="text-success small m-0" id="profile-updated-msg">Profile updated successfully.</p>
            <script>
                setTimeout(() => {
                    document.getElementById('profile-updated-msg').style.display = 'none';
                }, 2000);
            </script>
        @endif
    </div>
</form>
