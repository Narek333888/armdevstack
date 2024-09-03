@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Permission|Index'">
    <!-- Table Start -->
    <div class="container-fluid permissions-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('permission.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('permissions.create_new') }}
                    </a>

                    @if(count($permissions))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedPermissionsBtn">
                            {{ __('permissions.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedPermissionsBtn">
                            {{ __('permissions.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllPermissionsBtn">
                            {{ __('permissions.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllPermissionsBtn">
                            {{ __('permissions.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('permissions.permissions') }}</h6>

                    <div class="table-responsive permissions-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('permissions.name') }}</th>
                                <th scope="col">{{ __('permissions.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $key => $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ permission-checkbox"
                                               id="permissionCheckBox_{{ $permission->id }}"
                                               value="{{ $permission->id }}"
                                        >
                                    </td>

                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->created_at_diff }}</td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('permissions.edit_icon_link_title') }}"
                                                   href="{{ route('permission.edit', ['id' => $permission->id, 'page' => $permissions->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('permission.soft-delete', $permission->id) }}" id="permissionSoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('permissions.alert.are_you_sure') }}')"
                                                            title="{{ __('permissions.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('permission.delete', $permission->id) }}" id="permissionDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('permissions.alert.are_you_sure') }}')"
                                                            title="{{ __('permissions.delete_icon_link_title') }}">
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
            {{ $permissions->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const permissionsMessages = {
                confirm: '{{ __('permissions.alert.are_you_sure') }}',
                success: '{{ __('permissions.alert.deleted_successfully') }}',
                error: '{{ __('permissions.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('permissions.alert.please_select_at_least_one_permission_to_delete') }}',
            };

            deleteMultiple('{{ route("permission.delete-multiple") }}', '#deleteSelectedPermissionsBtn', '.permission-checkbox', permissionsMessages);
            softDeleteMultiple('{{ route("permission.soft-delete-multiple") }}', '#softDeleteSelectedPermissionsBtn', '.permission-checkbox', permissionsMessages);
            deleteAll('{{ route("permission.delete-all") }}', '#deleteAllPermissionsBtn', permissionsMessages);
            softDeleteAll('{{ route("permission.soft-delete-all") }}', '#softDeleteAllPermissionsBtn', permissionsMessages);
        </script>
    @endpush
</x-dashboard-layout>
