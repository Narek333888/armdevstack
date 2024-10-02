<x-guest-layout title="{{ $title = 'Products' }}">
    <div class="container front-products-container my-5">
        <h1 class="text-center">{{ __('general.frontend.products') }}</h1>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            @foreach($products as $key => $product)
                <div class="col">
                    <div class="card product-card h-100">
                        <img src="{{ asset($product->thumbnailImage) }}" class="card-img-top product-card-image" alt="Product 1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->productText->name }}</h5>

                            <p class="card-text">{{ Str::words($product->productText->short_description, 15) }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                        </div>
                        <div class="card-footer">
                            {{--<a href="#" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </a>--}}
                            <a href="{{ route('payment.checkout', $product) }}" class="btn btn-primary w-100">
                                {{ __('general.buy') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 mb-5">
            {{ $products->onEachSide(5)->links() }}
        </div>
    </div>
</x-guest-layout>
