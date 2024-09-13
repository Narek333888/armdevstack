<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameEn') is-invalid @enderror"
                       name="nameEn"
                       id="nameEn"
                       placeholder="{{ __('products.edit.name_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $product->productText->getTranslation('name', 'en') ?? old('nameEn') }}"
                >
                <label for="nameHy">{{ __('products.edit.name_en_input_label') }}</label>

                @error('nameEn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('seoUrlEn') is-invalid @enderror"
                       name="seoUrlEn"
                       id="seoUrlEn"
                       placeholder="{{ __('products.edit.seo_url_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $product->productText->getTranslation('seo_url', 'en') ?? old('seoUrlEn') }}"
                >
                <label for="seoUrlEn">{{ __('products.edit.seo_url_en_input_label') }}</label>

                @error('seoUrlEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control @error('shortDescriptionEn') is-invalid @enderror"
                    placeholder="{{ __('products.create.short_description_en_input_placeholder') }}"
                    name="shortDescriptionEn"
                    id="shortDescriptionEn"
                    style="height: 150px;">{{ $product->productText->getTranslation('short_description', 'en') ?? old('shortDescriptionEn') }}</textarea>
                <label
                    for="shortDescriptionEn">{{ __('products.edit.short_description_en_input_label') }}</label>

                @error('shortDescriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('products.show.description_en_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionEn') is-invalid @enderror"
                    placeholder="{{ __('products.create.description_en_input_placeholder') }}"
                    name="descriptionEn"
                    id="descriptionEn"
                    style="height: 150px;">{{ $product->productText->getTranslation('description', 'en') ?? old('descriptionEn') }}</textarea>
                <label for="descriptionEn">{{ __('products.edit.description_en_input_label') }}</label>

                @error('descriptionEn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
