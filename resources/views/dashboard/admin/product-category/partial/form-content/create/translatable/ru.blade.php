<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameRu') is-invalid @enderror"
                       name="nameRu"
                       id="nameRu"
                       placeholder="{{ __('product-categories.create.name_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('nameRu') }}"
                >
                <label for="nameRu">{{ __('product-categories.create.name_ru_input_label') }}</label>

                @error('nameRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('product-categories.create.description_ru_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionRu') is-invalid @enderror"
                    placeholder="{{ __('product-categories.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;">{{ old('descriptionRu') }}</textarea>
                <label for="descriptionRu">{{ __('product-categories.create.description_ru_input_label') }}</label>

                @error('descriptionRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
