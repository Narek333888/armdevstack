<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameEn"
                       id="nameEn"
                       placeholder="{{ __('product-categories.edit.name_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $productCategory->productCategoryText->getTranslation('name', 'en') }}"
                       disabled
                >
                <label for="nameEn">{{ __('product-categories.create.name_en_input_label') }}</label>
            </div>

            <label>{{ __('product-categories.create.description_en_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('product-categories.create.description_en_input_placeholder') }}"
                    name="descriptionEn"
                    id="descriptionEn"
                    style="height: 150px;" disabled>{{ $productCategory->productCategoryText->getTranslation('description', 'en') }}</textarea>
                <label for="descriptionEn">{{ __('product-categories.edit.description_en_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
