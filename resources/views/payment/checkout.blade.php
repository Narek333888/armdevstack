<x-guest-layout title="{{ $title = 'Checkout' }}">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">Billing Address</h4>

                <form id="paymentForm" action="{{ route('payment.charge', $product->id) }}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="John" value="{{ old('first_name') }}" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Doe" value="{{ old('last_name') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address1" placeholder="1234 Main St" value="{{ old('address1') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite" value="{{ old('address2') }}">
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select shadow-none" id="country" name="country" required>
                                <option value="">Choose...</option>
                                <option value="US">United States</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select shadow-none" id="state" name="state" required>
                                <option value="">Choose...</option>
                                <option value="CA">California</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip_code" placeholder="" value="{{ old('zip_code') }}" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" value="stripe" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" value="paypal" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                    </div>

                    {{-- Stripe Fields --}}
                    <div id="stripeFields" class="payment-fields">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" name="cardHolderName" placeholder="BOB SMITH" value="{{ old('cardHolderName') }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
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
                        <p>You will be redirected to PayPal to complete your payment.</p>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const stripe = Stripe('{{ config('payment.stripe.stripe_key') }}');
                const elements = stripe.elements();
                const cardElement = elements.create('card');
                cardElement.mount('#cardElement');

                document.querySelector('#paymentForm').addEventListener('submit', async function (event) {
                    const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
                    if (paymentMethod === 'stripe') {
                        event.preventDefault();

                        const { paymentMethod, error } = await stripe.createPaymentMethod({
                            type: 'card',
                            card: cardElement,
                            billing_details: {
                                name: document.querySelector('#cc-name').value,
                            },
                        });

                        if (error) {
                            console.error(error);
                        } else {
                            const form = document.querySelector('#paymentForm');
                            const hiddenInput = document.createElement('input');
                            hiddenInput.setAttribute('type', 'hidden');
                            hiddenInput.setAttribute('name', 'stripePaymentMethodId');
                            hiddenInput.setAttribute('value', paymentMethod.id);
                            form.appendChild(hiddenInput);

                            form.submit();
                        }
                    }
                });

                document.querySelector('input[name="paymentMethod"]').addEventListener('change', function () {
                    const paymentMethod = this.value;
                    if (paymentMethod === 'stripe') {
                        document.querySelector('#stripeFields').classList.remove('d-none');
                        document.querySelector('#paypalFields').classList.add('d-none');
                    } else if (paymentMethod === 'paypal') {
                        document.querySelector('#stripeFields').classList.add('d-none');
                        document.querySelector('#paypalFields').classList.remove('d-none');
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
