<?php

namespace App\DAL\Repositories\Frontend\Product;

use App\DAL\Repositories\Frontend\Product\Interfaces\IProductsRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
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
            ->with(['productText', 'category'])
            ->where('active', '=', 1)
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
            ->with(['productText', 'category'])
            ->where('active', '=', 1)
            ->paginate($perPage);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product
    {
        return Product::query()
            ->with(['productText', 'category'])
            ->where('active', '=', 1)
            ->find($id);
    }
}
