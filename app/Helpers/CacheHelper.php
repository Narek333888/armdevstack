<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Cache;

class CacheHelper
{
    /**
     * @param string $key
     * @return void
     */
    public static function clearCache(string $key): void
    {
        Cache::delete($key);
    }

    /**
     * @param string $key
     * @return void
     */
    public static function clearSingleItemCache(string $key): void
    {
        Cache::delete($key);
    }

    /**
     * @param string $modelClass
     * @param int $currentPage
     * @return string
     */
    public static function getCacheKeyForPaginatedItems(string $modelClass, int $currentPage = 1): string
    {
        return strtolower(str_replace('\\', '_', $modelClass)) . '_page_' . $currentPage;
    }

    /**
     * @param string $modelClass
     * @param int $id
     * @return string
     */
    public static function getCacheKeyForSingleItem(string $modelClass, int $id): string
    {
        return strtolower(str_replace('\\', '_', $modelClass) . '_' . $id);
    }

    /**
     * @param string $key
     * @param string $modelClass
     * @param int $perPage
     * @return void
     */
    public static function clearPaginatedItemsCache(string $key, string $modelClass, int $perPage = 10): void
    {
        $pageCount = ceil($modelClass::query()->count() / $perPage);

        for ($i = 1; $i <= $pageCount; $i++)
        {
            Cache::delete($key . $i);
        }
    }
}
