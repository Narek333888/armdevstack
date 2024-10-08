<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('titleHy') is-invalid @enderror"
                       name="titleHy"
                       id="titleHy"
                       placeholder="{{ __('posts.create.title_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ old('titleHy') }}"
                >
                <label for="titleHy">{{ __('posts.create.title_hy_input_label') }}</label>

                @error('titleHy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control @error('shortDescriptionHy') is-invalid @enderror"
                    placeholder="{{ __('posts.create.short_description_hy_input_placeholder') }}"
                    name="shortDescriptionHy"
                    id="shortDescriptionHy"
                    style="height: 150px;">{{ old('shortDescriptionHy') }}</textarea>
                <label for="shortDescriptionHy">{{ __('posts.create.short_description_hy_input_label') }}</label>

                @error('shortDescriptionHy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('post-categories.create.description_hy_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionHy') is-invalid @enderror"
                    placeholder="{{ __('posts.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;">{{ old('descriptionHy') }}</textarea>
                <label for="descriptionHy">{{ __('posts.create.description_hy_input_label') }}</label>

                @error('descriptionHy')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
