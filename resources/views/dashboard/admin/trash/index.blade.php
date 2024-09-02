<x-dashboard-layout :title="$title = 'Trash'">
    <div class="container mt-5">
        <div class="row mb-4">
            @if(!$countOfTrashedItems)
                <h2>{{ __('trash.trash_is_empty') }}</h2>
            @else
                @foreach ($models as $modelName => $items)
                    @foreach ($items as $key => $item)
                        <div class="col-md-4 mb-3">
                            @if($modelName === 'App\Models\Post')
                                @include('dashboard.admin.trash.post.index')
                            @endif

                            @if($modelName === 'App\Models\PostCategory')
                                @include('dashboard.admin.trash.post-category.index')
                            @endif

                            @if($modelName === 'App\Models\ProductCategory')
                                @include('dashboard.admin.trash.product-category.index')
                            @endif

                            @if($modelName === 'App\Models\Product')
                                @include('dashboard.admin.trash.product.index')
                            @endif

                            @if($modelName === 'App\Models\User')
                                @include('dashboard.admin.trash.user.index')
                            @endif

                            @if($modelName === 'App\Models\Role')
                                @include('dashboard.admin.trash.role.index')
                            @endif

                            @if($modelName === 'App\Models\Permission')
                                @include('dashboard.admin.trash.permission.index')
                            @endif
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
</x-dashboard-layout>
