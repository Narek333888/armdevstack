<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Repositories\Role\Interfaces\IRolesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Override;

class RolesRepository implements IRolesRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return Role::query()->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Role::query()->paginate($perPage);
    }

    /**
     * @return Role[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return Role::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return Role::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Role
     */
    #[Override]
    public function getById(int $id): Builder|Role
    {
        return Role::query()->find($id);
    }

    /**
     * @param array $data
     * @return Builder|Role
     */
    #[Override]
    public function create(array $data): Builder|Role
    {
        $role = Role::query()->create([
            'name' => $data['name'],
        ]);

        $role->save();

        return $role;
    }

    /**
     * @param int|Role $role
     * @param array $data
     * @return Builder|Role
     */
    #[Override]
    public function update(int|Role $role, array $data): Builder|Role
    {
        $role->update([
            'name' => $data['name'],
        ]);

        return $role;
    }

    /**
     * @param int|Role $role
     * @return int|Role
     */
    #[Override]
    public function delete(int|Role $role): int|Role
    {
        $role->forceDelete();

        return $role;
    }

    /**
     * @param int|Role $role
     * @return int|Role
     */
    #[Override]
    public function softDelete(int|Role $role): int|Role
    {
        $role->delete();

        return $role;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Role::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Role::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return Role::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return Role::moveToTrashAll();
    }

    /**
     * @param int|Role $role
     * @return array|Collection
     */
    #[Override]
    public function getPermissions(int|Role $role): array|Collection
    {
        return RoleHasPermission::query()
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->all();
    }

    /**
     * @param int|Role $role
     * @param array $permissions
     * @return void
     */
    #[Override]
    public function syncPermissions(int|Role $role, array $permissions): void
    {
        $role->syncPermissions($permissions);
    }
}
