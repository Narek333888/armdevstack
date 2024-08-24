<?php

namespace App\DAL\Services\ProductCategory;

use App\DAL\Repositories\ProductCategory\Interfaces\IProductCategoriesRepository;
use App\Helpers\CacheHelper;
use App\Models\ProductCategory;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductCategoriesService
{
    private const string MODEL_CLASS = ProductCategory::class;

    private IProductCategoriesRepository $productCategoriesRepository;

    /**
     * @param IProductCategoriesRepository $productCategoriesRepository
     */
    public function __construct(IProductCategoriesRepository $productCategoriesRepository)
    {
        $this->productCategoriesRepository = $productCategoriesRepository;
    }

    /**
     * @return Collection
     */
    public function getAllProductCategories(): Collection
    {
        return $this->productCategoriesRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllProductCategoriesPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->productCategoriesRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|ProductCategory
     */
    public function getProductCategoryById(int $id): Builder|ProductCategory
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->productCategoriesRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createProductCategory(array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var ProductCategory $productCategory
         */
        $image = $data['image'];
        $imageOriginalName = $image->getClientOriginalName();
        $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
        $data['imageNewName'] = $imageNewName;
        $data['imageOriginalName'] = $imageOriginalName;
        $data['active'] = boolval($data['active']);

        $productCategory = $this->productCategoriesRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        if ($productCategory->id)
        {
            $path = 'public/productCategories/' . $data['imageNewName'];
            $image->storeAs($path);
        }
    }

    /**
     * @param int|ProductCategory $productCategory
     * @param array $data
     * @return void
     */
    public function updateProductCategory(int|ProductCategory $productCategory, array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var ProductCategory $productCategory
         */
        $image = $data['image'] ?? null;

        if ($image)
        {
            $imageOriginalName = $image->getClientOriginalName();
            $oldImageName = $productCategory->image;
            $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
            $data['imageNewName'] = $imageNewName;
            $data['imageOriginalName'] = $imageOriginalName;

            if ($oldImageName)
                Storage::delete('public/productCategories/' . $oldImageName);

            $path = 'public/productCategories/' . $data['imageNewName'];
            $image->storeAs($path);
        }

        CacheUtility::clearSingleItemCache($productCategory, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->update($productCategory, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function copyProductCategory(int $id): void
    {
        $this->productCategoriesRepository->copy($id);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|ProductCategory $productCategory
     * @return void
     */
    public function deleteProductCategory(int|ProductCategory $productCategory): void
    {
        $image = $productCategory->image ?? null;

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->delete($productCategory);

        if ($image)
            Storage::delete('public/productCategories/' . $image);
    }

    /**
     * @param int|ProductCategory $productCategory
     * @return void
     */
    public function softDeleteProductCategory(int|ProductCategory $productCategory): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->softDelete($productCategory);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deleteProductCategoriesMultiple(array $data): void
    {
        $selectedProductCategories = $this->productCategoriesRepository->getAllSelected($data);

        $this->productCategoriesRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        foreach ($selectedProductCategories as $productCategory)
        {
            if ($productCategory->image)
                Storage::delete('public/productCategories/' . $productCategory->image);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeleteProductCategoriesMultiple(array $data): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->softDeleteMultiple($data);
    }

    /**
     * @return void
     */
    public function deleteAllProductCategories(): void
    {
        $allProductCategories = $this->productCategoriesRepository->getAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->deleteAll();

        foreach ($allProductCategories as $productCategory)
        {
            if ($productCategory->image)
                Storage::delete('public/productCategories/' . $productCategory->image);
        }
    }

    /**
     * @return void
     */
    public function softDeleteAllProductCategories(): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productCategoriesRepository->softDeleteAll();
    }
}
