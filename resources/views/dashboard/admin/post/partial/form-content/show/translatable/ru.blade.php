<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="titleRu"
                       id="titleRu"
                       placeholder="{{ __('posts.edit.title_ru_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $post->postText->getTranslation('title', 'ru') }}"
                       disabled
                >
                <label for="titleRu">{{ __('posts.edit.title_ru_input_label') }}</label>
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="{{ __('posts.create.short_description_ru_input_placeholder') }}"
                    name="shortDescriptionRu"
                    id="shortDescriptionRu"
                    style="height: 150px;" disabled>{{ $post->postText->getTranslation('short_description', 'ru') }}</textarea>
                <label for="shortDescriptionRu">{{ __('posts.edit.short_description_ru_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('posts.create.description_ru_input_placeholder') }}"
                    name="descriptionRu"
                    id="descriptionRu"
                    style="height: 150px;">{{ $post->postText->getTranslation('description', 'ru') }}</textarea>
                <label for="descriptionRu">{{ __('posts.edit.description_ru_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
