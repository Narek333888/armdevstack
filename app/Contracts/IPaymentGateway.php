<?php

namespace App\Contracts;

use App\Models\Product;

interface IPaymentGateway
{
    public function charge(array $data, int|Product $product);
}
