<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.update_your_accounts_profile_information_and_email_address') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('profile.name_input_label') }}</label>
            <input id="name" name="name" type="text" class="form-control mt-1" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('profile.email_input_label') }}</label>
            <input id="email" name="email" type="email" class="form-control mt-1" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-800 dark:text-gray-200">
                        {{ __('profile.your_email_address_is_unverified.') }}

                        <button form="send-verification" class="btn btn-link">
                            {{ __('profile.click_here_to_re_send_the_verification_email') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            {{ __('profile.a_new_verification_link_has_been_sent_to_your_email_address') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3 d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('profile.save') }}</button>

            {{--@if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('profile.saved') }}</p>
            @endif--}}
        </div>
    </form>
</section>
