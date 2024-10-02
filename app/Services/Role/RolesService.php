<?php

namespace App\Services\Role;

use App\Helpers\CacheHelper;
use App\Models\Role;
use App\Repositories\Role\Interfaces\IRolesRepository;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class RolesService
{
    private const string MODEL_CLASS = Role::class;
    private IRolesRepository $rolesRepository;

    /**
     * @param IRolesRepository $rolesRepository
     */
    public function __construct(IRolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    /**
     * @return Collection
     */
    public function getAllRoles(): Collection
    {
        return $this->rolesRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllRolesPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->rolesRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|Role
     */
    public function getRoleById(int $id): Builder|Role
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->rolesRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createRole(array $data): void
    {
        $this->rolesRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Role $role
     * @param array $data
     * @return void
     */
    public function updateRole(int|Role $role, array $data): void
    {
        $this->rolesRepository->update($role, $data);

        CacheUtility::clearSingleItemCache($role, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Role $role
     * @return void
     */
    public function deleteRole(int|Role $role): void
    {
        $this->rolesRepository->delete($role);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Role $role
     * @return void
     */
    public function softDeleteRole(int|Role $role): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->rolesRepository->softDelete($role);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deleteRolesMultiple(array $data): void
    {
        $this->rolesRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeleteRolesMultiple(array $data): void
    {
        $this->rolesRepository->softDeleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function deleteAllRoles(): void
    {
        $this->rolesRepository->deleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function softDeleteAllRoles(): void
    {
        $this->rolesRepository->softDeleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param Role $role
     * @return Collection|array
     */
    public function getRolePermissions(Role $role): Collection|array
    {
        return $this->rolesRepository->getPermissions($role);
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @return void
     */
    public function syncPermissionsToRole(Role $role, array $permissions): void
    {
        $this->rolesRepository->syncPermissions($role, $permissions);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }
}
