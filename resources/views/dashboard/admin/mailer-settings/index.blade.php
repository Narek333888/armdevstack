<x-dashboard-layout :title="$title = 'Mailer Settings'">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="mailer-settings-content mt-5 mb-5">
                    <form method="post" action="{{ route('mailer-settings.update-or-create') }}" id="mailerSettingsUpdateOrCreateForm" class="w-full">
                        @csrf

                        <input type="hidden" name="uniqueKey" value="mailer_setting">

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('mailer') is-invalid @enderror"
                                       name="mailer"
                                       id="mailer"
                                       placeholder="{{ __('mailer-settings.edit.mailer_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->mailer ?? old('mailer') }}"
                                >
                                <label for="mailer">{{ __('mailer-settings.edit.mailer_input_label') }}</label>

                                @error('mailer')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('host') is-invalid @enderror"
                                       name="host"
                                       id="host"
                                       placeholder="{{ __('mailer-settings.edit.host_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->host ?? old('host') }}"
                                >
                                <label for="host">{{ __('mailer-settings.edit.host_input_label') }}</label>

                                @error('host')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('port') is-invalid @enderror"
                                       name="port"
                                       id="port"
                                       placeholder="{{ __('mailer-settings.edit.port_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->port ?? old('port') }}"
                                >
                                <label for="port">{{ __('mailer-settings.edit.port_input_label') }}</label>

                                @error('port')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       name="username"
                                       id="username"
                                       placeholder="{{ __('mailer-settings.edit.username_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->username ?? old('username') }}"
                                >
                                <label for="username">{{ __('mailer-settings.edit.username_input_label') }}</label>

                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password"
                                       id="password"
                                       placeholder="{{ __('mailer-settings.edit.password_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->password ?? old('password') }}"
                                >
                                <label for="password">{{ __('mailer-settings.edit.password_input_label') }}</label>

                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('encryption') is-invalid @enderror"
                                       name="encryption"
                                       id="encryption"
                                       placeholder="{{ __('mailer-settings.edit.encryption_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->encryption ?? old('encryption') }}"
                                >
                                <label for="encryption">{{ __('mailer-settings.edit.encryption_input_label') }}</label>

                                @error('encryption')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('fromName') is-invalid @enderror"
                                       name="fromName"
                                       id="from-name"
                                       placeholder="{{ __('mailer-settings.edit.from_name_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->from_name ?? old('fromName') }}"
                                >
                                <label for="from-name">{{ __('mailer-settings.edit.from_name_input_label') }}</label>

                                @error('fromName')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="rounded">
                            <div class="form-floating mb-3">
                                <input type="text"
                                       class="form-control @error('fromAddress') is-invalid @enderror"
                                       name="fromAddress"
                                       id="from-address"
                                       placeholder="{{ __('mailer-settings.edit.from_address_input_placeholder') }}"
                                       autocomplete="off"
                                       value="{{ $mailerSetting->from_address ?? old('fromAddress') }}"
                                >
                                <label for="from-address">{{ __('mailer-settings.edit.from_address_input_label') }}</label>

                                @error('fromAddress')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('main.index') }}" class="btn btn-secondary btn-sm">
                                {{ __('mailer-settings.edit.go_back') }}
                            </a>

                            <button class="btn btn-primary btn-sm" type="submit">
                                {{ __('mailer-settings.edit.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
