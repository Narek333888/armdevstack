<?php

namespace App\DAL\Repositories\SoftDeletion;

use App\DAL\Repositories\SoftDeletion\Interfaces\ISoftDeletionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Override;

class SoftDeletionRepository implements ISoftDeletionRepository
{
    /**
     * @param string $modelClass
     * @param int $id
     * @return mixed
     */
    #[Override]
    public function getSingleSoftDeleted(string $modelClass, int $id): mixed
    {
        return $modelClass::query()->onlyTrashed()->find($id);
    }

    /**
     * @param string $modelClass
     * @return array|Collection|Builder
     */
    #[Override]
    public function getSoftDeleted(string $modelClass): array|Collection|Builder
    {
        return $modelClass::query()->onlyTrashed()->get();
    }

    /**
     * @param string $modelClass
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getSoftDeletedPaginated(string $modelClass, int $perPage = 10): LengthAwarePaginator
    {
        return $modelClass::query()->onlyTrashed()->paginate($perPage);
    }

    /**
     * @param string $modelClass
     * @param int $id
     * @return void
     */
    #[Override]
    public function restoreSoftDeleted(string $modelClass, int $id): void
    {
        $model = $modelClass::query()->onlyTrashed()->findOrFail($id);

        $model->restore();
    }

    /**
     * @param string $modelClass
     * @return void
     */
    #[Override]
    public function restoreAllSoftDeleted(string $modelClass): void
    {
        $modelClass::query()->onlyTrashed()->restore();
    }

    /**
     * @param string $modelClass
     * @param int $id
     * @return void
     */
    #[Override]
    public function permanentlyDeleteSoftDeleted(string $modelClass, int $id): void
    {
        $model = $modelClass::query()->with('trash')->onlyTrashed()->findOrFail($id);

        $model->trash->delete();
        $model->forceDelete();
    }

    /**
     * @param string $modelClass
     * @return void
     */
    #[Override]
    public function permanentlyDeleteAllSoftDeleted(string $modelClass): void
    {
        $model = $modelClass::query()->onlyTrashed();

        $model->forceDelete();
    }
}
