<x-dashboard-layout title="{{ $title = 'Permission|Edit' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('permissions.edit.edit_permission') }} - {{ $permission->name }}</h6>

            <form method="post" action="{{ route('permission.update', $permission->id) }}" id="permissionUpdateForm" class="w-full">
                @csrf
                @method('PATCH')

                <input type="hidden" name="page" value="{{ session('permission_edit_page', 1) }}">

                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           placeholder="{{ __('permissions.create.name_input_placeholder') }}"
                           autocomplete="off"
                           value="{{ $permission->name ?? old('name') }}"
                    >
                    <label for="name">{{ __('permissions.create.name_input_label') }}</label>

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <a href="{{ route('permission.index') }}" class="btn btn-secondary btn-sm">
                        {{ __('permissions.create.go_back') }}
                    </a>

                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('permissions.edit.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>

        </script>
    @endpush
</x-dashboard-layout>
