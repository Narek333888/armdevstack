<?php

namespace App\Services\Product;

use App\Helpers\CacheHelper;
use App\Managers\Interfaces\IImageManager;
use App\Models\Product;
use App\Repositories\Product\Interfaces\IProductsRepository;
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
    private const string IMAGE_PATH = 'public/products/';
    private const string THUMBNAIL_IMAGE_PATH = 'public/products/thumbnailImages/';

    private IProductsRepository $productsRepository;
    private IImageManager $imageManager;

    /**
     * @param IProductsRepository $productsRepository
     * @param IImageManager $imageManager
     */
    public function __construct(IProductsRepository $productsRepository, IImageManager $imageManager)
    {
        $this->productsRepository = $productsRepository;
        $this->imageManager = $imageManager;
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
            $path = self::IMAGE_PATH . $data['imageNewName'];
            $this->imageManager->storeImage($image, $path);

            $thumbnailPath = self::THUMBNAIL_IMAGE_PATH . $imageNewName;
            $this->imageManager->createThumbnail($image, $thumbnailPath, 400, 200, 90, true);
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
            {
                Storage::delete(self::IMAGE_PATH . $oldImageName);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $oldImageName);
            }

            $path = self::IMAGE_PATH . $data['imageNewName'];
            $this->imageManager->storeImage($image, $path);

            $thumbnailPath = self::THUMBNAIL_IMAGE_PATH . $imageNewName;
            $this->imageManager->createThumbnail($image, $thumbnailPath, 300, 350, 90, true);
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
        {
            Storage::delete(self::IMAGE_PATH . $image);
            Storage::delete(self::THUMBNAIL_IMAGE_PATH . $image);
        }
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
            {
                Storage::delete(self::IMAGE_PATH . $product->image);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $product->image);
            }
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
            {
                Storage::delete(self::IMAGE_PATH . $product->image);
                Storage::delete(self::THUMBNAIL_IMAGE_PATH . $product->image);
            }
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
