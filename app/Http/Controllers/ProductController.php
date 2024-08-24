<?php

namespace App\Http\Controllers;

use App\DAL\Services\Product\ProductsService;
use App\DAL\Services\ProductCategory\ProductCategoriesService;
use App\Helpers\SessionHelper;
use App\Http\Requests\Product\ProductDeleteMultipleRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    private ProductsService $productsService;
    private ProductCategoriesService $productCategoriesService;

    /**
     * @param ProductsService $productsService
     * @param ProductCategoriesService $productCategoriesService
     */
    public function __construct(ProductsService $productsService, ProductCategoriesService $productCategoriesService)
    {
        $this->productsService = $productsService;
        $this->productCategoriesService = $productCategoriesService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $products = $this->productsService->getAllProductsPaginated();

        return view('dashboard.admin.product.index', compact('products'));
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $product = $this->productsService->getProductById($id);

        return view('dashboard.admin.product.show', compact('product'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        $productCategories = $this->productCategoriesService->getAllProductCategories();

        return view('dashboard.admin.product.create', [
            'productCategories' => $productCategories,
        ]);
    }

    /**
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->productsService->createProduct($data);

        return redirect()->route('product.index')->with(['success' => __('products.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $product = $this->productsService->getProductById($id);
        $productCategories = $this->productCategoriesService->getAllProductCategories();

        SessionHelper::setValue('product_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.product.edit', [
            'product' => $product,
            'productCategories' => $productCategories,
        ]);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(ProductUpdateRequest $request, int $id): RedirectResponse
    {
        $product = $this->productsService->getProductById($id);

        $page = $request->input('page', SessionHelper::getValue('product_edit_page', 1));

        $this->productsService->updateProduct($product, $request->validated());

        return redirect()->route('product.index', ['id' => $product->id, 'page' => intVal($page)])->with(['success' => __('products.alert.updated_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function copy(int $id): RedirectResponse
    {
        $this->productsService->copyProduct($id);

        return redirect()->back()->with(['success' => __('products.alert.copied_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $product = $this->productsService->getProductById($id);

        $this->productsService->deleteProduct($product);

        return redirect()->back()->with(['success' => __('products.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $product = $this->productsService->getProductById($id);

        $this->productsService->softDeleteProduct($product);

        return redirect()->back()->with(['success' => __('products.alert.soft_deleted_successfully')]);
    }

    /**
     * @param ProductDeleteMultipleRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMultiple(ProductDeleteMultipleRequest $request): JsonResponse
    {
        $this->productsService->deleteProductsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('products.alert.deleted_successfully')]);
    }

    /**
     * @param ProductDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(ProductDeleteMultipleRequest $request): JsonResponse
    {
        $this->productsService->softDeleteProductsMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('products.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteAll(): JsonResponse
    {
        $this->productsService->deleteAllProducts();

        return response()->json(['status' => 'success', 'message' => __('products.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->productsService->softDeleteAllProducts();

        return response()->json(['status' => 'success', 'message' => __('products.alert.soft_deleted_successfully')]);
    }
}
