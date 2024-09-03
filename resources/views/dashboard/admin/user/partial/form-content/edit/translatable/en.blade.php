<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameEn') is-invalid @enderror"
                       name="nameEn"
                       id="nameEn"
                       placeholder="{{ __('users.edit.name_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $user->getTranslation('name', 'en') ?? old('nameEn') }}"
                >
                <label for="nameEn">{{ __('users.edit.name_en_input_label') }}</label>

                @error('nameEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
