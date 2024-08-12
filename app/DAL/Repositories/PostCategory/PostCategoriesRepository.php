<?php

namespace App\DAL\Repositories\PostCategory;

use App\DAL\Repositories\PostCategory\Interfaces\IPostCategoriesRepository;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostCategoryText;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Override;

class PostCategoriesRepository implements IPostCategoriesRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return PostCategory::query()
            ->with(['postCategoryText'])
            ->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return PostCategory::query()
            ->with(['postCategoryText'])
            ->paginate($perPage);
    }

    /**
     * @return PostCategory[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return PostCategory::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return PostCategory::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param Post $post
     * @return array
     */
    public function getAttached(Post $post): array
    {
        return $post->categories->pluck('id')->toArray();
    }

    /**
     * @param int $id
     * @return Builder|PostCategory
     */
    #[Override]
    public function getById(int $id): Builder|PostCategory
    {
        return PostCategory::query()
            ->with(['postCategoryText'])
            ->find($id);
    }

    /**
     * @param array $data
     * @return Builder|PostCategory
     */
    #[Override]
    public function create(array $data): Builder|PostCategory
    {
        $postCategory = PostCategory::query()->create([
            'is_active' => $data['active'],
            'image' => $data['imageNewName'],
            'image_original_name' => $data['imageOriginalName'],
        ]);

        $postCategory->postCategoryText()->create([
            'post_category_id' => $postCategory->id,
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

        return $postCategory;
    }

    /**
     * @param int|PostCategory $postCategory
     * @param array $data
     * @return Builder|PostCategory
     */
    #[Override]
    public function update(int|PostCategory $postCategory, array $data): Builder|PostCategory
    {
        $active = isset($data['active']) ? 1 : 0;

        $data['is_active'] = $active;

        if (isset($data['imageNewName']) && isset($data['imageOriginalName']))
        {
            $data['image'] = $data['imageNewName'];
            $data['image_original_name'] = $data['imageOriginalName'];
        }

        $postCategory->update($data);

        $postCategory->postCategoryText()->update([
            'post_category_id' => $postCategory->id,
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

        return $postCategory;
    }

    /**
     * @param int $id
     * @return Model|Builder
     */
    #[Override]
    public function copy(int $id): Builder|Model
    {
        $postCategory = $this->getById($id);

        $newPostCategory = PostCategory::query()->create([
            'is_active' => $postCategory->is_active,
        ]);

        $copiedPostCategoryText = PostCategoryText::query()->create([
            'post_category_id' => $newPostCategory->id,
            'language_id' => null,
            'name' => [
                'hy' => $postCategory->postCategoryText->getTranslation('name', 'hy'),
                'en' => $postCategory->postCategoryText->getTranslation('name', 'en'),
                'ru' => $postCategory->postCategoryText->getTranslation('name', 'ru'),
            ],

            'description' => [
                'hy' => $postCategory->postCategoryText->getTranslation('description', 'hy'),
                'en' => $postCategory->postCategoryText->getTranslation('description', 'en'),
                'ru' => $postCategory->postCategoryText->getTranslation('description', 'ru'),
            ],
        ]);

        $copiedPostCategoryText->save();

        return $copiedPostCategoryText;
    }

    /**
     * @param int|PostCategory $postCategory
     * @return int|PostCategory
     */
    #[Override]
    public function delete(int|PostCategory $postCategory): int|PostCategory
    {
        $postCategory->forceDelete();

        return $postCategory;
    }

    /**
     * @param int|PostCategory $postCategory
     * @return int|PostCategory
     */
    #[Override]
    public function softDelete(int|PostCategory $postCategory): int|PostCategory
    {
        $postCategory->delete();

        return $postCategory;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return PostCategory::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return PostCategory::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return PostCategory::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return PostCategory::moveToTrashAll();
    }
}
