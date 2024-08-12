<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use ReflectionClass;
use ReflectionException;

class ModelHelper
{
    /**
     * @param string $path
     * @return array
     */
    public static function getAllModels(string $path): array
    {
        $models = [];

        foreach (File::allFiles($path) as $key => $file)
        {
            $namespace = 'App\\Models\\';

            $path = $file->getRelativePathname();

            $class = str_replace('/', '\\', substr($path, 0, strrpos($path, '.')));

            $models[] = $namespace . $class;
        }

        return $models;
    }

    /**
     * @param array $models
     * @return array
     * @throws ReflectionException
     */
    public static function getModelsUsingSoftDeletes(array $models): array
    {
        $softDeletingModels = [];

        foreach ($models as $key => $model)
        {
            $reflection = new ReflectionClass($model);

            if (in_array(SoftDeletes::class, array_keys($reflection->getTraits())))
            {
                $softDeletingModels[] = $model;
            }
        }

        return $softDeletingModels;
    }
}
