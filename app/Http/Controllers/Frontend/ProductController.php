<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\Frontend\Product\ProductsService;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends Controller
{
    private ProductsService $productsService;

    /**
     * @param ProductsService $productsService
     */
    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $products = $this->productsService->getAllProductsPaginated(9);

        return view('frontend.product.index', [
            'products' => $products,
        ]);
    }
}
