<?php

namespace App\DAL\Services\Post;

use App\DAL\Repositories\Post\Interfaces\IPostsRepository;
use App\Helpers\CacheHelper;
use App\Models\Post;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsService
{
    private const string MODEL_CLASS = Post::class;
    private IPostsRepository $postsRepository;

    /**
     * @param IPostsRepository $postsRepository
     */
    public function __construct(IPostsRepository $postsRepository)
    {
        $this->postsRepository = $postsRepository;
    }

    /**
     * @return Collection
     */
    public function getAllPosts(): Collection
    {
        return $this->postsRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPostsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->postsRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|Post
     */
    public function getPostById(int $id): Builder|Post
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->postsRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createPost(array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var Post $post
         */
        $image = $data['image'];
        $imageOriginalName = $image->getClientOriginalName();
        $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
        $data['imageNewName'] = $imageNewName;
        $data['imageOriginalName'] = $imageOriginalName;
        $data['active'] = boolval($data['active']);

        $post = $this->postsRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        if ($post->id)
        {
            $path = 'public/posts/' . $data['imageNewName'];
            $image->storeAs($path);

            if (isset($data['categoryIds']))
                $this->postsRepository->attachCategories($post, $data['categoryIds']);
        }
    }

    /**
     * @param int|Post $post
     * @param array $data
     * @return void
     */
    public function updatePost(int|Post $post, array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var Post $post
         */
        $image = $data['image'] ?? null;

        if ($image)
        {
            $imageOriginalName = $image->getClientOriginalName();
            $oldImageName = $post->image;
            $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
            $data['imageNewName'] = $imageNewName;
            $data['imageOriginalName'] = $imageOriginalName;

            if ($oldImageName)
                Storage::delete('public/posts/' . $oldImageName);

            $path = 'public/posts/' . $data['imageNewName'];
            $image->storeAs($path);
        }

        if (isset($data['categoryIds']))
            $this->postsRepository->syncCategories($post, $data['categoryIds']);

        CacheUtility::clearSingleItemCache($post, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->update($post, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function copyPost(int $id): void
    {
        $post = $this->postsRepository->getById($id);
        $this->postsRepository->copy($id);

        CacheUtility::clearSingleItemCache($post, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Post $post
     * @return void
     */
    public function deletePost(int|Post $post): void
    {
        $image = $post->image ?? null;

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->delete($post);

        if ($image)
            Storage::delete('public/posts/' . $image);
    }

    /**
     * @param int|Post $post
     * @return void
     */
    public function softDeletePost(int|Post $post): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->softDelete($post);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deletePostsMultiple(array $data): void
    {
        $selectedPosts = $this->postsRepository->getAllSelected($data);

        $this->postsRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        foreach ($selectedPosts as $post)
        {
            if ($post->image)
                Storage::delete('public/posts/' . $post->image);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeletePostsMultiple(array $data): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->softDeleteMultiple($data);
    }

    /**
     * @return void
     */
    public function deleteAllPosts(): void
    {
        $allPosts = $this->postsRepository->getAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->deleteAll();

        foreach ($allPosts as $post)
        {
            if ($post->image)
                Storage::delete('public/posts/' . $post->image);
        }
    }

    /**
     * @return void
     */
    public function softDeleteAllPosts(): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postsRepository->softDeleteAll();
    }
}
