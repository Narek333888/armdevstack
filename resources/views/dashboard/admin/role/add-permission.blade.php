<x-dashboard-layout title="{{ $title = 'Role|Give Permission' }}">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('roles.role') }}: {{ $role->name }}
                            <a href="{{ route('role.index') }}" class="btn btn-secondary float-end shadow-none">{{ __('general.back') }}</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('role.give-permission-to-role', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <label for="name">{{ __('permissions.permissions') }}</label>

                                <div class="row mt-3">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-4">
                                            <label for="permission-{{ $permission->id }}">
                                                <input type="checkbox"
                                                       id="permission-{{ $permission->id }}" name="permission[]"
                                                       value="{{ $permission->name }}"
                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                >

                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-info shadow-none">{{ __('general.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')

    @endpush
</x-dashboard-layout>
