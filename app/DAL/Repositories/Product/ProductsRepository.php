<?php

namespace App\DAL\Repositories\Product;

use App\DAL\Repositories\Product\Interfaces\IProductsRepository;
use App\Models\Product;
use App\Models\ProductText;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Override;

class ProductsRepository implements IProductsRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return Product::query()
            ->with(['productText'])
            ->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Product::query()
            ->with(['productText'])
            ->paginate($perPage);
    }

    /**
     * @return Product[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return Product::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return Product::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Product
     */
    #[Override]
    public function getById(int $id): Builder|Product
    {
        return Product::query()
            ->with(['productText'])
            ->find($id);
    }

    /**
     * @param array $data
     * @return Builder|Product
     */
    #[Override]
    public function create(array $data): Builder|Product
    {
        $product = Product::query()->create([
            'youtube_url' => 'https://youtube.com',
            'active' => $data['active'],
            'show_in_home' => $data['showInHome'],
            'image' => $data['imageNewName'],
            'image_original_name' => $data['imageOriginalName'],
            'product_category_id' => $data['categoryId'],
            'price' => $data['price'],
        ]);

        $product->productText()->create([
            'product_id' => $product->id,
            'language_id' => null,
            'name' => [
                'hy' => $data['nameHy'],
                'en' => $data['nameEn'],
                'ru' => $data['nameRu'],
            ],

            'short_description' => [
                'hy' => $data['shortDescriptionHy'],
                'en' => $data['shortDescriptionEn'],
                'ru' => $data['shortDescriptionRu'],
            ],

            'description' => [
                'hy' => $data['descriptionHy'],
                'en' => $data['descriptionEn'],
                'ru' => $data['descriptionRu'],
            ],
        ]);

        return $product;
    }

    /**
     * @param int|Product $product
     * @param array $data
     * @return Builder|Product
     */
    #[Override]
    public function update(int|Product $product, array $data): Builder|Product
    {
        if (isset($data['imageNewName']) && isset($data['imageOriginalName']))
        {
            $data['image'] = $data['imageNewName'];
            $data['image_original_name'] = $data['imageOriginalName'];
        }

        $product->update($data);

        $product->productText()->update([
            'product_id' => $product->id,
            'language_id' => null,
            'name' => [
                'hy' => $data['nameHy'],
                'en' => $data['nameEn'],
                'ru' => $data['nameRu'],
            ],
            'description' => [
                'hy' => $data['descriptionHy'],
                'en' => $data['descriptionEn'],
                'ru' => $data['descriptionRu'],
            ],
        ]);

        return $product;
    }

    /**
     * @param int $id
     * @return Model|Builder
     */
    #[Override]
    public function copy(int $id): Builder|Model
    {
        $product = $this->getById($id);

        $newProduct = Product::query()->create([
            'youtube_url' => 'https://youtube.com',
            'active' => $product->active,
            'show_in_home' => $product->show_in_home,
            'product_category_id' => $product->product_category_id,
            'price' => $product->price,
        ]);

        $copiedProductText = ProductText::query()->create([
            'product_id' => $newProduct->id,
            'language_id' => null,
            'name' => [
                'hy' => $product->productText->getTranslation('name', 'hy'),
                'en' => $product->productText->getTranslation('name', 'en'),
                'ru' => $product->productText->getTranslation('name', 'ru'),
            ],

            'short_description' => [
                'hy' => $product->productText->getTranslation('short_description', 'hy'),
                'en' => $product->productText->getTranslation('short_description', 'en'),
                'ru' => $product->productText->getTranslation('short_description', 'ru'),
            ],

            'description' => [
                'hy' => $product->productText->getTranslation('description', 'hy'),
                'en' => $product->productText->getTranslation('description', 'en'),
                'ru' => $product->productText->getTranslation('description', 'ru'),
            ],
        ]);

        $copiedProductText->save();

        return $copiedProductText;
    }

    /**
     * @param int|Product $product
     * @return int|Product
     */
    #[Override]
    public function delete(int|Product $product): int|Product
    {
        $product->forceDelete();

        return $product;
    }

    /**
     * @param int|Product $product
     * @return int|Product
     */
    #[Override]
    public function softDelete(int|Product $product): int|Product
    {
        $product->delete();

        return $product;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Product::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Product::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return Product::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return Product::moveToTrashAll();
    }
}
