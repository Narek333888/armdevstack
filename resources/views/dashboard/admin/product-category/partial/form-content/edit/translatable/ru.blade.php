<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameRu') is-invalid @enderror"
                       name="nameRu"
                       id="nameRu"
                       placeholder="{{ __('product-categories.edit.name_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $productCategory->productCategoryText->getTranslation('name', 'ru') ?? old('nameRu') }}"
                >
                <label for="nameRu">{{ __('product-categories.edit.name_ru_input_label') }}</label>

                @error('nameRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('seoUrlRu') is-invalid @enderror"
                       name="seoUrlRu"
                       id="seoUrlRu"
                       placeholder="{{ __('product-categories.edit.seo_url_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $productCategory->productCategoryText->getTranslation('seo_url', 'ru') ?? old('seoUrlRu') }}"
                >
                <label for="seoUrlRu">{{ __('product-categories.edit.seo_url_ru_input_label') }}</label>

                @error('seoUrlRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionRu') is-invalid @enderror"
                    placeholder="{{ __('product-categories.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;">{{ $productCategory->productCategoryText->getTranslation('description', 'ru') ?? old('descriptionRu') }}</textarea>
                <label for="descriptionRu">{{ __('product-categories.edit.description_ru_input_label') }}</label>

                @error('descriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
