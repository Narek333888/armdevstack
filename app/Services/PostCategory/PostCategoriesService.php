<?php

namespace App\Services\PostCategory;

use App\Helpers\CacheHelper;
use App\Managers\ImageManager;
use App\Managers\Interfaces\IImageManager;
use App\Models\Post;
use App\Models\PostCategory;
use App\Repositories\PostCategory\Interfaces\IPostCategoriesRepository;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostCategoriesService
{
    private const string MODEL_CLASS = PostCategory::class;
    private const string IMAGE_PATH = 'public/postCategories/';
    private const string THUMBNAIL_IMAGE_PATH = 'public/postCategories/thumbnailImages/';

    private IPostCategoriesRepository $postCategoriesRepository;
    private IImageManager $imageManager;

    /**
     * @param IPostCategoriesRepository $postCategoriesRepository
     * @param ImageManager $imageManager
     */
    public function __construct(IPostCategoriesRepository $postCategoriesRepository, ImageManager $imageManager)
    {
        $this->postCategoriesRepository = $postCategoriesRepository;
        $this->imageManager = $imageManager;
    }

    /**
     * @return Collection
     */
    public function getAllPostCategories(): Collection
    {
        return $this->postCategoriesRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPostCategoriesPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->postCategoriesRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param Post $post
     * @return array
     */
    public function getAttachedPostCategories(Post $post): array
    {
        return $this->postCategoriesRepository->getAttached($post);
    }

    /**
     * @param int $id
     * @return Builder|PostCategory
     */
    public function getPostCategoryById(int $id): Builder|PostCategory
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->postCategoriesRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createPostCategory(array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var PostCategory $postCategory
         */
        $image = $data['image'];
        $imageOriginalName = $image->getClientOriginalName();
        $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
        $data['imageNewName'] = $imageNewName;
        $data['imageOriginalName'] = $imageOriginalName;
        $data['active'] = isset($data['active']) ? boolval($data['active']) : 0;

        $postCategory = $this->postCategoriesRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        if ($postCategory->id)
        {
            $path = self::IMAGE_PATH . $data['imageNewName'];
            $this->imageManager->storeImage($image, $path);

            $thumbnailPath = self::THUMBNAIL_IMAGE_PATH . $imageNewName;
            $this->imageManager->createThumbnail($image, $thumbnailPath, 300, 200);
        }
    }

    /**
     * @param int|PostCategory $postCategory
     * @param array $data
     * @return void
     */
    public function updatePostCategory(int|PostCategory $postCategory, array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var PostCategory $postCategory
         */
        $image = $data['image'] ?? null;

        if ($image)
        {
            $imageOriginalName = $image->getClientOriginalName();
            $oldImageName = $postCategory->image;
            $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
            $data['imageNewName'] = $imageNewName;
            $data['imageOriginalName'] = $imageOriginalName;

            if ($oldImageName)
            {
                Storage::delete(self::IMAGE_PATH . $oldImageName);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $oldImageName);
            }

            $path = self::IMAGE_PATH . $data['imageNewName'];
            $this->imageManager->storeImage($image, $path);

            $thumbnailPath = self::THUMBNAIL_IMAGE_PATH . $imageNewName;
            $this->imageManager->createThumbnail($image, $thumbnailPath, 300, 200);
        }

        CacheUtility::clearSingleItemCache($postCategory, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->update($postCategory, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function copyPostCategory(int $id): void
    {
        $this->postCategoriesRepository->copy($id);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|PostCategory $postCategory
     * @return void
     */
    public function deletePostCategory(int|PostCategory $postCategory): void
    {
        $image = $postCategory->image ?? null;

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->delete($postCategory);

        if ($image)
        {
            Storage::delete(self::IMAGE_PATH . $image);
            Storage::delete(self::THUMBNAIL_IMAGE_PATH . $image);
        }
    }

    /**
     * @param int|PostCategory $postCategory
     * @return void
     */
    public function softDeletePostCategory(int|PostCategory $postCategory): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->softDelete($postCategory);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deletePostCategoriesMultiple(array $data): void
    {
        $selectedPostsCategories = $this->postCategoriesRepository->getAllSelected($data);

        $this->postCategoriesRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        foreach ($selectedPostsCategories as $postsCategory)
        {
            if ($postsCategory->image)
            {
                Storage::delete(self::IMAGE_PATH . $postsCategory->image);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $postsCategory->image);
            }
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeletePostCategoriesMultiple(array $data): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->softDeleteMultiple($data);
    }

    /**
     * @return void
     */
    public function deleteAllPostCategories(): void
    {
        $allPostCategories = $this->postCategoriesRepository->getAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->deleteAll();

        foreach ($allPostCategories as $postCategory)
        {
            if ($postCategory->image)
            {
                Storage::delete(self::IMAGE_PATH . $postCategory->image);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $postCategory->image);
            }
        }
    }

    /**
     * @return void
     */
    public function softDeleteAllPostCategories(): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->postCategoriesRepository->softDeleteAll();
    }
}
