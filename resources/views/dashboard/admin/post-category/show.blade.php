@php
    use Illuminate\Support\Facades\Storage;

    $image = $postCategory->image ? Storage::url('postCategories/' . $postCategory->image) : asset('images/post_thumbnail.svg');
@endphp

<x-dashboard-layout title="{{ $title = 'Post Category|Show' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('post-categories.post_category') }} - {{ $postCategory->postCategoryText->name }}</h6>

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

            <div class="post-category-image-upload-block">
                <label for="postCategoryEditImage" class="form-label mt-4">
                    <img class="post-category-image" src="{{ $image }}" alt="{{ $postCategory->postCategoryText->title }}">
                </label>
            </div>

            <div class="form-check form-switch">
                <input id="isActiveCheckbox" class="form-check-input" type="checkbox" role="switch" @php echo $postCategory->is_active ? 'checked' : '' @endphp disabled>
                <label>{{ __('post-categories.show.active') }}</label>
            </div>

            <div class="tab-content pt-3" id="nav-tabContent">
                @include('dashboard.admin.post-category.partial.form-content.show.translatable.hy')

                @include('dashboard.admin.post-category.partial.form-content.show.translatable.en')

                @include('dashboard.admin.post-category.partial.form-content.show.translatable.ru')

                <div class="mt-3">
                    <a href="{{ route('post-category.index') }}" class="btn btn-secondary btn-sm go-back-btn">
                        {{ __('post-categories.show.go_back') }}
                    </a>

                    <a href="{{ route('post-category.edit', $postCategory->id) }}" class="btn btn-success btn-sm go-back-btn">
                        {{ __('post-categories.show.edit_post_category') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            initTinyMce('.tiny-mce-editor', [], {
                readonly: true,
            });
        </script>
    @endpush
</x-dashboard-layout>
