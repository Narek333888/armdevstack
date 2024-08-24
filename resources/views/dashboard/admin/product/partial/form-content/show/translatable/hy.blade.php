<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('products.edit.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $product->productText->getTranslation('name', 'hy') }}"
                       disabled
                >
                <label for="nameHy">{{ __('products.edit.name_hy_input_label') }}</label>
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="{{ __('products.create.short_description_hy_input_placeholder') }}"
                    name="shortDescriptionHy"
                    id="shortDescriptionHy"
                    style="height: 150px;" disabled>{{ $product->productText->getTranslation('short_description', 'hy') }}</textarea>
                <label for="shortDescriptionHy">{{ __('products.edit.short_description_hy_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('products.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;">{{ $product->productText->getTranslation('description', 'hy') }}</textarea>
                <label for="descriptionHy">{{ __('products.edit.description_hy_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
