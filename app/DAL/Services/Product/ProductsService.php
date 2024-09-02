<?php

namespace App\DAL\Services\Product;

use App\DAL\Repositories\Product\Interfaces\IProductsRepository;
use App\Helpers\CacheHelper;
use App\Models\Product;
use App\Utilities\CacheUtility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductsService
{
    private const string MODEL_CLASS = Product::class;
    private IProductsRepository $productsRepository;

    /**
     * @param IProductsRepository $productsRepository
     */
    public function __construct(IProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        return $this->productsRepository->getAll();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllProductsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $cacheKey = CacheHelper::getCacheKeyForPaginatedItems(self::MODEL_CLASS, request('page', 1));

        return Cache::rememberForever($cacheKey, function () use($perPage)
        {
            return $this->productsRepository->getAllPaginated($perPage);
        });
    }

    /**
     * @param int $id
     * @return Builder|Product
     */
    public function getProductById(int $id): Builder|Product
    {
        $cacheKey = CacheHelper::getCacheKeyForSingleItem(self::MODEL_CLASS, $id);

        return Cache::rememberForever($cacheKey, function () use($id)
        {
            return $this->productsRepository->getById($id);
        });
    }

    /**
     * @param array $data
     * @return void
     */
    public function createProduct(array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var Product $product
         */
        $image = $data['image'];
        $imageOriginalName = $image->getClientOriginalName();
        $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
        $data['imageNewName'] = $imageNewName;
        $data['imageOriginalName'] = $imageOriginalName;
        $data['active'] = isset($data['active']) ? boolval($data['active']) : 0;
        $data['showInHome'] = isset($data['showInHome']) ? boolval($data['showInHome']) : 0;

        $product = $this->productsRepository->create($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        if ($product->id)
        {
            $path = 'public/products/' . $data['imageNewName'];
            $image->storeAs($path);
        }
    }

    /**
     * @param int|Product $product
     * @param array $data
     * @return void
     */
    public function updateProduct(int|Product $product, array $data): void
    {
        /**
         * @var UploadedFile $image
         * @var Product $product
         */
        $image = $data['image'] ?? null;
        $data['active'] = isset($data['active']) && boolval($data['active']);
        $data['show_in_home'] = isset($data['showInHome']) && boolval($data['showInHome']);
        $data['product_category_id'] = $data['categoryId'];

        if ($image)
        {
            $imageOriginalName = $image->getClientOriginalName();
            $oldImageName = $product->image;
            $imageNewName = uniqid(date('dmYHis')) . '.' . $image->getClientOriginalExtension();
            $data['imageNewName'] = $imageNewName;
            $data['imageOriginalName'] = $imageOriginalName;

            if ($oldImageName)
                Storage::delete('public/products/' . $oldImageName);

            $path = 'public/products/' . $data['imageNewName'];
            $image->storeAs($path);
        }

        CacheUtility::clearSingleItemCache($product, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->update($product, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function copyProduct(int $id): void
    {
        $product = $this->productsRepository->getById($id);
        $this->productsRepository->copy($id);

        CacheUtility::clearSingleItemCache($product, self::MODEL_CLASS);
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);
    }

    /**
     * @param int|Product $product
     * @return void
     */
    public function deleteProduct(int|Product $product): void
    {
        $image = $product->image ?? null;

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->delete($product);

        if ($image)
            Storage::delete('public/products/' . $image);
    }

    /**
     * @param int|Product $product
     * @return void
     */
    public function softDeleteProduct(int|Product $product): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->softDelete($product);
    }

    /**
     * @param array $data
     * @return void
     */
    public function deleteProductsMultiple(array $data): void
    {
        $selectedProducts = $this->productsRepository->getAllSelected($data);

        $this->productsRepository->deleteMultiple($data);

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        foreach ($selectedProducts as $product)
        {
            if ($product->image)
                Storage::delete('public/products/' . $product->image);
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public function softDeleteProductsMultiple(array $data): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->softDeleteMultiple($data);
    }

    /**
     * @return void
     */
    public function deleteAllProducts(): void
    {
        $allProducts = $this->productsRepository->getAll();

        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->deleteAll();

        foreach ($allProducts as $product)
        {
            if ($product->image)
                Storage::delete('public/products/' . $product->image);
        }
    }

    /**
     * @return void
     */
    public function softDeleteAllProducts(): void
    {
        CacheUtility::clearPaginatedItemsCache(self::MODEL_CLASS);

        $this->productsRepository->softDeleteAll();
    }
}
