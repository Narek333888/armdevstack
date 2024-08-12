<?php

namespace App\Http\Controllers;

use App\DAL\Services\PostCategory\PostCategoriesService;
use App\Helpers\SessionHelper;
use App\Http\Requests\PostCategory\PostCategoryDeleteMultipleRequest;
use App\Http\Requests\PostCategory\PostCategoryStoreRequest;
use App\Http\Requests\PostCategory\PostCategoryUpdateRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostCategoryController extends Controller
{
    private PostCategoriesService  $postCategoriesService;

    /**
     * @param PostCategoriesService $postCategoriesService
     */
    public function __construct(PostCategoriesService $postCategoriesService)
    {
        $this->postCategoriesService = $postCategoriesService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $postCategories = $this->postCategoriesService->getAllPostCategoriesPaginated();

        return view('dashboard.admin.post-category.index', compact('postCategories'));
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $postCategory = $this->postCategoriesService->getPostCategoryById($id);

        return view('dashboard.admin.post-category.show', compact('postCategory'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.admin.post-category.create');
    }

    /**
     * @param PostCategoryStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(PostCategoryStoreRequest $request): RedirectResponse
    {
        $data = $request->validated() + ['active' => $request->boolean('active')];

        $this->postCategoriesService->createPostCategory($data);

        return redirect()->route('post-category.index')->with(['success' => __('post-categories.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $postCategory = $this->postCategoriesService->getPostCategoryById($id);

        SessionHelper::setValue('post_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.post-category.edit', compact('postCategory'));
    }

    /**
     * @param PostCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(PostCategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $postCategory = $this->postCategoriesService->getPostCategoryById($id);

        $page = $request->input('page', SessionHelper::getValue('post_category_edit_page', 1));

        $this->postCategoriesService->updatePostCategory($postCategory, $request->validated());

        return redirect()->route('post-category.index', ['page' => intVal($page)])->with(['success' => __('post-categories.alert.updated_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function copy(int $id): RedirectResponse
    {
        $this->postCategoriesService->copyPostCategory($id);

        return redirect()->back()->with(['success' => __('post-categories.alert.copied_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $postCategory = $this->postCategoriesService->getPostCategoryById($id);

        $this->postCategoriesService->deletePostCategory($postCategory);

        return redirect()->back()->with(['success' => __('post-categories.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $postCategory = $this->postCategoriesService->getPostCategoryById($id);

        $this->postCategoriesService->softDeletePostCategory($postCategory);

        return redirect()->back()->with(['success' => __('post-categories.alert.soft_deleted_successfully')]);
    }

    /**
     * @param PostCategoryDeleteMultipleRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMultiple(PostCategoryDeleteMultipleRequest $request): JsonResponse
    {
        $this->postCategoriesService->deletePostCategoriesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('post-categories.alert.deleted_successfully')]);
    }

    /**
     * @param PostCategoryDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(PostCategoryDeleteMultipleRequest $request): JsonResponse
    {
        $this->postCategoriesService->softDeletePostCategoriesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('post-categories.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteAll(): JsonResponse
    {
        $this->postCategoriesService->deleteAllPostCategories();

        return response()->json(['status' => 'success', 'message' => __('post-categories.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->postCategoriesService->softDeleteAllPostCategories();

        return response()->json(['status' => 'success', 'message' => __('post-categories.alert.soft_deleted_successfully')]);
    }
}
