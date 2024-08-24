<?php

namespace App\Http\Controllers;

use App\DAL\Services\ProductCategory\ProductCategoriesService;
use App\Helpers\SessionHelper;
use App\Http\Requests\ProductCategory\ProductCategoryDeleteMultipleRequest;
use App\Http\Requests\ProductCategory\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategory\ProductCategoryUpdateRequest;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;


class ProductCategoryController extends Controller
{
    private ProductCategoriesService $productCategoriesService;

    /**
     * @param ProductCategoriesService $productCategoriesService
     */
    public function __construct(ProductCategoriesService $productCategoriesService)
    {
        $this->productCategoriesService = $productCategoriesService;
    }

    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        $productCategories = $this->productCategoriesService->getAllProductCategoriesPaginated();

        return view('dashboard.admin.product-category.index', compact('productCategories'));
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $productCategory = $this->productCategoriesService->getProductCategoryById($id);

        return view('dashboard.admin.product-category.show', compact('productCategory'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('dashboard.admin.product-category.create');
    }

    /**
     * @param ProductCategoryStoreRequest $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(ProductCategoryStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->productCategoriesService->createProductCategory($data);

        return redirect()->route('product-category.index')->with(['success' => __('product-categories.alert.created_successfully')]);
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function edit(int $id): Renderable
    {
        $productCategory = $this->productCategoriesService->getProductCategoryById($id);

        SessionHelper::setValue('product_category_edit_page', intval(request()->query('page', 1)));

        return view('dashboard.admin.product-category.edit', compact('productCategory'));
    }

    /**
     * @param ProductCategoryUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(ProductCategoryUpdateRequest $request, int $id): RedirectResponse
    {
        $productCategory = $this->productCategoriesService->getProductCategoryById($id);

        $page = $request->input('page', SessionHelper::getValue('product_category_edit_page', 1));

        $this->productCategoriesService->updateProductCategory($productCategory, $request->validated());

        return redirect()->route('product-category.index', ['page' => intVal($page)])->with(['success' => __('product-categories.alert.updated_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function copy(int $id): RedirectResponse
    {
        $this->productCategoriesService->copyProductCategory($id);

        return redirect()->back()->with(['success' => __('product-categories.alert.copied_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(int $id): RedirectResponse
    {
        $productCategory = $this->productCategoriesService->getProductCategoryById($id);

        $this->productCategoriesService->deleteProductCategory($productCategory);

        return redirect()->back()->with(['success' => __('product-categories.alert.deleted_successfully')]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $productCategory = $this->productCategoriesService->getProductCategoryById($id);

        $this->productCategoriesService->softDeleteProductCategory($productCategory);

        return redirect()->back()->with(['success' => __('product-categories.alert.soft_deleted_successfully')]);
    }

    /**
     * @param ProductCategoryDeleteMultipleRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteMultiple(ProductCategoryDeleteMultipleRequest $request): JsonResponse
    {
        $this->productCategoriesService->deleteProductCategoriesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('product-categories.alert.deleted_successfully')]);
    }

    /**
     * @param ProductCategoryDeleteMultipleRequest $request
     * @return JsonResponse
     */
    public function softDeleteMultiple(ProductCategoryDeleteMultipleRequest $request): JsonResponse
    {
        $this->productCategoriesService->softDeleteProductCategoriesMultiple($request->validated());

        return response()->json(['status' => 'success', 'message' => __('product-categories.alert.soft_deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteAll(): JsonResponse
    {
        $this->productCategoriesService->deleteAllProductCategories();

        return response()->json(['status' => 'success', 'message' => __('product-categories.alert.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function softDeleteAll(): JsonResponse
    {
        $this->productCategoriesService->softDeleteAllProductCategories();

        return response()->json(['status' => 'success', 'message' => __('product-categories.alert.soft_deleted_successfully')]);
    }
}
