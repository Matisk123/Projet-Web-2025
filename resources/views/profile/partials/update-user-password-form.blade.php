<div class="card">
    <div class="card-header" id="auth_password">
        <h3 class="card-title">
            Password
        </h3>
    </div>

    <form method="POST" action="{{ route('profile.password.update') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
        @method('put')
        <div class="w-full">
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                <label class="form-label max-w-56">
                    {{ __('Current Password') }}
                </label>
                <input class="input" name="current_password" type="password" placeholder="Your current password">
            </div>
            @error('current_password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- New Password -->
        <div class="w-full">
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                <label class="form-label max-w-56">
                    {{ __('New Password') }}
                </label>
                <input class="input" name="password" type="password" placeholder="New password">
            </div>
            @error('password')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <!-- Display a reminder about the minimum length -->
            <p class="text-sm text-gray-500 mt-1">Your password must be at least 6 characters long.</p>
        </div>

        <!-- Confirm New Password -->
        <div class="w-full">
            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                <label class="form-label max-w-56">
                    {{ __('Confirm New Password') }}
                </label>
                <input class="input" name="password_confirmation" type="password" placeholder="Confirm new password">
            </div>
            @error('password_confirmation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end pt-2.5">
            <button class="btn btn-primary">
                {{ __('Save') }}
            </button>
        </div>

        <!-- Success Message -->
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Password updated successfully.') }}</p>
        @endif
    </form>
</div>
