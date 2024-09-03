<x-dashboard-layout title="{{ $title = 'User|Show' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('users.user') }} - {{ $user->getTranslation('name', app()->getLocale()) }}</h6>

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

            <div class="form-check form-switch mt-3">
                <input id="isActiveCheckbox" class="form-check-input" type="checkbox" role="switch" @php echo $user->active_status ? 'checked' : '' @endphp disabled>
                <label>{{ __('users.show.active') }}</label>
            </div>

            <div class="tab-content pt-3" id="nav-tabContent">
                @include('dashboard.admin.user.partial.form-content.show.translatable.hy')

                @include('dashboard.admin.user.partial.form-content.show.translatable.en')

                @include('dashboard.admin.user.partial.form-content.show.translatable.ru')

                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control"
                           name="email"
                           id="email"
                           placeholder="{{ __('users.edit.email_input_placeholder') }}"
                           autocomplete="off"
                           value="{{ $user->email }}"
                           disabled
                    >
                    <label for="email">{{ __('users.edit.email_input_label') }}</label>
                </div>

                <div class="mt-3">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm go-back-btn">
                        {{ __('users.show.go_back') }}
                    </a>

                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm go-back-btn">
                        {{ __('users.show.edit_user') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            initTinyMce('.tiny-mce-editor', [], {
                readonly: true,
            });
        </script>
    @endpush
</x-dashboard-layout>
