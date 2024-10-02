<?php

namespace App\Services\Permission;

use App\Helpers\CacheHelper;
use App\Models\Permission;
use App\Repositories\Permission\Interfaces\IPermissionsRepository;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PermissionsService
{
    private const string MODEL_CLASS = Permission::class;
    private IPermissionsRepository $permissionsRepository;

    /**
     * @param IPermissionsRepository $permissionsRepository
     */
    public function __construct(IPermissionsRepository $permissionsRepository)
    {
        $this->permissionsRepository = $permissionsRepository;
    }

    /**
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        return $this->permissionsRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPermissionsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->permissionsRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|Permission
     */
    public function getPermissionById(int $id): Builder|Permission
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->permissionsRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createPermission(array $data): void
    {
        $this->permissionsRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Permission $permission
     * @param array $data
     * @return void
     */
    public function updatePermission(int|Permission $permission, array $data): void
    {
        $this->permissionsRepository->update($permission, $data);

        CacheUtility::clearSingleItemCache($permission, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Permission $permission
     * @return void
     */
    public function deletePermission(int|Permission $permission): void
    {
        $this->permissionsRepository->delete($permission);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Permission $permission
     * @return void
     */
    public function softDeletePermission(int|Permission $permission): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->permissionsRepository->softDelete($permission);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deletePermissionsMultiple(array $data): void
    {
        $this->permissionsRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeletePermissionsMultiple(array $data): void
    {
        $this->permissionsRepository->softDeleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function deleteAllPermissions(): void
    {
        $this->permissionsRepository->deleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function softDeleteAllPermissions(): void
    {
        $this->permissionsRepository->softDeleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }
}
