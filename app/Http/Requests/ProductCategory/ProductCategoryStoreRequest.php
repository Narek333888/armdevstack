<?php

namespace App\Http\Requests\ProductCategory;

use App\Helpers\InputHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $nameHy
 * @property mixed $nameEn
 * @property mixed $nameRu
 * @property mixed $descriptionHy
 * @property mixed $descriptionEn
 * @property mixed $descriptionRu
 */
class ProductCategoryStoreRequest extends FormRequest
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
            'nameHy' => ['required', 'string'],
            'nameEn' => ['required', 'string'],
            'nameRu' => ['required', 'string'],
            'image'   => ['required', 'image', 'max:2048'],

            'descriptionHy' => ['required', 'string'],
            'descriptionEn' => ['required', 'string'],
            'descriptionRu' => ['required', 'string'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nameHy' => InputHelper::filter($this->nameHy),
            'nameEn' => InputHelper::filter($this->nameEn),
            'nameRu' => InputHelper::filter($this->nameRu),

            'descriptionHy' => InputHelper::filter($this->descriptionHy),
            'descriptionEn' => InputHelper::filter($this->descriptionEn),
            'descriptionRu' => InputHelper::filter($this->descriptionRu),
        ]);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'image.required' => __('product-categories.validation.image_required'),
            'image.image'    => __('product-categories.validation.image_image'),

            'nameHy.required' => __('product-categories.validation.name_hy_required'),
            'nameEn.required' => __('product-categories.validation.name_en_required'),
            'nameRu.required' => __('product-categories.validation.name_ru_required'),

            'descriptionHy.required' => __('product-categories.validation.description_hy_required'),
            'descriptionEn.required' => __('product-categories.validation.description_en_required'),
            'descriptionRu.required' => __('product-categories.validation.description_ru_required'),
        ];
    }
}
