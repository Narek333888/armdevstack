<?php

namespace App\DAL\Repositories\User;

use App\DAL\Repositories\User\Interfaces\IUsersRepository;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Override;

class UsersRepository implements IUsersRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return User::query()->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return User::query()->paginate($perPage);
    }

    /**
     * @return User[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return User::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return User::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|User
     */
    #[Override]
    public function getById(int $id): Builder|User
    {
        return User::query()->find($id);
    }

    /**
     * @param array $data
     * @return Builder|User
     */
    #[Override]
    public function create(array $data): Builder|User
    {
        $user = User::query()->create([
            'active_status' => $data['active'],
            'name' => [
                'hy' => $data['nameHy'],
                'en' => $data['nameEn'],
                'ru' => $data['nameRu'],
            ],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $user->save();

        return $user;
    }

    /**
     * @param int|User $user
     * @param array $data
     * @return Builder|User
     */
    #[Override]
    public function update(int|User $user, array $data): Builder|User
    {
        $active = isset($data['active']) ? 1 : 0;

        $data['active_status'] = $active;

        $user->update([
            'active_status' => $active,
            'name' => [
                'hy' => $data['nameHy'],
                'en' => $data['nameEn'],
                'ru' => $data['nameRu'],
            ],
            'email' => $data['email'],
        ]);

        return $user;
    }

    /**
     * @param int|User $user
     * @return int|User
     */
    #[Override]
    public function delete(int|User $user): int|User
    {
        $user->forceDelete();

        return $user;
    }

    /**
     * @param int|User $user
     * @return int|User
     */
    #[Override]
    public function softDelete(int|User $user): int|User
    {
        $user->delete();

        return $user;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return User::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return User::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return User::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return User::moveToTrashAll();
    }
}
