<?php

namespace App\Http\Controllers\Payment;

use App\Contracts\IPaymentGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ChargeRequest;
use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    private IPaymentGateway $paymentGateway;

    /**
     * @param IPaymentGateway $paymentGateway
     */
    public function __construct(IPaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * @param Product $product
     * @return Renderable
     */
    public function checkout(Product $product): Renderable
    {
        return view('payment.checkout', [
            'product' => $product,
        ]);
    }

    /**
     * @param ChargeRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function charge(ChargeRequest $request, Product $product): RedirectResponse
    {
        $paymentIntent = $this->paymentGateway->charge($request->validated(), $product);

        if ($paymentIntent->status == 'succeeded')
        {
            return to_route('payment.success')->with('success', __('general.payment.success_message'));
        }

        return to_route('payment.failure')->with('fail', __('general.payment.failure_message'));
    }

    /**
     * @return Renderable
     */
    public function success(): Renderable
    {
        return view('payment.success');
    }

    /**
     * @return Renderable
     */
    public function failure(): Renderable
    {
        return view('payment.failure');
    }
}
