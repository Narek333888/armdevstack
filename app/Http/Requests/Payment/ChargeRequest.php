<?php

namespace App\Http\Requests\Payment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'paymentMethod' => ['required', 'in:stripe,paypal'],
            'cardHolderName' => ['required', 'string'],
            'stripePaymentMethodId' => ['required_if:paymentMethod,stripe', 'string'],
        ];
    }
}
