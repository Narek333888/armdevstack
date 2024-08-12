<x-dashboard-layout title="{{ $title = 'Post Category|Create' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('post-categories.create.create_new_post_category') }}</h6>
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

            <form method="post" action="{{ route('post-category.store') }}" id="postCategoryCreateForm" class="w-full" enctype="multipart/form-data">
                @csrf

                <div class="">
                    <label for="postCategoryCreateImage" class="form-label mt-4">{{ __('post-categories.create.image') }}</label>
                    <input name="image" class="form-control @error('image') is-invalid @enderror" type="file" id="postCategoryCreateImage">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" checked>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.post-category.partial.form-content.create.translatable.hy')

                    @include('dashboard.admin.post-category.partial.form-content.create.translatable.en')

                    @include('dashboard.admin.post-category.partial.form-content.create.translatable.ru')

                    <div class="mt-3">
                        <a href="{{ route('post-category.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('post-categories.create.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('post-categories.create.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            //$('#postCategoryUpdateForm').validate();

            initActiveTabs('.nav-link', '.tab-pane');

            initTinyMce('.tiny-mce-editor');
        </script>
    @endpush
</x-dashboard-layout>
