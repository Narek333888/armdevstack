<x-guest-layout title="{{ $title = 'Checkout' }}">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">{{ __('general.payment.address.billing_address') }}</h4>

                <form id="paymentForm" action="{{ route('payment.charge', $product->id) }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">
                                {{ __('general.payment.address.first_name_label') }}
                            </label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="{{ __('general.payment.address.first_name_placeholder') }}" value="{{ old('firstName') }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">
                                {{ __('general.payment.address.last_name_label') }}
                            </label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="{{ __('general.payment.address.last_name_placeholder') }}" value="{{ old('lastName') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">
                                {{ __('general.payment.address.email_label') }}
                            </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('general.payment.address.email_placeholder') }}" value="{{ old('email') }}">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">
                                {{ __('general.payment.address.address_label') }}
                            </label>
                            <input type="text" class="form-control" id="address" name="address1" placeholder="{{ __('general.payment.address.address_placeholder') }}" value="{{ old('address1') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">
                                {{ __('general.payment.address.address2_label') }}
                                <span class="text-muted">({{ __('general.payment.address.optional') }})
                                </span>
                            </label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="{{ __('general.payment.address.address2_placeholder') }}" value="{{ old('address2') }}">
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">
                                {{ __('general.payment.address.country_label') }}
                            </label>
                            <select class="form-select shadow-none" id="country" name="country" required>
                                <option value="">{{ __('general.payment.address.choose') }}</option>
                                <option value="US">United States</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">
                                {{ __('general.payment.address.state') }}
                            </label>
                            <select class="form-select shadow-none" id="state" name="state" required>
                                <option value="">
                                    {{ __('general.payment.address.choose') }}
                                </option>
                                <option value="CA">California</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">
                                {{ __('general.payment.address.zip') }}
                            </label>
                            <input type="text" class="form-control" id="zip" name="zip_code" placeholder="" value="{{ old('zip_code') }}" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">{{ __('general.payment.address.payment') }}</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" value="stripe" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">
                                {{ __('general.payment.address.credit_card_number_label') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" value="paypal" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">
                                {{ __('general.payment.address.pay_pal') }}
                            </label>
                        </div>
                    </div>

                    {{-- Stripe Fields --}}
                    <div id="stripeFields" class="payment-fields">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">
                                    {{ __('general.payment.address.name_on_card_label') }}
                                </label>
                                <input type="text" class="form-control" id="cc-name" name="cardHolderName" placeholder="{{ __('general.payment.address.name_on_card_placeholder') }}" value="{{ old('cardHolderName') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">
                                    {{ __('general.payment.address.credit_card_number_label') }}
                                </label>
                                <div id="cardElement" class="form-control"></div>
                            </div>

                            {{--<div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="MM/YY" required>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            </div>--}}
                        </div>
                    </div>

                    {{-- PayPal Fields --}}
                    <div id="paypalFields" class="payment-fields d-none">
                        <p>{{ __('general.payment.pay_pal.after_submitting_you_will_be_redirected_to_paypal_to_complete_your_payment') }}</p>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">
                        {{ __('general.payment.continue_to_checkout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function () {
                handlePaymentForm({
                    stripeKey: '{{ config('payment.stripe.stripe_key') }}',
                    formSelector: '#paymentForm',
                    paymentMethodSelector: 'input[name="paymentMethod"]',
                    nameInputSelector: '#cc-name',
                    methods: {
                        stripe: {
                            fields: {
                                cardElementSelector: '#cardElement',
                                selector: '#stripeFields',
                            },
                            handleSubmit: async ({ stripe, cardElement, billingDetails, formSelector }) => {
                                const { paymentMethod, error } = await stripe.createPaymentMethod({
                                    type: 'card',
                                    card: cardElement,
                                    billing_details: billingDetails,
                                });

                                if (error) {
                                    return { error };
                                } else {
                                    $('<input>').attr({
                                        type: 'hidden',
                                        name: 'stripePaymentMethodId',
                                        value: paymentMethod.id
                                    }).appendTo(formSelector);

                                    return { success: true };
                                }
                            }
                        },
                        paypal: {
                            fields: {
                                selector: '#paypalFields',
                            },
                            handleSubmit: async () => {
                                return { success: true };
                            }
                        }
                        // Add more methods here
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
