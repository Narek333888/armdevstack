<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('product-categories.edit.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $productCategory->productCategoryText->getTranslation('name', 'hy') }}"
                       disabled
                >
                <label for="nameHy">{{ __('product-categories.edit.name_hy_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('product-categories.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;" disabled>{{ $productCategory->productCategoryText->getTranslation('description', 'hy') }}</textarea>
                <label for="descriptionHy">{{ __('product-categories.edit.description_hy_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
