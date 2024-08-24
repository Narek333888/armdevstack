<x-dashboard-layout title="{{ $title = 'Product|Create' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('products.create.create_new_product') }}</h6>
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

            <form method="post" action="{{ route('product.store') }}" id="productCreateForm" class="w-full" enctype="multipart/form-data">
                @csrf

                <div class="">
                    <label for="productCreateImage" class="form-label mt-4">{{ __('products.create.image') }}</label>
                    <input name="image" class="form-control @error('image') is-invalid @enderror" type="file" id="productCreateImage">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mt-3">
                    <input name="active" class="form-check-input" type="checkbox" role="switch"
                           id="isActiveCheckbox" checked>
                    <label class="form-check-label" for="isActiveCheckbox">Active</label>
                </div>

                <div class="form-check form-switch mt-3">
                    <input name="showInHome" class="form-check-input" type="checkbox" role="switch"
                           id="showInHomeCheckbox" checked>
                    <label class="form-check-label" for="showInHomeCheckbox">Show In Home</label>
                </div>

                <div class="form-floating mt-3 mb-3">
                    <select class="product-categories-select form-select @error('categoryId') is-invalid @enderror" name="categoryId">
                        @foreach($productCategories as $key => $productCategory)
                            <option value="{{ $productCategory->id }}">
                                {{ $productCategory->productCategoryText->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('categoryId')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control @error('price') is-invalid @enderror"
                           name="price"
                           id="price"
                           placeholder="{{ __('products.create.price_input_placeholder') }}"
                           autocomplete="off"
                           value="{{ old('price') }}"
                    >
                    <label for="price">{{ __('products.create.price_input_label') }}</label>

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="tab-content pt-3" id="nav-tabContent">
                    @include('dashboard.admin.product.partial.form-content.create.translatable.hy')

                    @include('dashboard.admin.product.partial.form-content.create.translatable.en')

                    @include('dashboard.admin.product.partial.form-content.create.translatable.ru')

                    <div class="mt-3">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                            {{ __('products.create.go_back') }}
                        </a>

                        <button class="btn btn-primary btn-sm" type="submit">
                            {{ __('products.create.create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            //$('#productUpdateForm').validate();

            initActiveTabs('.nav-link', '.tab-pane');

            initSelect2('.product-categories-select', {
                placeholder: '{{ __('products.create.select_product_category') }}',
                allowClear: true,
            })

            initTinyMce('.tiny-mce-editor');
        </script>
    @endpush
</x-dashboard-layout>
