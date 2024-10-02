<?php

namespace App\Repositories\Trash;

use App\Models\Trash;
use App\Repositories\Trash\Interfaces\ITrashableRepository;
use Illuminate\Support\Facades\DB;

class TrashableRepository implements ITrashableRepository
{
    /**
     * @return int
     */
    public function getCountOfTrashed(): int
    {
        return Trash::query()->count();
    }

    /**
     * @param string $modelClass
     * @param int $modelId
     * @return void
     */
    public function moveToTrash(string $modelClass, int $modelId): void
    {
        Trash::query()
            ->create([
            'trashable_type' => $modelClass,
            'trashable_id' => $modelId,
            'deleted_at' => now(),
        ]);
    }

    /**
     * @param string $modelClass
     * @param int $modelId
     * @return void
     */
    public function restoreFromTrash(string $modelClass, int $modelId): void
    {
        Trash::query()
            ->where('trashable_type', $modelClass)
            ->where('trashable_id', $modelId)
            ->delete();
    }

    /**
     * @param string $modelClass
     * @param array $modelIds
     * @return bool
     */
    public function bulkMoveToTrash(string $modelClass, array $modelIds): bool
    {
        $models = $modelClass::query()
            ->whereIn('id', $modelIds)
            ->get();

        $result = DB::transaction(function () use ($models, $modelClass)
        {
            foreach ($models as $model)
            {
                $this->moveToTrash($modelClass, $model->id);
            }

            return $modelClass::query()
                ->whereIn('id', $models->pluck('id'))
                ->delete();
        });

        return $result > 0;
    }

    /**
     * @param string $modelClass
     * @return bool
     */
    public function moveToTrashAll(string $modelClass): bool
    {
        $models = $modelClass::all();

        $result = DB::transaction(function () use ($models, $modelClass)
        {
            foreach ($models as $model)
            {
                $this->moveToTrash($modelClass, $model->id);
            }

            return $modelClass::query()->delete();
        });

        return $result > 0;
    }
}
