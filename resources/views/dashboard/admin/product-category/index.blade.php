@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Product Category|Index'">
    <!-- Table Start -->
    <div class="container-fluid product-categories-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('product-category.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('product-categories.create_new') }}
                    </a>

                    @if(count($productCategories))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedProductCategoriesBtn">
                            {{ __('product-categories.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedProductCategoriesBtn">
                            {{ __('product-categories.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllProductCategoriesBtn">
                            {{ __('product-categories.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllProductCategoriesBtn">
                            {{ __('product-categories.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('product-categories.product_categories') }}</h6>

                    <div class="table-responsive product-categories-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('product-categories.name') }}</th>
                                <th scope="col">{{ __('product-categories.index.active') }}</th>
                                <th scope="col">{{ __('product-categories.created_at') }}</th>
                                <th scope="col">{{ __('product-categories.index.image') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productCategories as $key => $productCategory)
                                @php
                                    $image = $productCategory->image ? Storage::url('productCategories/' . $productCategory->image) : asset('images/post_thumbnail.svg');
                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ product-category-checkbox"
                                               id="productCategoryCheckBox_{{ $productCategory->id }}"
                                               value="{{ $productCategory->id }}"
                                        >
                                    </td>

                                    <td>{{ $productCategory->id }}</td>
                                    <td>{{ $productCategory->productCategoryText->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $productCategory->is_active ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>{{ $productCategory->created_at_diff }}</td>
                                    <td>
                                        <img class="product-category-image" src="{{ $image }}" alt="{{ $productCategory->productCategoryText->title }}">
                                    </td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-primary btn-sm"
                                                   title="{{ __('product-categories.view_icon_link_title') }}"
                                                   href="{{ route('product-category.show', $productCategory->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('product-categories.edit_icon_link_title') }}"
                                                   href="{{ route('product-category.edit', ['id' => $productCategory->id, 'page' => $productCategories->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('product-category.copy', $productCategory->id) }}" id="productCategoryCopyForm"
                                                      method="post">
                                                    @csrf

                                                    <button class="btn btn-success btn-sm" type="submit"
                                                            title="{{ __('product-categories.copy_icon_link_title') }}">
                                                        <i class="fa-solid fa-copy"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('product-category.soft-delete', $productCategory->id) }}" id="productCategorySoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('product-categories.alert.are_you_sure') }}')"
                                                            title="{{ __('product-categories.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('product-category.delete', $productCategory->id) }}" id="productCategoryDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('product-categories.alert.are_you_sure') }}')"
                                                            title="{{ __('product-categories.delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 mb-5">
            {{ $productCategories->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const productCategoriesMessages = {
                confirm: '{{ __('product-categories.alert.are_you_sure') }}',
                success: '{{ __('product-categories.alert.deleted_successfully') }}',
                error: '{{ __('product-categories.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('product-categories.alert.please_select_at_least_one_product_category_to_delete') }}',
            };

            deleteMultiple('{{ route("product-category.delete-multiple") }}', '#deleteSelectedProductCategoriesBtn', '.product-category-checkbox', productCategoriesMessages);
            softDeleteMultiple('{{ route("product-category.soft-delete-multiple") }}', '#softDeleteSelectedProductCategoriesBtn', '.product-category-checkbox', productCategoriesMessages);
            deleteAll('{{ route("product-category.delete-all") }}', '#deleteAllProductCategoriesBtn', productCategoriesMessages);
            softDeleteAll('{{ route("product-category.soft-delete-all") }}', '#softDeleteAllProductCategoriesBtn', productCategoriesMessages);
        </script>
    @endpush
</x-dashboard-layout>
