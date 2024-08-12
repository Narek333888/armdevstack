<?php

namespace App\DAL\Repositories\Post;

use App\DAL\Repositories\Post\Interfaces\IPostsRepository;
use App\Models\Post;
use App\Models\PostText;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Override;

class PostsRepository implements IPostsRepository
{
    /**
     * @return Collection
     */
    #[Override]
    public function getAll(): Collection
    {
        return Post::query()
            ->with(['postText'])
            ->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    #[Override]
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Post::query()
            ->with(['postText'])
            ->paginate($perPage);
    }

    /**
     * @return Post[]|Builder[]|Collection
     */
    #[Override]
    public function getAllSoftDeleted(): array|Collection
    {
        return Post::query()->onlyTrashed()->get();
    }

    /**
     * @param array $data
     * @return array|Collection
     */
    #[Override]
    public function getAllSelected(array $data): array|Collection
    {
        $ids = $data['ids'];

        return Post::query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param int $id
     * @return Builder|Post
     */
    #[Override]
    public function getById(int $id): Builder|Post
    {
        return Post::query()
            ->with(['postText'])
            ->find($id);
    }

    /**
     * @param array $data
     * @return Builder|Post
     */
    #[Override]
    public function create(array $data): Builder|Post
    {
        $post = Post::query()->create([
            'youtube_url' => 'https://youtube.com',
            'active' => $data['active'],
            'image' => $data['imageNewName'],
            'image_original_name' => $data['imageOriginalName'],
        ]);

        $post->postText()->create([
            'post_id' => $post->id,
            'language_id' => null,
            'title' => [
                'hy' => $data['titleHy'],
                'en' => $data['titleEn'],
                'ru' => $data['titleRu'],
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

        return $post;
    }

    /**
     * @param int|Post $post
     * @param array $data
     * @return Builder|Post
     */
    #[Override]
    public function update(int|Post $post, array $data): Builder|Post
    {
        $active = isset($data['active']) ? 1 : 0;

        $data['active'] = $active;

        if (isset($data['imageNewName']) && isset($data['imageOriginalName']))
        {
            $data['image'] = $data['imageNewName'];
            $data['image_original_name'] = $data['imageOriginalName'];
        }

        $post->update($data);

        $post->postText()->update([
            'post_id' => $post->id,
            'language_id' => null,
            'title' => [
                'hy' => $data['titleHy'],
                'en' => $data['titleEn'],
                'ru' => $data['titleRu'],
            ],
            'description' => [
                'hy' => $data['descriptionHy'],
                'en' => $data['descriptionEn'],
                'ru' => $data['descriptionRu'],
            ],
        ]);

        return $post;
    }

    /**
     * @param int $id
     * @return Model|Builder
     */
    #[Override]
    public function copy(int $id): Builder|Model
    {
        $post = $this->getById($id);

        $newPost = Post::query()->create([
            'youtube_url' => 'https://youtube.com',
            'active' => $post->active,
        ]);

        $copiedPostText = PostText::query()->create([
            'post_id' => $newPost->id,
            'language_id' => null,
            'title' => [
                'hy' => $post->postText->getTranslation('title', 'hy'),
                'en' => $post->postText->getTranslation('title', 'en'),
                'ru' => $post->postText->getTranslation('title', 'ru'),
            ],

            'short_description' => [
                'hy' => $post->postText->getTranslation('short_description', 'hy'),
                'en' => $post->postText->getTranslation('short_description', 'en'),
                'ru' => $post->postText->getTranslation('short_description', 'ru'),
            ],

            'description' => [
                'hy' => $post->postText->getTranslation('description', 'hy'),
                'en' => $post->postText->getTranslation('description', 'en'),
                'ru' => $post->postText->getTranslation('description', 'ru'),
            ],
        ]);

        $copiedPostText->save();

        return $copiedPostText;
    }

    /**
     * @param int|Post $post
     * @return int|Post
     */
    #[Override]
    public function delete(int|Post $post): int|Post
    {
        $post->forceDelete();

        return $post;
    }

    /**
     * @param int|Post $post
     * @return int|Post
     */
    #[Override]
    public function softDelete(int|Post $post): int|Post
    {
        $post->delete();

        return $post;
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function deleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Post::query()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * @param array $data
     * @return bool|null
     */
    #[Override]
    public function softDeleteMultiple(array $data): ?bool
    {
        $ids = $data['ids'];

        return Post::bulkMoveToTrash($ids);
    }

    /**
     * @return mixed
     */
    #[Override]
    public function deleteAll(): mixed
    {
        return Post::query()->forceDelete();
    }

    /**
     * @return bool|null
     */
    #[Override]
    public function softDeleteAll(): ?bool
    {
        return Post::moveToTrashAll();
    }

    /**
     * @param Post $post
     * @param array $categoryIds
     * @return void
     */
    public function attachCategories(Post $post, array $categoryIds): void
    {
        $post->categories()->attach($categoryIds);
    }

    /**
     * @param Post $post
     * @param array $categoryIds
     * @return void
     */
    public function syncCategories(Post $post, array $categoryIds): void
    {
        $post->categories()->sync($categoryIds);
    }
}
