<?php

namespace App\Http\Controllers;

use App\DAL\Services\Post\PostsService;
use App\DAL\Services\PostCategory\PostCategoriesService;
use App\Helpers\SessionHelper;
use App\Http\Requests\Post\PostDeleteMultipleRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    private PostsService $postsService;
    private PostCategoriesService $postCategoriesService;

    /**
     * @param PostsService $postsService
     * @param PostCategoriesService $postCategoriesService
     */
    public function __construct(PostsService $postsService, PostCategoriesService $postCategoriesService)
    {
        $this->postsService = $postsService;
        $this->postCategoriesService = $postCategoriesService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $posts = $this->postsService->getAllPostsPaginated();

        return view('dashboard.admin.post.index', compact('posts'));
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $post = $this->postsService->getPostById($id);

        return view('dashboard.admin.post.show', compact('post'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        $postCategories = $this->postCategoriesService->getAllPostCategories();

        return view('dashboard.admin.post.create', [
            'postCategories' => $postCategories,
        ]);
    }

    /**
     * @param PostStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        $data = $request->validated() + ['active' => $request->boolean('active')];

        $this->postsService->createPost($data);

        return redirect()->route('post.index')->with(['success' => __('posts.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $post = $this->postsService->getPostById($id);
        $postCategories = $this->postCategoriesService->getAllPostCategories();
        $attachedPostCategories = $this->postCategoriesService->getAttachedPostCategories($post);

        SessionHelper::setValue('post_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.post.edit', [
            'post' => $post,
            'postCategories' => $postCategories,
            'attachedPostCategories' => $attachedPostCategories,
        ]);
    }

    /**
     * @param PostUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(PostUpdateRequest $request, int $id): RedirectResponse
    {
        $post = $this->postsService->getPostById($id);

        $page = $request->input('page', SessionHelper::getValue('post_edit_page', 1));

        $this->postsService->updatePost($post, $request->validated());

        return redirect()->route('post.index', ['id' => $post->id, 'page' => intVal($page)])->with(['success' => __('posts.alert.updated_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function copy(int $id): RedirectResponse
    {
        $this->postsService->copyPost($id);

        return redirect()->back()->with(['success' => __('posts.alert.copied_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $post = $this->postsService->getPostById($id);

        $this->postsService->deletePost($post);

        return redirect()->back()->with(['success' => __('posts.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $post = $this->postsService->getPostById($id);

        $this->postsService->softDeletePost($post);

        return redirect()->back()->with(['success' => __('posts.alert.soft_deleted_successfully')]);
    }

    /**
     * @param PostDeleteMultipleRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMultiple(PostDeleteMultipleRequest $request): JsonResponse
    {
        $this->postsService->deletePostsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('posts.alert.deleted_successfully')]);
    }

    /**
     * @param PostDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(PostDeleteMultipleRequest $request): JsonResponse
    {
        $this->postsService->softDeletePostsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('posts.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteAll(): JsonResponse
    {
        $this->postsService->deleteAllPosts();

        return response()->json(['status' => 'success', 'message' => __('posts.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->postsService->softDeleteAllPosts();

        return response()->json(['status' => 'success', 'message' => __('posts.alert.soft_deleted_successfully')]);
    }
}
