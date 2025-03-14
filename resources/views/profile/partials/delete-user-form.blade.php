<form method="post" action="{{ route('profile.destroy') }}" class="p-4 border rounded shadow bg-white">
    @csrf
    @method('delete')

    <h2 class="text-danger fw-bold">Are you sure you want to delete your account?</h2>

    <p class="text-muted mt-2">
        Once your account is deleted, all of its resources and data will be permanently removed. 
        Please enter your password to confirm deletion.
    </p>

    <div class="mt-4">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
        <div class="text-danger small mt-1">
            <x-input-error :messages="$errors->userDeletion->get('password')" />
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4 gap-2">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete Account</button>
    </div>
</form>
