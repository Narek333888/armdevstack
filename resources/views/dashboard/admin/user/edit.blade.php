<x-dashboard-layout title="{{ $title = 'User|Edit' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('users.edit.edit_user') }} - {{ $user->getTranslation('name', app()->getLocale()) }}</h6>

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

            <form method="post" action="{{ route('user.update', $user->id) }}" id="userUpdateForm" class="w-full"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="page" value="{{ session('user_edit_page', 1) }}">
                <input type="hidden" name="userId" value="{{ $user->id }}">

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" @php echo $user->active_status ? 'checked' : '' @endphp>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.user.partial.form-content.edit.translatable.hy')

                    @include('dashboard.admin.user.partial.form-content.edit.translatable.en')

                    @include('dashboard.admin.user.partial.form-content.edit.translatable.ru')

                    <div class="form-floating mb-3">
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               placeholder="{{ __('users.edit.email_input_placeholder') }}"
                               autocomplete="off"
                               value="{{ $user->email ?? old('email') }}"
                        >
                        <label for="email">{{ __('users.edit.email_input_label') }}</label>

                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('users.edit.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('users.edit.update') }}
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
        </script>
    @endpush
</x-dashboard-layout>
