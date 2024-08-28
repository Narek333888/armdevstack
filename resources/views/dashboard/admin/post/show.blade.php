@php
    use Illuminate\Support\Facades\Storage;

    $image = $post->image ? Storage::url('posts/' . $post->image) : asset('images/post_thumbnail.svg');
@endphp

<x-dashboard-layout title="{{ $title = 'Post|Show' }}">
    <div class="show-content post-show mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('posts.post') }} - {{ $post->postText->title }}</h6>

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

            <div class="post-image-upload-block">
                <label for="postEditImage" class="form-label mt-3">
                    <img class="post-image" src="{{ $image }}" alt="{{ $post->postText->title }}">
                </label>
            </div>

            <div class="form-check form-switch">
                <input id="isActiveCheckbox" class="form-check-input" type="checkbox" role="switch" @php echo $post->active ? 'checked' : '' @endphp disabled>
                <label>{{ __('posts.show.active') }}</label>
            </div>

            <h6 class="text-muted attached-categories-title attached-post-categories-title">{{ __('posts.categories') }}</h6>

            <div class="post-categories attached-categories">
                @foreach($post->categories as $key => $category)
                    <div class="post-category attached-category">{{ $category->postCategoryText->name }}</div>
                @endforeach
            </div>

            <div class="tab-content pt-3" id="nav-tabContent">
                @include('dashboard.admin.post.partial.form-content.show.translatable.hy')

                @include('dashboard.admin.post.partial.form-content.show.translatable.en')

                @include('dashboard.admin.post.partial.form-content.show.translatable.ru')

                <div class="mt-3">
                    <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm go-back-btn">
                        {{ __('posts.show.go_back') }}
                    </a>

                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm go-back-btn">
                        {{ __('posts.show.edit_post') }}
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
