<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('nameHy') is-invalid @enderror"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('users.create.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('nameHy') }}"
                >
                <label for="nameHy">{{ __('users.create.name_hy_input_label') }}</label>

                @error('nameHy')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
