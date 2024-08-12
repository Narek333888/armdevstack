<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation" novalidate>
        @csrf

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('auth.password') }}</label>
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            <div class="invalid-feedback">
                @error('password')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
        </div>
    </form>
</x-guest-layout>
