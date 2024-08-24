<?php

namespace App\Http\Requests\WeatherForecast;

use App\Helpers\InputHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $city
 * @property mixed $unitOfMeasurement
 */
class WeatherApiRequest extends FormRequest
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
            'city' => ['required'],
            'unitOfMeasurement' => ['nullable', 'string'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'city' => InputHelper::filter($this->city),
            'unitOfMeasurement' => InputHelper::filter($this->unitOfMeasurement),
        ]);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'city.required' => __('weather.validation.city_required'),
        ];
    }
}
