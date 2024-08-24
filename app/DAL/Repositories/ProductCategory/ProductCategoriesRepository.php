<?php

namespace App\DAL\Repositories\ProductCategory;

use App\DAL\Repositories\ProductCategory\Interfaces\IProductCategoriesRepository;
use App\Models\ProductCategory;
use App\Models\ProductCategoryText;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Override;

class ProductCategoriesRepository implements IProductCategoriesRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return ProductCategory::query()
            ->with(['productCategoryText'])
            ->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return ProductCategory::query()
            ->with(['productCategoryText'])
            ->paginate($perPage);
    }

    /**
     * @return ProductCategory[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return ProductCategory::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return ProductCategory::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|ProductCategory
     */
    #[Override]
    public function getById(int $id): Builder|ProductCategory
    {
        return ProductCategory::query()
            ->with(['productCategoryText'])
            ->find($id);
    }

    /**
     * @param array $data
     * @return Builder|ProductCategory
     */
    #[Override]
    public function create(array $data): Builder|ProductCategory
    {
        $productCategory = ProductCategory::query()->create([
            'is_active' => $data['active'],
            'image' => $data['imageNewName'],
            'image_original_name' => $data['imageOriginalName'],
        ]);

        $productCategory->productCategoryText()->create([
            'product_category_id' => $productCategory->id,
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

        return $productCategory;
    }

    /**
     * @param int|ProductCategory $productCategory
     * @param array $data
     * @return Builder|ProductCategory
     */
    #[Override]
    public function update(int|ProductCategory $productCategory, array $data): Builder|ProductCategory
    {
        $active = isset($data['active']) ? 1 : 0;

        $data['is_active'] = $active;

        if (isset($data['imageNewName']) && isset($data['imageOriginalName']))
        {
            $data['image'] = $data['imageNewName'];
            $data['image_original_name'] = $data['imageOriginalName'];
        }

        $productCategory->update($data);

        $productCategory->productCategoryText()->update([
            'product_category_id' => $productCategory->id,
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

        return $productCategory;
    }

    /**
     * @param int $id
     * @return Model|Builder
     */
    #[Override]
    public function copy(int $id): Builder|Model
    {
        $productCategory = $this->getById($id);

        $newProductCategory = ProductCategory::query()->create([
            'is_active' => $productCategory->is_active,
        ]);

        $copiedProductCategoryText = ProductCategoryText::query()->create([
            'product_category_id' => $newProductCategory->id,
            'language_id' => null,
            'name' => [
                'hy' => $productCategory->productCategoryText->getTranslation('name', 'hy'),
                'en' => $productCategory->productCategoryText->getTranslation('name', 'en'),
                'ru' => $productCategory->productCategoryText->getTranslation('name', 'ru'),
            ],

            'description' => [
                'hy' => $productCategory->productCategoryText->getTranslation('description', 'hy'),
                'en' => $productCategory->productCategoryText->getTranslation('description', 'en'),
                'ru' => $productCategory->productCategoryText->getTranslation('description', 'ru'),
            ],
        ]);

        $copiedProductCategoryText->save();

        return $copiedProductCategoryText;
    }

    /**
     * @param int|ProductCategory $productCategory
     * @return int|ProductCategory
     */
    #[Override]
    public function delete(int|ProductCategory $productCategory): int|ProductCategory
    {
        $productCategory->forceDelete();

        return $productCategory;
    }

    /**
     * @param int|ProductCategory $productCategory
     * @return int|ProductCategory
     */
    #[Override]
    public function softDelete(int|ProductCategory $productCategory): int|ProductCategory
    {
        $productCategory->delete();

        return $productCategory;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return ProductCategory::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return ProductCategory::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return ProductCategory::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return ProductCategory::moveToTrashAll();
    }
}
