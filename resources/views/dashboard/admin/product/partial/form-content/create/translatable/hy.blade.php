<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameHy') is-invalid @enderror"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('products.create.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('nameHy') }}"
                >
                <label for="nameHy">{{ __('products.create.name_hy_input_label') }}</label>

                @error('nameHy')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control @error('shortDescriptionHy') is-invalid @enderror"
                    placeholder="{{ __('products.create.short_description_hy_input_placeholder') }}"
                    name="shortDescriptionHy"
                    id="shortDescriptionHy"
                    style="height: 150px;">{{ old('shortDescriptionHy') }}</textarea>
                <label for="shortDescriptionHy">{{ __('products.create.short_description_hy_input_label') }}</label>

                @error('shortDescriptionHy')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('products.create.description_hy_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionHy') is-invalid @enderror"
                    placeholder="{{ __('products.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;">{{ old('descriptionHy') }}</textarea>
                <label for="descriptionHy">{{ __('products.create.description_hy_input_label') }}</label>

                @error('descriptionHy')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
