<?php

namespace App\Services\Payment;

use App\Contracts\IPaymentGateway;
use App\Models\Product;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentService implements IPaymentGateway
{
    public function __construct()
    {
        Stripe::setApiKey(config('payment.stripe.stripe_secret'));
    }

    /**
     * @param array $data
     * @param Product|int $product
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    public function charge(array $data, Product|int $product): PaymentIntent
    {
        return PaymentIntent::create([
            'amount' => $product->price * 100,
            'currency' => 'usd',
            'payment_method' => $data['stripePaymentMethodId'],
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('payment.success'),
        ]);
    }
}
