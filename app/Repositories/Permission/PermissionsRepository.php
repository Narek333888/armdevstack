<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\Permission\Interfaces\IPermissionsRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Override;

class PermissionsRepository implements IPermissionsRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return Permission::query()->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Permission::query()->paginate($perPage);
    }

    /**
     * @return Permission[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return Permission::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return Permission::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Permission
     */
    #[Override]
    public function getById(int $id): Builder|Permission
    {
        return Permission::query()->find($id);
    }

    /**
     * @param array $data
     * @return Builder|Permission
     */
    #[Override]
    public function create(array $data): Builder|Permission
    {
        $permission = Permission::query()->create([
            'name' => $data['name'],
        ]);

        $permission->save();

        return $permission;
    }

    /**
     * @param int|Permission $permission
     * @param array $data
     * @return Builder|Permission
     */
    #[Override]
    public function update(int|Permission $permission, array $data): Builder|Permission
    {
        $permission->update([
            'name' => $data['name'],
        ]);

        return $permission;
    }

    /**
     * @param int|Permission $permission
     * @return int|Permission
     */
    #[Override]
    public function delete(int|Permission $permission): int|Permission
    {
        $permission->forceDelete();

        return $permission;
    }

    /**
     * @param int|Permission $permission
     * @return int|Permission
     */
    #[Override]
    public function softDelete(int|Permission $permission): int|Permission
    {
        $permission->delete();

        return $permission;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Permission::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Permission::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return Permission::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return Permission::moveToTrashAll();
    }
}
