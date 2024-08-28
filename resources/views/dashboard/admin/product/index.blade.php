@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Product|Index'">
    <!-- Table Start -->
    <div class="container-fluid products-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('products.create_new') }}
                    </a>

                    @if(count($products))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedProductsBtn">
                            {{ __('products.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedProductsBtn">
                            {{ __('products.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllProductsBtn">
                            {{ __('products.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllProductsBtn">
                            {{ __('products.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('products.products') }}</h6>

                    <div class="table-responsive products-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                {{--<th>
                                    <input type="checkbox" class="select-all-products" id="selectAllProducts">
                                </th>--}}
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('products.name') }}</th>
                                <th scope="col">{{ __('products.short_description') }}</th>
                                <th scope="col">{{ __('products.category') }}</th>
                                <th scope="col">{{ __('products.price') }}</th>
                                <th scope="col">{{ __('products.index.active') }}</th>
                                <th scope="col">{{ __('products.show_in_home') }}</th>
                                <th scope="col">{{ __('products.created_at') }}</th>
                                <th scope="col">{{ __('products.index.image') }}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                @php
                                    $image = $product->image ? Storage::url('products/' . $product->image) : asset('images/post_thumbnail.svg');
                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ product-checkbox"
                                               id="productCheckBox_{{ $product->id }}"
                                               value="{{ $product->id }}"
                                        >
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->productText->name }}</td>
                                    <td>{{ Str::words($product->productText->short_description, 50) }}</td>
                                    <td>{{ $product->category->productCategoryText->name }}</td>
                                    <td>
                                        <div class="d-flex d-inline-flex">
                                            <div>{{ $product->price }}</div>&nbsp;
                                            <div>$</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $product->active ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $product->show_in_home ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>{{ $product->created_at_diff }}</td>
                                    <td>
                                        <img class="product-image" src="{{ $image }}" alt="{{ $product->productText->name }}">
                                    </td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-primary btn-sm"
                                                   title="{{ __('products.view_icon_link_title') }}"
                                                   href="{{ route('product.show', $product->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('products.edit_icon_link_title') }}"
                                                   href="{{ route('product.edit', ['id' => $product->id, 'page' => $products->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('product.copy', $product->id) }}" id="productCopyForm"
                                                      method="post">
                                                    @csrf

                                                    <button class="btn btn-success btn-sm" type="submit"
                                                            title="{{ __('products.copy_icon_link_title') }}">
                                                        <i class="fa-solid fa-copy"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('product.soft-delete', $product->id) }}" id="productSoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('products.alert.are_you_sure') }}')"
                                                            title="{{ __('products.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('product.delete', $product->id) }}" id="productDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('products.alert.are_you_sure') }}')"
                                                            title="{{ __('products.delete_icon_link_title') }}">
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
            {{ $products->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const productsMessages = {
                confirm: '{{ __('products.alert.are_you_sure') }}',
                success: '{{ __('products.alert.deleted_successfully') }}',
                error: '{{ __('products.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('products.alert.please_select_at_least_one_product_to_delete') }}',
            };

            deleteMultiple('{{ route("product.delete-multiple") }}', '#deleteSelectedProductsBtn', '.product-checkbox', productsMessages);
            softDeleteMultiple('{{ route("product.soft-delete-multiple") }}', '#softDeleteSelectedProductsBtn', '.product-checkbox', productsMessages);
            deleteAll('{{ route("product.delete-all") }}', '#deleteAllProductsBtn', productsMessages);
            softDeleteAll('{{ route("product.soft-delete-all") }}', '#softDeleteAllProductsBtn', productsMessages);

            //selectAll('#selectAllProducts', '.product-checkbox');
        </script>
    @endpush
</x-dashboard-layout>
