<?php

namespace App\Services\SoftDeletion;

use App\Helpers\ClassValidationHelper;
use App\Repositories\SoftDeletion\Interfaces\ISoftDeletionRepository;
use App\Utilities\CacheUtility;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class SoftDeletionService
{
    private ISoftDeletionRepository $softDeletionRepository;

    /**
     * @param ISoftDeletionRepository $softDeletionRepository
     */
    public function __construct(ISoftDeletionRepository $softDeletionRepository)
    {
        $this->softDeletionRepository = $softDeletionRepository;
    }

    /**
     * @param string $modelClass
     * @return array|Collection|Builder
     */
    public function getSoftDeletedItems(string $modelClass): array|Collection|Builder
    {
        ClassValidationHelper::validateSoftDeletesModel($modelClass);

        return $this->softDeletionRepository->getSoftDeleted($modelClass);
    }

    /**
     * @param string $modelClass
     * @param int $perPage
     * @return array|Collection|Builder
     */
    public function getSoftDeletedItemsPaginated(string $modelClass, int $perPage = 10): array|Collection|Builder
    {
        ClassValidationHelper::validateSoftDeletesModel($modelClass);

        return $this->softDeletionRepository->getSoftDeletedPaginated($modelClass, $perPage);
    }

    /**
     * @param string $modelClass
     * @param int $id
     * @return void
     */
    public function restoreSingleSoftDeletedItem(string $modelClass, int $id): void
    {
        $softDeletedItem = $this->softDeletionRepository->getSingleSoftDeleted($modelClass, $id);

        CacheUtility::clearSingleItemCache($softDeletedItem, $modelClass);
        CacheUtility::clearPaginatedItemsCache($modelClass);

        $this->softDeletionRepository->restoreSoftDeleted($modelClass, $id);
    }

    /**
     * @param string $modelClass
     * @return void
     */
    public function restoreAllSoftDeletedItems(string $modelClass): void
    {
        $this->softDeletionRepository->restoreAllSoftDeleted($modelClass);
    }

    /**
     * @param string $modelClass
     * @param int $id
     * @return void
     */
    public function permanentlyDeleteSingleSoftDeletedItem(string $modelClass, int $id): void
    {
        $softDeletedItem = $this->softDeletionRepository->getSingleSoftDeleted($modelClass, $id);

        CacheUtility::clearSingleItemCache($softDeletedItem, $modelClass);
        CacheUtility::clearPaginatedItemsCache($modelClass);

        $this->softDeletionRepository->permanentlyDeleteSoftDeleted($modelClass, $id);
    }

    /**
     * @param string $modelClass
     * @return void
     */
    public function permanentlyDeleteAllSoftDeletedItems(string $modelClass): void
    {
        $this->softDeletionRepository->permanentlyDeleteAllSoftDeleted($modelClass);
    }
}
