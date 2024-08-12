@php
    use Illuminate\Support\Facades\Storage;

    $image = $productCategory->image ? Storage::url('productCategories/' . $productCategory->image) : asset('images/post_thumbnail.svg');
@endphp

<x-dashboard-layout title="{{ $title = 'Product Category|Edit' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('product-categories.edit.edit_product_category') }} - {{ $productCategory->productCategoryText->name }}</h6>

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

            <form method="post" action="{{ route('product-category.update', $productCategory->id) }}" id="productCategoryUpdateForm" class="w-full"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="page" value="{{ session('product', 1) }}">

                <div class="product-category-image-upload-block">
                    <label for="productCategoryEditImage" class="form-label mt-4">
                        <img class="product-category-image" src="{{ $image }}"
                             alt="{{ $productCategory->productCategoryText->title }}">
                    </label>

                    <input name="image" class="form-control @error('image') is-invalid @enderror" type="file"
                           id="productCategoryEditImage">

                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" @php echo $productCategory->is_active ? 'checked' : '' @endphp>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.product-category.partial.form-content.edit.translatable.hy')

                    @include('dashboard.admin.product-category.partial.form-content.edit.translatable.en')

                    @include('dashboard.admin.product-category.partial.form-content.edit.translatable.ru')

                    <div class="mt-3">
                        <a href="{{ route('product-category.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('product-categories.edit.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('product-categories.edit.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            //$('#productCategoryUpdateForm').validate();

            initActiveTabs('.nav-link', '.tab-pane');

            initTinyMce('.tiny-mce-editor');
        </script>
    @endpush
</x-dashboard-layout>
