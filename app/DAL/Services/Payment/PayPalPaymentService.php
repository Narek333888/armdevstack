<?php

namespace App\DAL\Services\Payment;

use App\Contracts\IPaymentGateway;
use App\Models\Product;

class PayPalPaymentService implements IPaymentGateway
{
    public function charge(array $data, Product|int $product) { }
}
