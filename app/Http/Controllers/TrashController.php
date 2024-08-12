<?php

namespace App\Http\Controllers;

use App\DAL\Services\SoftDeletion\SoftDeletionService;
use App\DAL\Services\Trash\TrashableService;
use App\Helpers\ModelHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use ReflectionException;

class TrashController extends Controller
{
    private SoftDeletionService $softDeletionService;
    private TrashableService $trashableService;

    public function __construct(SoftDeletionService $softDeletionService, TrashableService  $trashableService)
    {
        $this->softDeletionService = $softDeletionService;
        $this->trashableService = $trashableService;
    }

    /**
     * @return Renderable
     * @throws ReflectionException
     */
    public function index(): Renderable
    {
        $models = [];

        $allModels = ModelHelper::getAllModels(app_path('Models'));
        $softDeletingModels = ModelHelper::getModelsUsingSoftDeletes($allModels);

        foreach ($softDeletingModels as $key => $model)
        {
            $models[$model] = $this->softDeletionService->getSoftDeletedItems($model);
        }

        $countOfTrashedItems = $this->trashableService->getCountOfTrashedItems();

        return view('dashboard.admin.trash.index', [
            'models' => $models,
            'countOfTrashedItems' => $countOfTrashedItems,
        ]);
    }

    /**
     * @param string $model
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(string $model, int $id): RedirectResponse
    {
        $this->softDeletionService->restoreSingleSoftDeletedItem($model, $id);

        return redirect()->back()->with(['success' => __('general.restored_successfully')]);
    }

    /**
     * @param string $model
     * @return RedirectResponse
     */
    public function restoreAll(string $model): RedirectResponse
    {
        $this->softDeletionService->restoreAllSoftDeletedItems($model);

        return redirect()->back()->with(['success' => __('general.restored_successfully')]);
    }

    /**
     * @param string $model
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(string $model, int $id): RedirectResponse
    {
        $this->softDeletionService->permanentlyDeleteSingleSoftDeletedItem($model, $id);

        return redirect()->back()->with(['success' => __('general.deleted_successfully')]);
    }

    /**
     * @param string $model
     * @return RedirectResponse
     */
    public function deleteAll(string $model): RedirectResponse
    {
        $this->softDeletionService->permanentlyDeleteAllSoftDeletedItems($model);

        return redirect()->back()->with(['success' => __('general.deleted_successfully')]);
    }
}
