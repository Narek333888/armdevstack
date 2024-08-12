<?php

namespace App\Utilities;

use App\Helpers\CacheHelper;
use App\Helpers\StringHelper;

class CacheUtility
{
    /**
     * @param $model
     * @param string $modelClass
     * @return void
     */
    public static function clearSingleItemCache($model, string $modelClass): void
    {
        $cacheKeyForSingleItem = CacheHelper::getCacheKeyForSingleItem($modelClass, $model->id);

        CacheHelper::clearSingleItemCache($cacheKeyForSingleItem);
    }

    /**
     * @param string $modelClass
     * @return void
     */
    public static function clearPaginatedItemsCache(string $modelClass): void
    {
        $cacheKeyForPaginatedItems = CacheHelper::getCacheKeyForPaginatedItems($modelClass, request('page', 1));
        $modifiedCacheKeyForPaginatedItems = StringHelper::replaceLastItemAfterSymbol($cacheKeyForPaginatedItems, '', '_');

        CacheHelper::clearPaginatedItemsCache($modifiedCacheKeyForPaginatedItems, $modelClass);
    }
}
