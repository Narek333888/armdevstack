<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;


class ClassValidationHelper
{
    /**
     * @param string $modelClass
     * @return void
     * @throws InvalidArgumentException
     */
    public static function validateSoftDeletesModel(string $modelClass): void
    {
        if (!class_exists($modelClass) || !in_array(SoftDeletes::class, class_uses($modelClass)))
        {
            throw new InvalidArgumentException(__('general.invalid_model_or_model_does_not_use_soft_deletes_trait'));
        }
    }
}
