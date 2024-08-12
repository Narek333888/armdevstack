<?php

namespace App\DAL\Services\Trash;

use App\DAL\Repositories\Trash\Interfaces\ITrashableRepository;

class TrashableService
{
    private ITrashableRepository $trashableRepository;

    /**
     * @param ITrashableRepository $trashableRepository
     */
    public function __construct(ITrashableRepository $trashableRepository)
    {
        $this->trashableRepository = $trashableRepository;
    }

    /**
     * @return int
     */
    public function getCountOfTrashedItems(): int
    {
        return $this->trashableRepository->getCountOfTrashed();
    }

    /**
     * @param string $modelClass
     * @param int $modelId
     * @return void
     */
    public function moveItemToTrash(string $modelClass, int $modelId): void
    {
        $this->trashableRepository->moveToTrash($modelClass, $modelId);
    }

    /**
     * @param string $modelClass
     * @param int $modelId
     * @return void
     */
    public function restoreItemFromTrash(string $modelClass, int $modelId): void
    {
        $this->trashableRepository->restoreFromTrash($modelClass, $modelId);
    }

    /**
     * @param string $modelClass
     * @param array $modelIds
     * @return bool
     */
    public function bulkMoveItemsToTrash(string $modelClass, array $modelIds): bool
    {
        return $this->trashableRepository->bulkMoveToTrash($modelClass, $modelIds);
    }

    /**
     * @param string $modelClass
     * @return bool
     */
    public function moveToTrashAllItems(string $modelClass): bool
    {
        return $this->trashableRepository->moveToTrashAll($modelClass);
    }
}
