<x-dashboard-layout title="{{ $title = 'User|Create' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('users.create.create_new_user') }}</h6>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">{{ __('general.hy') }}</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab"
                            aria-controls="nav-profile" aria-selected="false">{{ __('general.en') }}</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-contact" type="button" role="tab"
                            aria-controls="nav-contact" aria-selected="false">{{ __('general.ru') }}</button>
                </div>
            </nav>

            <form method="post" action="{{ route('user.store') }}" id="userCreateForm" class="w-full" enctype="multipart/form-data">
                @csrf

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" checked>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="form-floating mt-3">
                    <select class="roles-select form-select shadow-none @error('roleIds') is-invalid @enderror" name="roleIds[]" multiple="multiple">
                        @foreach($roles as $key => $role)
                            @if($role)
                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    @error('roleIds')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.user.partial.form-content.create.translatable.hy')

                    @include('dashboard.admin.user.partial.form-content.create.translatable.en')

                    @include('dashboard.admin.user.partial.form-content.create.translatable.ru')

                    <div class="form-floating mb-3">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               placeholder="{{ __('users.create.email_input_placeholder') }}"
                               autocomplete="off"
                               value="{{ old('email') }}"
                        >
                        <label for="email">{{ __('users.create.email_input_label') }}</label>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{--<div class="form-floating mb-3">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               placeholder="{{ __('users.create.password_input_placeholder') }}"
                               autocomplete="off"
                               value="{{ old('password') }}"
                        >
                        <label for="password">{{ __('users.create.password_input_label') }}</label>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>--}}

                    <div class="mt-3">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('users.create.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('users.create.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            initActiveTabs('.nav-link', '.tab-pane');

            initTinyMce('.tiny-mce-editor');

            initSelect2('.roles-select', {
                placeholder: '{{ __('roles.create.select_roles') }}',
                allowClear: true,
            })
        </script>
    @endpush
</x-dashboard-layout>
