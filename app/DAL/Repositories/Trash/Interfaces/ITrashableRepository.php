<?php

namespace App\DAL\Repositories\Trash\Interfaces;

interface ITrashableRepository
{
    public function getCountOfTrashed(): int;
    public function moveToTrash(string $modelClass, int $modelId);
    public function restoreFromTrash(string $modelClass, int $modelId);
    public function bulkMoveToTrash(string $modelClass, array $modelIds);
    public function moveToTrashAll(string $modelClass);
}
