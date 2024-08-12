<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="titleEn"
                       id="titleEn"
                       placeholder="{{ __('posts.edit.title_en_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $post->postText->getTranslation('title', 'en') }}"
                       disabled
                >
                <label for="titleHy">{{ __('posts.edit.title_en_input_label') }}</label>
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="{{ __('posts.create.short_description_en_input_placeholder') }}"
                    name="shortDescriptionEn"
                    id="shortDescriptionEn"
                    style="height: 150px;" disabled>{{ $post->postText->getTranslation('short_description', 'en') }}</textarea>
                <label for="shortDescriptionEn">{{ __('posts.edit.short_description_en_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('posts.create.description_en_input_placeholder') }}"
                    name="descriptionEn"
                    id="descriptionEn"
                    style="height: 150px;">{{ $post->postText->getTranslation('description', 'en') }}</textarea>
                <label for="descriptionEn">{{ __('posts.edit.description_en_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
