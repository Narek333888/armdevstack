<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameHy') is-invalid @enderror"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('product-categories.create.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('nameHy') }}"
                >
                <label for="nameHy">{{ __('product-categories.create.name_hy_input_label') }}</label>

                @error('nameHy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionHy') is-invalid @enderror"
                    placeholder="{{ __('product-categories.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;">{{ old('descriptionHy') }}</textarea>
                <label for="descriptionHy">{{ __('product-categories.create.description_hy_input_label') }}</label>

                @error('descriptionHy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
