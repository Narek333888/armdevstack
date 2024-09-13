<x-guest-layout title="{{ $title = 'Payment' }}">
    <div class="container mt-4 mb-4">
        <h2 class="mb-4">{{ __('general.payment.complete_your_payment_for') }} {{ $product->productText->name }}</h2>

        <div class="card">
            <div class="card-header">
                <h4>{{ __('general.payment.select_payment_method') }}</h4>
            </div>

            <div class="card-body">
                <form id="paymentForm" action="{{ route('payment.charge', $product->id) }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="payment-method" class="form-label">{{ __('general.payment.choose_payment_method') }}</label>
                        <select class="form-select payment-methods-select" id="paymentMethod" name="paymentMethod">
                            <option value=""></option>
                            <option value="stripe">{{ __('general.payment.stripe') }}</option>
                            <option value="paypal">{{ __('general.payment.paypal') }}</option>
                        </select>

                        @error('paymentMethod')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="stripeFields" class="payment-fields">
                        <div class="mb-3">
                            <label for="card-holder-name" class="form-label">{{ __('general.payment.card_holder_name') }}</label>
                            <input name="cardHolderName" type="text" id="card-holder-name" class="form-control shadow-none" placeholder="{{ __('general.payment.enter_your_name') }}" value="{{ old('cardHolderName') }}">
                            @error('cardHolderName')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cardElement" class="form-label">{{ __('general.payment.credit_or_debit_card') }}</label>
                            <div id="cardElement" class="form-control shadow-none"></div>
                        </div>
                    </div>

                    <div id="paypalFields" class="payment-fields d-none">
                        <p>{{ __('general.payment.pay_pal.after_submitting_you_will_be_redirected_to_paypal_to_complete_your_payment') }}</p>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('general.payment.pay_now') }} ${{ $product->price }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            {{--$(document).ready(function () {--}}
            {{--    const stripe = Stripe('{{ config('payment.stripe.stripe_key') }}');--}}
            {{--    const elements = stripe.elements();--}}
            {{--    const cardElement = elements.create('card');--}}
            {{--    cardElement.mount('#cardElement');--}}

            {{--    $('#paymentMethod').on('change', function () {--}}
            {{--        const paymentMethod = $(this).val();--}}
            {{--        const baseUrl = "{{ route('payment.charge', ['product' => $product->id]) }}";--}}

            {{--        if(paymentMethod) {--}}
            {{--            $('#paymentForm').action = `${baseUrl}?paymentMethod=${paymentMethod}`;--}}
            {{--        } else {--}}
            {{--            $('#paymentForm').action = baseUrl;--}}
            {{--        }--}}

            {{--        if (paymentMethod === 'stripe') {--}}
            {{--            $('#stripeFields').removeClass('d-none');--}}
            {{--            $('#paypalFields').addClass('d-none');--}}
            {{--        } else if (paymentMethod === 'paypal') {--}}
            {{--            $('#stripeFields').addClass('d-none');--}}
            {{--            $('#paypalFields').removeClass('d-none');--}}
            {{--        }--}}
            {{--    });--}}

            {{--    $('#paymentForm').on('submit', async function (event) {--}}
            {{--        event.preventDefault();--}}

            {{--        const { paymentMethod, error } = await stripe.createPaymentMethod({--}}
            {{--            type: 'card',--}}
            {{--            card: cardElement,--}}
            {{--            billing_details: {--}}
            {{--                name: $('#card-holder-name').val(),--}}
            {{--            },--}}
            {{--        });--}}

            {{--        if (error) {--}}
            {{--            console.error(error);--}}
            {{--        } else {--}}
            {{--            const form = $('#paymentForm');--}}

            {{--            $('<input>').attr({--}}
            {{--                type: 'hidden',--}}
            {{--                name: 'stripePaymentMethodId',--}}
            {{--                value: paymentMethod.id--}}
            {{--            }).appendTo(form);--}}

            {{--            form.off('submit').submit();--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

            initSelect2('.payment-methods-select', {
                placeholder: '{{ __('general.payment.choose_payment_method') }}',
                allowClear: true,
            });
        </script>
    @endpush
</x-guest-layout>
