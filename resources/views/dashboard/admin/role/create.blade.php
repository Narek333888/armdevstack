<x-dashboard-layout title="{{ $title = 'Role|Create' }}">
    <div class="mt-1 p-3 col-sm-12 col-xl-12 col-lg-12 col-md-12">
        <div class="bg-light_ rounded h-100 p-4">
            <h6 class="mb-4">{{ __('roles.create.create_new_role') }}</h6>

            <form method="post" action="{{ route('role.store') }}" id="roleCreateForm" class="w-full">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           name="name"
                           id="name"
                           placeholder="{{ __('roles.create.name_input_placeholder') }}"
                           autocomplete="off"
                           value="{{ old('name') }}"
                    >
                    <label for="name">{{ __('roles.create.name_input_label') }}</label>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <a href="{{ route('role.index') }}" class="btn btn-secondary btn-sm">
                        {{ __('roles.create.go_back') }}
                    </a>

                    <button class="btn btn-primary btn-sm" type="submit">
                        {{ __('roles.create.create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')

    @endpush
</x-dashboard-layout>
