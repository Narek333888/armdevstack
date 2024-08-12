<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="titleHy"
                       id="titleHy"
                       placeholder="{{ __('posts.edit.title_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $post->postText->getTranslation('title', 'hy') }}"
                       disabled
                >
                <label for="titleHy">{{ __('posts.edit.title_hy_input_label') }}</label>
            </div>

            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="{{ __('posts.create.short_description_hy_input_placeholder') }}"
                    name="shortDescriptionHy"
                    id="shortDescriptionHy"
                    style="height: 150px;" disabled>{{ $post->postText->getTranslation('short_description', 'hy') }}</textarea>
                <label for="shortDescriptionHy">{{ __('posts.edit.short_description_hy_input_label') }}</label>
            </div>

            <div class="form-floating">
                <textarea
                    class="form-control tiny-mce-editor"
                    placeholder="{{ __('posts.create.description_hy_input_placeholder') }}"
                    name="descriptionHy"
                    id="descriptionHy"
                    style="height: 150px;">{{ $post->postText->getTranslation('description', 'hy') }}</textarea>
                <label for="descriptionHy">{{ __('posts.edit.description_hy_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
