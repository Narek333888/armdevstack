@php
    use Illuminate\Support\Facades\Storage;

    $image = $product->image ? Storage::url('products/' . $product->image) : asset('images/post_thumbnail.svg');
@endphp

<x-dashboard-layout title="{{ $title = 'Product|Show' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('products.product') }} - {{ $product->productText->name }}</h6>

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

            <div class="product-image-upload-block">
                <label for="productEditImage" class="form-label mt-4">
                    <img class="product-image" src="{{ $image }}" alt="{{ $product->productText->name }}">
                </label>
            </div>

            <div class="form-check form-switch">
                <input id="isActiveCheckbox" class="form-check-input" type="checkbox" role="switch" @php echo $product->active ? 'checked' : '' @endphp disabled>
                <label>{{ __('products.show.active') }}</label>
            </div>

            <div class="form-check form-switch">
                <input id="showInHomeCheckbox" class="form-check-input" type="checkbox" role="switch" @php echo $product->show_in_home ? 'checked' : '' @endphp disabled>
                <label>{{ __('products.show_in_home') }}</label>
            </div>

            <div class="form-floating mt-3">
                <input type="text"
                       class="form-control"
                       name="price"
                       id="price"
                       placeholder="{{ __('products.create.price_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $product->price }} $"
                       disabled
                >
                <label for="price">{{ __('products.create.price_input_label') }}</label>
            </div>

            <div class="tab-content pt-3" id="nav-tabContent">
                @include('dashboard.admin.product.partial.form-content.show.translatable.hy')

                @include('dashboard.admin.product.partial.form-content.show.translatable.en')

                @include('dashboard.admin.product.partial.form-content.show.translatable.ru')

                <div class="mt-3">
                    <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm go-back-btn">
                        {{ __('products.show.go_back') }}
                    </a>

                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-success btn-sm go-back-btn">
                        {{ __('products.show.edit_product') }}
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
