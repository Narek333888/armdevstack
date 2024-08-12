<?php

namespace App\Http\Requests\Post;

use App\Helpers\InputHelper;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $titleHy
 * @property mixed $titleEn
 * @property mixed $titleRu
 * @property mixed $descriptionHy
 * @property mixed $descriptionEn
 * @property mixed $descriptionRu
 * @property mixed $shortDescriptionHy
 * @property mixed $shortDescriptionEn
 * @property mixed $shortDescriptionRu
 */
class PostUpdateRequest extends FormRequest
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
            'titleHy' => ['required', 'string'],
            'titleEn' => ['required', 'string'],
            'titleRu' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'max:2048'],
            'active'  => ['nullable'],

            'categoryIds' => ['required', 'array'],

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
            'titleHy' => InputHelper::filter($this->titleHy),
            'titleEn' => InputHelper::filter($this->titleEn),
            'titleRu' => InputHelper::filter($this->titleRu),

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
            'image.required' => __('posts.validation.image_required'),
            'image.image'    => __('posts.validation.image_image'),

            'active.integer' => __('posts.validation.active_required'),

            'categoryIds.required' => __('posts.validation.post_categories_required'),

            'titleHy.required' => __('posts.validation.title_hy_required'),
            'titleEn.required' => __('posts.validation.title_en_required'),
            'titleRu.required' => __('posts.validation.title_ru_required'),

            'shortDescriptionHy.required' => __('posts.validation.short_description_hy_required'),
            'shortDescriptionEn.required' => __('posts.validation.short_description_en_required'),
            'shortDescriptionRu.required' => __('posts.validation.short_description_ru_required'),

            'descriptionHy.required' => __('posts.validation.description_hy_required'),
            'descriptionEn.required' => __('posts.validation.description_en_required'),
            'descriptionRu.required' => __('posts.validation.description_ru_required'),
        ];
    }
}
