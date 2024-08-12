<?php

namespace App\Http\Requests\Password;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordUpdateRequest extends FormRequest
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
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'password' => __('validation.required_password'),
            'current_password.required' => __('validation.required_password'),
            'current_password.current_password' => __('validation.password_field_confirmation_not_match'),
        ];
    }
}
