@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Role|Index'">
    <!-- Table Start -->
    <div class="container-fluid roles-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('roles.create_new') }}
                    </a>

                    @if(count($roles))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedRolesBtn">
                            {{ __('roles.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedRolesBtn">
                            {{ __('roles.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllRolesBtn">
                            {{ __('roles.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllRolesBtn">
                            {{ __('roles.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('roles.roles') }}</h6>

                    <div class="table-responsive roles-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('roles.name') }}</th>
                                <th scope="col">{{ __('roles.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ role-checkbox"
                                               id="roleCheckBox_{{ $role->id }}"
                                               value="{{ $role->id }}"
                                        >
                                    </td>

                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->created_at_diff }}</td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-success btn-sm shadow-none"
                                                   href="{{ route('role.add-permission-to-role', $role->id) }}">
                                                    {{ __('roles.add_edit_role_permission') }}
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('roles.edit_icon_link_title') }}"
                                                   href="{{ route('role.edit', ['id' => $role->id, 'page' => $roles->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('role.soft-delete', $role->id) }}" id="roleSoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('roles.alert.are_you_sure') }}')"
                                                            title="{{ __('roles.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('role.delete', $role->id) }}" id="roleDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('roles.alert.are_you_sure') }}')"
                                                            title="{{ __('roles.delete_icon_link_title') }}">
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
            {{ $roles->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const rolesMessages = {
                confirm: '{{ __('roles.alert.are_you_sure') }}',
                success: '{{ __('roles.alert.deleted_successfully') }}',
                error: '{{ __('roles.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('roles.alert.please_select_at_least_one_role_to_delete') }}',
            };

            deleteMultiple('{{ route("role.delete-multiple") }}', '#deleteSelectedRolesBtn', '.role-checkbox', rolesMessages);
            softDeleteMultiple('{{ route("role.soft-delete-multiple") }}', '#softDeleteSelectedRolesBtn', '.role-checkbox', rolesMessages);
            deleteAll('{{ route("role.delete-all") }}', '#deleteAllRolesBtn', rolesMessages);
            softDeleteAll('{{ route("role.soft-delete-all") }}', '#softDeleteAllRolesBtn', rolesMessages);
        </script>
    @endpush
</x-dashboard-layout>
