<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4 p-4 bg-white shadow rounded">
        @csrf
        @method('put')
    
        <h2 class="mb-3 text-primary">Update Password</h2>
    
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input type="password" id="update_password_current_password" name="current_password" 
                   class="form-control" autocomplete="current-password" placeholder="Enter current password">
            <div class="text-danger small">
                <x-input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>
        </div>
    
        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input type="password" id="update_password_password" name="password" 
                   class="form-control" autocomplete="new-password" placeholder="Enter new password">
            <div class="text-danger small">
                <x-input-error :messages="$errors->updatePassword->get('password')" />
            </div>
        </div>
    
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" 
                   class="form-control" autocomplete="new-password" placeholder="Confirm new password">
            <div class="text-danger small">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>
    
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4">Save</button>
    
            @if (session('status') === 'password-updated')
                <p class="text-success small m-0" id="password-updated-msg">Password updated successfully.</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('password-updated-msg').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
    
</section>
