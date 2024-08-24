<?php

namespace App\Http\Requests\Product;

use App\Helpers\InputHelper;
use App\Rules\Decimal;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $nameHy
 * @property mixed $nameEn
 * @property mixed $nameRu
 * @property mixed $descriptionHy
 * @property mixed $descriptionEn
 * @property mixed $descriptionRu
 * @property mixed $shortDescriptionHy
 * @property mixed $shortDescriptionEn
 * @property mixed $shortDescriptionRu
 */
class ProductStoreRequest extends FormRequest
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
            'active'  => ['nullable'],
            'showInHome'  => ['nullable'],
            'price' => ['required', new Decimal],

            'categoryId' => ['required', 'integer'],

            'shortDescriptionHy' => ['required', 'string'],
            'shortDescriptionEn' => ['required', 'string'],
            'shortDescriptionRu' => ['required', 'string'],

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

            'shortDescriptionHy' => InputHelper::filter($this->shortDescriptionHy),
            'shortDescriptionEn' => InputHelper::filter($this->shortDescriptionEn),
            'shortDescriptionRu' => InputHelper::filter($this->shortDescriptionRu),

            /*'descriptionHy' => Input::filter($this->descriptionHy),
            'descriptionEn' => Input::filter($this->descriptionEn),
            'descriptionRu' => Input::filter($this->descriptionRu),*/
        ]);
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'image.required' => __('products.validation.image_required'),
            'image.image'    => __('products.validation.image_image'),

            'categoryId.required' => __('products.validation.product_category_required'),

            'nameHy.required' => __('products.validation.name_hy_required'),
            'nameEn.required' => __('products.validation.name_en_required'),
            'nameRu.required' => __('products.validation.name_ru_required'),

            'shortDescriptionHy.required' => __('products.validation.short_description_hy_required'),
            'shortDescriptionEn.required' => __('products.validation.short_description_en_required'),
            'shortDescriptionRu.required' => __('products.validation.short_description_ru_required'),

            'descriptionHy.required' => __('products.validation.description_hy_required'),
            'descriptionEn.required' => __('products.validation.description_en_required'),
            'descriptionRu.required' => __('products.validation.description_ru_required'),
        ];
    }
}
