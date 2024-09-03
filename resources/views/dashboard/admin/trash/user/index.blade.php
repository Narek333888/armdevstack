@php
    use App\Helpers\StringHelper;
@endphp

<div class="card">
    <div class="card-body">
        {{--<h3>{{ __('general.id') }}: {{ $item->id }}</h3>--}}
        <h5 class="card-title">{{ $item->getTranslation('name', app()->getLocale()) }}</h5>
        <p class="card-text">{{ __('general.type') }}: {{ Str::afterLast($modelName, '\\') }}</p>
        <p class="card-text">{{ __('general.deleted_at') }}: {{ $item->deleted_at }}</p>

        <div class="d-flex gap-2 flex-wrap">
            <form action="{{ route('trash.restore', ['model' => $modelName, 'id' => $item->id]) }}" method="post"
                  class="mb-3">
                @csrf

                <button type="submit" class="btn btn-primary shadow-none btn-sm">{{ __('general.restore') }}</button>
            </form>

            <form action="{{ route('trash.delete', ['model' => $modelName, 'id' => $item->id]) }}" method="post"
                  class="mb-3">
                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirmDelete('{{ __('general.are_you_sure') }}')"
                        class="btn btn-danger shadow-none btn-sm">{{ __('general.permanently_delete') }}</button>
            </form>
        </div>
    </div>
</div>
