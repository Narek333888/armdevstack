<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\SessionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionDeleteMultipleRequest;
use App\Http\Requests\Permission\PermissionStoreRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Services\Permission\PermissionsService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    private PermissionsService $permissionsService;

    public function __construct(PermissionsService $permissionsService)
    {
        $this->permissionsService = $permissionsService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $permissions = $this->permissionsService->getAllPermissionsPaginated();

        return view('dashboard.admin.permission.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.admin.permission.create');
    }

    /**
     * @param PermissionStoreRequest $request
     * @return RedirectResponse
     */
    public function store(PermissionStoreRequest $request): RedirectResponse
    {
        $this->permissionsService->createPermission($request->validated());

        return to_route('permission.index')->with(['success' => __('permissions.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $permission = $this->permissionsService->getPermissionById($id);
        SessionHelper::setValue('permission_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.permission.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * @param PermissionUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(PermissionUpdateRequest $request, int $id): RedirectResponse
    {
        $permission = $this->permissionsService->getPermissionById($id);

        $page = $request->input('page', SessionHelper::getValue('permission_edit_page', 1));

        $this->permissionsService->updatePermission($permission, $request->validated());

        return to_route('permission.index', ['id' => $permission->id, 'page' => intVal($page)])->with(['success' => __('permissions.alert.updated_successfully')]);
    }


    public function delete(int $id): RedirectResponse
    {
        $permission = $this->permissionsService->getPermissionById($id);

        $this->permissionsService->deletePermission($permission);

        return redirect()->back()->with(['success' => __('permissions.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $permission = $this->permissionsService->getPermissionById($id);

        $this->permissionsService->softDeletePermission($permission);

        return redirect()->back()->with(['success' => __('permissions.alert.soft_deleted_successfully')]);
    }

    /**
     * @param PermissionDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function deleteMultiple(PermissionDeleteMultipleRequest $request): JsonResponse
    {
        $this->permissionsService->deletePermissionsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('permissions.alert.deleted_successfully')]);
    }

    /**
     * @param PermissionDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(PermissionDeleteMultipleRequest $request): JsonResponse
    {
        $this->permissionsService->softDeletePermissionsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('permissions.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function deleteAll(): JsonResponse
    {
        $this->permissionsService->deleteAllPermissions();

        return response()->json(['status' => 'success', 'message' => __('permissions.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->permissionsService->softDeleteAllPermissions();

        return response()->json(['status' => 'success', 'message' => __('permissions.alert.soft_deleted_successfully')]);
    }
}
