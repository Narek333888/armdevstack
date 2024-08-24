<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameRu"
                       id="nameRu"
                       placeholder="{{ __('products.edit.name_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $product->productText->getTranslation('name', 'ru') }}"
                       disabled
                >
                <label for="nameRu">{{ __('products.edit.name_ru_input_label') }}</label>
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="{{ __('products.create.short_description_ru_input_placeholder') }}"
                    name="shortDescriptionRu"
                    id="shortDescriptionRu"
                    style="height: 150px;" disabled>{{ $product->productText->getTranslation('short_description', 'ru') }}</textarea>
                <label for="shortDescriptionRu">{{ __('products.edit.short_description_ru_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('products.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;">{{ $product->productText->getTranslation('description', 'ru') }}</textarea>
                <label for="descriptionRu">{{ __('products.edit.description_ru_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
