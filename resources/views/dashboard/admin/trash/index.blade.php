<x-dashboard-layout :title="$title = 'Trash'">
    <div class="container mt-5">
        <div class="row mb-4">
            @if(!$countOfTrashedItems)
                <h2>{{ __('trash.trash_is_empty') }}</h2>
            @else
                <div class="mb-3">
                    <form action="" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirmDelete('{{ __('general.are_you_sure') }}')" type="submit" class="btn btn-danger shadow-none btn-sm">{{ __('general.delete_all') }}</button>
                    </form>

                    <form action="" method="post" class="d-inline">
                        @csrf

                        <button type="submit" class="btn btn-primary shadow-none btn-sm">{{ __('general.restore_all') }}</button>
                    </form>
                </div>

                @foreach ($models as $modelName => $items)
                    @foreach ($items as $key => $item)
                        <div class="col-md-4 mb-3">
                            @if($modelName === 'App\Models\Post')
                                @include('trash.post.index')
                            @endif

                            @if($modelName === 'App\Models\PostCategory')
                                @include('trash.post-category.index')
                            @endif

                            @if($modelName === 'App\Models\ProductCategory')
                                @include('trash.product-category.index')
                            @endif
                        </div>
                    @endforeach
                @endforeach
            @endif
        </div>
    </div>
</x-dashboard-layout>
