<?php

namespace App\Traits;

use App\Models\Trash;
use App\Services\Trash\TrashableService;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Trashable
{
    /**
     * @return void
     */
    public static function bootTrashable(): void
    {
        static::deleting(function ($model)
        {
            if (!$model->isForceDeleting())
                app(TrashableService::class)->moveItemToTrash($model::class, $model->id);
        });

        static::restoring(function ($model)
        {
            app(TrashableService::class)->restoreItemFromTrash($model::class, $model->id);
        });
    }

    /**
     * @return MorphOne
     */
    public function trash(): MorphOne
    {
        return $this->morphOne(Trash::class, 'trashable');
    }

    /**
     * @param array $ids
     * @return bool|null
     */
    public static function bulkMoveToTrash(array $ids): ?bool
    {
        return app(TrashableService::class)->bulkMoveItemsToTrash(static::class, $ids);
    }

    /**
     * @return bool|null
     */
    public static function moveToTrashAll(): ?bool
    {
        return app(TrashableService::class)->moveToTrashAllItems(static::class);
    }
}
