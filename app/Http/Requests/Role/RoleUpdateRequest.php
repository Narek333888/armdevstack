<?php

namespace App\Http\Requests\Role;

use App\Helpers\InputHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => InputHelper::filter($this->input('name')),
        ]);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('roles.validation.name_required'),
        ];
    }
}
