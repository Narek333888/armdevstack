@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Post Category|Index'">
    <!-- Table Start -->
    <div class="container-fluid posts-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('post-category.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('post-categories.create_new') }}
                    </a>

                    @if(count($postCategories))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedPostCategoriesBtn">
                            {{ __('post-categories.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedPostCategoriesBtn">
                            {{ __('post-categories.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllPostCategoriesBtn">
                            {{ __('post-categories.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllPostCategoriesBtn">
                            {{ __('post-categories.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('post-categories.post_categories') }}</h6>

                    <div class="table-responsive post-categories-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('post-categories.name') }}</th>
                                <th scope="col">{{ __('post-categories.index.active') }}</th>
                                <th scope="col">{{ __('post-categories.created_at') }}</th>
                                <th scope="col">{{ __('post-categories.index.image') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($postCategories as $key => $postCategory)
                                @php
                                    $image = $postCategory->image ? Storage::url('postCategories/' . $postCategory->image) : asset('images/post_thumbnail.svg');
                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ post-category-checkbox"
                                               id="postCategoryCheckBox_{{ $postCategory->id }}"
                                               value="{{ $postCategory->id }}"
                                        >
                                    </td>
                                    <td>{{ $postCategory->id }}</td>
                                    <td>{{ $postCategory->postCategoryText->name }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $postCategory->is_active ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>{{ $postCategory->created_at_diff }}</td>
                                    <td>
                                        <img class="post-category-image" src="{{ $image }}" alt="{{ $postCategory->postCategoryText->title }}">
                                    </td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-primary btn-sm"
                                                   title="{{ __('post-categories.view_icon_link_title') }}"
                                                   href="{{ route('post-category.show', $postCategory->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('post-categories.edit_icon_link_title') }}"
                                                   href="{{ route('post-category.edit', ['id' => $postCategory->id, 'page' => $postCategories->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('post-category.copy', $postCategory->id) }}" id="postCategoryCopyForm"
                                                      method="post">
                                                    @csrf

                                                    <button class="btn btn-success btn-sm" type="submit"
                                                            title="{{ __('post-categories.copy_icon_link_title') }}">
                                                        <i class="fa-solid fa-copy"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('post-category.soft-delete', $postCategory->id) }}" id="postCategorySoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('post-categories.alert.are_you_sure') }}')"
                                                            title="{{ __('post-categories.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('post-category.delete', $postCategory->id) }}" id="postCategoryDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('post-categories.alert.are_you_sure') }}')"
                                                            title="{{ __('post-categories.delete_icon_link_title') }}">
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
            {{ $postCategories->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const postCategoriesMessages = {
                confirm: '{{ __('post-categories.alert.are_you_sure') }}',
                success: '{{ __('post-categories.alert.deleted_successfully') }}',
                error: '{{ __('post-categories.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('post-categories.alert.please_select_at_least_one_post_category_to_delete') }}',
            };

            deleteMultiple('{{ route("post-category.delete-multiple") }}', '#deleteSelectedPostCategoriesBtn', '.post-category-checkbox', postCategoriesMessages);
            softDeleteMultiple('{{ route("post-category.soft-delete-multiple") }}', '#softDeleteSelectedPostCategoriesBtn', '.post-category-checkbox', postCategoriesMessages);
            deleteAll('{{ route("post-category.delete-all") }}', '#deleteAllPostCategoriesBtn', postCategoriesMessages);
            softDeleteAll('{{ route("post-category.soft-delete-all") }}', '#softDeleteAllPostCategoriesBtn', postCategoriesMessages);
        </script>
    @endpush
</x-dashboard-layout>
