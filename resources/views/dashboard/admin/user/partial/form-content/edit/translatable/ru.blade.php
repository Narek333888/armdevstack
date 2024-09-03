<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameRu') is-invalid @enderror"
                       name="nameRu"
                       id="nameRu"
                       placeholder="{{ __('users.edit.name_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $user->getTranslation('name', 'ru') ?? old('nameRu') }}"
                >
                <label for="nameRu">{{ __('users.edit.name_ru_input_label') }}</label>

                @error('nameRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
