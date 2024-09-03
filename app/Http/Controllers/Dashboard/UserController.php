<?php

namespace App\Http\Controllers\Dashboard;

use App\DAL\Services\User\UsersService;
use App\Helpers\SessionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserDeleteMultipleRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private UsersService $usersService;

    /**
     * @param UsersService $usersService
     */
    public function __construct(UsersService $usersService)
    {
        $this->usersService = $usersService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $users = $this->usersService->getAllUsersPaginated();

        return view('dashboard.admin.user.index', compact('users'));
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $user = $this->usersService->getUserById($id);

        return view('dashboard.admin.user.show', compact('user'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.admin.user.create');
    }

    /**
     * @param UserStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->usersService->createUser($data);

        return redirect()->route('user.index')->with(['success' => __('users.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $user = $this->usersService->getUserById($id);

        SessionHelper::setValue('user_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $id): RedirectResponse
    {
        $user = $this->usersService->getUserById($id);

        $page = $request->input('page', SessionHelper::getValue('user_edit_page', 1));

        $this->usersService->updateUser($user, $request->validated());

        return redirect()->route('user.index', ['id' => $user->id, 'page' => intVal($page)])->with(['success' => __('users.alert.updated_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $user = $this->usersService->getUserById($id);

        $this->usersService->deleteUser($user);

        return redirect()->back()->with(['success' => __('users.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $user = $this->usersService->getUserById($id);

        $this->usersService->softDeleteUser($user);

        return redirect()->back()->with(['success' => __('users.alert.soft_deleted_successfully')]);
    }

    /**
     * @param UserDeleteMultipleRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMultiple(UserDeleteMultipleRequest $request): JsonResponse
    {
        $this->usersService->deleteUsersMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('users.alert.deleted_successfully')]);
    }

    /**
     * @param UserDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(UserDeleteMultipleRequest $request): JsonResponse
    {
        $this->usersService->softDeleteUsersMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('users.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteAll(): JsonResponse
    {
        $this->usersService->deleteAllUsers();

        return response()->json(['status' => 'success', 'message' => __('users.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->usersService->softDeleteAllUsers();

        return response()->json(['status' => 'success', 'message' => __('users.alert.soft_deleted_successfully')]);
    }
}
