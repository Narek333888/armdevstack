<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameRu"
                       id="nameRu"
                       placeholder="{{ __('product-categories.edit.name_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $productCategory->productCategoryText->getTranslation('name', 'ru') }}"
                       disabled
                >
                <label for="nameRu">{{ __('product-categories.edit.name_ru_input_label') }}</label>
            </div>

            <label>{{ __('product-categories.create.description_ru_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('product-categories.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;" disabled>{{ $productCategory->productCategoryText->getTranslation('description', 'ru') }}</textarea>
                <label for="descriptionRu">{{ __('product-categories.edit.description_ru_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
