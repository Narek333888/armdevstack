<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'active' => ['nullable'],
            'nameHy' => ['required', 'string', 'max:255'],
            'nameEn' => ['required', 'string', 'max:255'],
            'nameRu' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['nullable', 'string'],
            'roleIds' => ['required'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'roleIds.required' => 'The roles field is required',
        ];
    }
}
