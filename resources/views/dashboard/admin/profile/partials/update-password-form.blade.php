<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.update_password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.ensure_your_account_is_using_a_long_random_password_to_stay_secure') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="update_password_current_password" :value="__('profile.current_password_input_label')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 form-control" autocomplete="current-password" required />
            {{--<x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />--}}
            @error('current_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password" :value="__('profile.new_password_input_label')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 form-control" autocomplete="new-password" required />
            {{--<x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />--}}
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('profile.confirm_password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 form-control" autocomplete="new-password" required />
            {{--<x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />--}}
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>

            {{--@if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif--}}
        </div>
    </form>
</section>

@push('scripts')
    <script>
        $('#updatePasswordForm').validate({
            rules: {
                current_password: {
                    required: true,
                },

                password: {
                    required: true,
                },

                password_confirmation: {
                    required: true,
                },
            },
            messages: {
                current_password: {
                    required: '{{ __('validation.required_password') }}',
                },
                password: {
                    required: '{{ __('validation.required_password') }}',
                },
                password_confirmation: '{{ __('validation.required_password') }}',
            }
        });
    </script>
@endpush
