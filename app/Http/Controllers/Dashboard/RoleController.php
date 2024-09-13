<?php

namespace App\Http\Controllers\Dashboard;

use App\DAL\Services\Permission\PermissionsService;
use App\DAL\Services\Role\RolesService;
use App\Helpers\SessionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleDeleteMultipleRequest;
use App\Http\Requests\Role\RoleGivePermissionRequest;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Override;

class RoleController extends Controller
{
    private RolesService $rolesService;
    private PermissionsService $permissionsService;

    public function __construct(RolesService $rolesService, PermissionsService $permissionsService)
    {
        $this->rolesService = $rolesService;
        $this->permissionsService = $permissionsService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $roles = $this->rolesService->getAllRolesPaginated();

        return view('dashboard.admin.role.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.admin.role.create');
    }

    /**
     * @param RoleStoreRequest $request
     * @return RedirectResponse
     */
    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->rolesService->createRole($request->validated());

        return to_route('role.index')->with(['success' => __('roles.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $role = $this->rolesService->getRoleById($id);
        SessionHelper::setValue('role_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.role.edit', [
            'role' => $role,
        ]);
    }

    /**
     * @param RoleUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoleUpdateRequest $request, int $id): RedirectResponse
    {
        $role = $this->rolesService->getRoleById($id);

        $page = $request->input('page', SessionHelper::getValue('role_edit_page', 1));

        $this->rolesService->updateRole($role, $request->validated());

        return to_route('role.index', ['id' => $role->id, 'page' => intVal($page)])->with(['success' => __('roles.alert.updated_successfully')]);
    }


    public function delete(int $id): RedirectResponse
    {
        $role = $this->rolesService->getRoleById($id);

        $this->rolesService->deleteRole($role);

        return redirect()->back()->with(['success' => __('roles.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $role = $this->rolesService->getRoleById($id);

        $this->rolesService->softDeleteRole($role);

        return redirect()->back()->with(['success' => __('roles.alert.soft_deleted_successfully')]);
    }

    /**
     * @param RoleDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function deleteMultiple(RoleDeleteMultipleRequest $request): JsonResponse
    {
        $this->rolesService->deleteRolesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('roles.alert.deleted_successfully')]);
    }

    /**
     * @param RoleDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(RoleDeleteMultipleRequest $request): JsonResponse
    {
        $this->rolesService->softDeleteRolesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('roles.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function deleteAll(): JsonResponse
    {
        $this->rolesService->deleteAllRoles();

        return response()->json(['status' => 'success', 'message' => __('roles.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->rolesService->softDeleteAllRoles();

        return response()->json(['status' => 'success', 'message' => __('roles.alert.soft_deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function addPermissionToRole(int $id): Renderable
    {
        $role = $this->rolesService->getRoleById($id);
        $permissions = $this->permissionsService->getAllPermissions();
        $rolePermissions = $this->rolesService->getRolePermissions($role);

        return view('dashboard.admin.role.add-permission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * @param RoleGivePermissionRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function givePermissionToRole(RoleGivePermissionRequest $request, int $id): RedirectResponse
    {
        $role = $this->rolesService->getRoleById($id);
        $this->rolesService->syncPermissionsToRole($role, $request->validated());

        return redirect()->back()->with(['success' => __('roles.alert.permissions_added_to_role_successfully')]);
    }
}
