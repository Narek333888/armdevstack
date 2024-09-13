<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('titleEn') is-invalid @enderror"
                       name="titleEn"
                       id="titleEn"
                       placeholder="{{ __('posts.create.title_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('titleEn') }}"
                >
                <label for="titleHy">{{ __('posts.create.title_en_input_label') }}</label>

                @error('titleEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control @error('shortDescriptionEn') is-invalid @enderror"
                    placeholder="{{ __('posts.create.short_description_en_input_placeholder') }}"
                    name="shortDescriptionEn"
                    id="shortDescriptionEn"
                    style="height: 150px;">{{ old('shortDescriptionEn') }}</textarea>
                <label for="shortDescriptionEn">{{ __('posts.create.short_description_en_input_label') }}</label>

                @error('shortDescriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('post-categories.create.description_en_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionEn') is-invalid @enderror"
                    placeholder="{{ __('posts.create.description_en_input_placeholder') }}"
                    name="descriptionEn"
                    id="descriptionEn"
                    style="height: 150px;">{{ old('descriptionEn') }}</textarea>
                <label for="descriptionEn">{{ __('posts.create.description_en_input_label') }}</label>

                @error('descriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
