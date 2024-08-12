@php
    use Illuminate\Support\Facades\Storage;

    $image = $post->image ? Storage::url('posts/' . $post->image) : asset('images/post_thumbnail.svg');
@endphp

<x-dashboard-layout title="{{ $title = 'Post|Edit' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('posts.edit.edit_post') }} - {{ $post->postText->title }}</h6>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">{{ __('general.hy') }}</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab"
                            aria-controls="nav-profile" aria-selected="false">{{ __('general.en') }}</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-contact" type="button" role="tab"
                            aria-controls="nav-contact" aria-selected="false">{{ __('general.ru') }}</button>
                </div>
            </nav>

            <form method="post" action="{{ route('post.update', $post->id) }}" id="postUpdateForm" class="w-full"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="page" value="{{ session('post_edit_page', 1) }}">

                <div class="post-image-upload-block">
                    <label for="postEditImage" class="form-label mt-4">
                        <img class="post-image" src="{{ $image }}"
                             alt="{{ $post->postText->title }}">
                    </label>

                    <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
                           id="postEditImage">

                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" @php echo $post->active ? 'checked' : '' @endphp>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="form-floating mt-3 mb-3">
                    <select class="post-categories-select form-select @error('categoryIds') is-invalid @enderror"
                            name="categoryIds[]" multiple="multiple">
                        @foreach($postCategories as $key => $postCategory)
                            <option value="{{ $postCategory->id }}" {{ in_array($postCategory->id, $attachedPostCategories) ? 'selected' : '' }}>
                                {{ $postCategory->postCategoryText->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('categoryIds')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.post.partial.form-content.edit.translatable.hy')

                    @include('dashboard.admin.post.partial.form-content.edit.translatable.en')

                    @include('dashboard.admin.post.partial.form-content.edit.translatable.ru')

                    <div class="mt-3">
                        <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('posts.edit.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('posts.edit.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            initActiveTabs('.nav-link', '.tab-pane');

            initSelect2('.post-categories-select', {
                placeholder: '{{ __('posts.create.select_post_categories') }}',
                allowClear: true,
            })

            initTinyMce('.tiny-mce-editor');
        </script>
    @endpush
</x-dashboard-layout>
