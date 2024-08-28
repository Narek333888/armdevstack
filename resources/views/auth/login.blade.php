<x-guest-layout title="{{ $title = 'Login' }}">
    <div class="container-xxl position-relative d-flex p-0 login-form-container mt-5">
        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-sm-8 col-md-5 col-lg-6 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <a href="{{ route('main.index') }}" class="">
                                <h3 class="text-primary">{{ config('app.name') }}</h3>
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
