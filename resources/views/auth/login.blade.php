<x-guest-layout>
    <!-- Session Status -->
    {{--<x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>--}}

    {{--************************************--}}
    {{--<div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">{{ __('auth.loading') }}</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="{{ route('main.index') }}" class="">
                                <h3 class="text-primary">ArmDevStack</h3>
                            </a>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="{{ __('auth.email_placeholder') }}">
                            <label for="floatingInput">{{ __('auth.email_label') }}</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="{{ __('auth.password_placeholder') }}">
                            <label for="floatingPassword">{{ __('auth.password_label') }}</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">{{ __('auth.remember_me') }}</label>
                            </div>
                            <a href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">{{ __('auth.log_in') }}</button>
                        --}}{{--<p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>--}}{{--
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>--}}

    <div class="container-xxl position-relative d-flex p-0 login-form-container mt-5">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-5 col-lg-6 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="{{ route('main.index') }}" class="">
                                <h3 class="text-primary">ArmDevStack</h3>
                            </a>
                        </div>

                        <form id="loginForm" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('auth.email_placeholder') }}" value="{{ old('email') }}" required>
                                <label class="login-form-label" for="email">{{ __('auth.email_label') }}</label>

                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('auth.password_placeholder') }}" required>
                                <label class="login-form-label" for="password">{{ __('auth.password_label') }}</label>

                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                    <label class="form-check-label" for="remember_me">{{ __('auth.remember_me') }}</label>
                                </div>
                                <a href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">{{ __('auth.log_in') }}</button>
                        </form>
                        {{--<!--<p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>-->--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    @push('guest-scripts')
        <script>
            $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },

                    password: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: '{{ __('validation.required_email') }}',
                        email: '{{ __('validation.valid_email') }}',
                    },
                    password: {
                        required: '{{ __('validation.required_password') }}',
                    },
                }
            });
        </script>
    @endpush
</x-guest-layout>
