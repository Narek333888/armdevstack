<?php

namespace App\DAL\Services\User;

use App\DAL\Repositories\User\Interfaces\IUsersRepository;
use App\Helpers\CacheHelper;
use App\Models\User;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    private const string MODEL_CLASS = User::class;
    private IUsersRepository $usersRepository;

    /**
     * @param IUsersRepository $usersRepository
     */
    public function __construct(IUsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return $this->usersRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllUsersPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->usersRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|User
     */
    public function getUserById(int $id): Builder|User
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->usersRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createUser(array $data): void
    {
        $data['active'] = isset($data['active']) ? boolval($data['active']) : 0;
        $data['password'] = Hash::make($data['password']);

        $this->usersRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|User $user
     * @param array $data
     * @return void
     */
    public function updateUser(int|User $user, array $data): void
    {
        $this->usersRepository->update($user, $data);

        CacheUtility::clearSingleItemCache($user, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|User $user
     * @return void
     */
    public function deleteUser(int|User $user): void
    {
        $this->usersRepository->delete($user);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|User $user
     * @return void
     */
    public function softDeleteUser(int|User $user): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->usersRepository->softDelete($user);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deleteUsersMultiple(array $data): void
    {
        $this->usersRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeleteUsersMultiple(array $data): void
    {
        $this->usersRepository->softDeleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function deleteAllUsers(): void
    {
        $this->usersRepository->deleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @return void
     */
    public function softDeleteAllUsers(): void
    {
        $this->usersRepository->softDeleteAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }
}
