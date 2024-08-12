<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameEn') is-invalid @enderror"
                       name="nameEn"
                       id="nameEn"
                       placeholder="{{ __('post-categories.create.name_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('nameEn') }}"
                >
                <label for="nameEn">{{ __('post-categories.create.name_en_input_label') }}</label>

                @error('nameEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionEn') is-invalid @enderror"
                    placeholder="{{ __('post-categories.create.description_en_input_placeholder') }}"
                    name="descriptionEn"
                    id="descriptionEn"
                    style="height: 150px;">{{ old('descriptionEn') }}</textarea>
                <label for="descriptionEn">{{ __('post-categories.create.description_en_input_label') }}</label>

                @error('descriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
