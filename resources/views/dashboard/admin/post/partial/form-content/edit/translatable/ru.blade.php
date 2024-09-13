<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('titleRu') is-invalid @enderror"
                       name="titleRu"
                       id="titleRu"
                       placeholder="{{ __('posts.edit.title_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $post->postText->getTranslation('title', 'ru') ?? old('titleRu') }}"
                >
                <label for="titleRu">{{ __('posts.edit.title_ru_input_label') }}</label>

                @error('titleRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control @error('seoUrlRu') is-invalid @enderror"
                       name="seoUrlRu"
                       id="seoUrlRu"
                       placeholder="{{ __('posts.edit.seo_url_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $post->postText->getTranslation('seo_url', 'ru') ?? old('seoUrlRu') }}"
                >
                <label for="seoUrlRu">{{ __('posts.edit.seo_url_ru_input_label') }}</label>

                @error('seoUrlRu')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control @error('shortDescriptionRu') is-invalid @enderror"
                    placeholder="{{ __('posts.create.short_description_ru_input_placeholder') }}"
                    name="shortDescriptionRu"
                    id="shortDescriptionRu"
                    style="height: 150px;">{{ $post->postText->getTranslation('short_description', 'ru') ?? old('shortDescriptionRu') }}</textarea>
                <label for="shortDescriptionRu">{{ __('posts.edit.short_description_ru_input_label') }}</label>

                @error('shortDescriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>{{ __('post-categories.create.description_ru_input_label') }}</label>
            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor @error('descriptionRu') is-invalid @enderror"
                    placeholder="{{ __('posts.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;">{{ $post->postText->getTranslation('description', 'ru') ?? old('descriptionRu') }}</textarea>
                <label for="descriptionRu">{{ __('posts.edit.description_ru_input_label') }}</label>

                @error('descriptionEn')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
