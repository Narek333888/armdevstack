<x-guest-layout title="{{ $title = 'Payment|Failure' }}">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="display-4 text-danger mb-4">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>

                        <h2 class="card-title">{{ __('general.payment.failure_title') }}</h2>

                        <p class="card-text">
                            {{ __('general.payment.failure_message') }}
                        </p>

                        <a href="{{ route('frontend.product.index') }}" class="btn btn-primary mt-3">
                            {{ __('general.payment.go_to_products_page') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
