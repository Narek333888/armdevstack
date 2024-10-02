<?php

namespace App\Services\Frontend\Product;

use App\Models\Product;
use App\Repositories\Frontend\Product\Interfaces\IProductsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return $this->productsRepository->getAllPaginated($perPage);
    }

    /**
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id): Product
    {
        return $this->productsRepository->getById($id);
    }
}
