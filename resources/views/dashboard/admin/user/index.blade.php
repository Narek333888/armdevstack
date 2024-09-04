@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'User|Index'">
    <!-- Table Start -->
    <div class="container-fluid users-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('users.create_new') }}
                    </a>

                    @if(count($users))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedUsersBtn">
                            {{ __('users.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedUsersBtn">
                            {{ __('users.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllUsersBtn">
                            {{ __('users.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllUsersBtn">
                            {{ __('users.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('users.users') }}</h6>

                    <div class="table-responsive users-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('users.name') }}</th>
                                <th scope="col">{{ __('users.email') }}</th>
                                <th scope="col">{{ __('roles.roles') }}</th>
                                <th scope="col">{{ __('users.index.active') }}</th>
                                <th scope="col">{{ __('users.created_at') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ user-checkbox"
                                               id="userCheckBox_{{ $user->id }}"
                                               value="{{ $user->id }}"
                                        >
                                    </td>

                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->getTranslation('name', app()->getLocale()) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $roleName)
                                                <div class="badge bg-info">
                                                    {{ $roleName }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $user->active_status ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>{{ $user->created_at_diff }}</td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-primary btn-sm"
                                                   title="{{ __('users.view_icon_link_title') }}"
                                                   href="{{ route('user.show', $user->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('users.edit_icon_link_title') }}"
                                                   href="{{ route('user.edit', ['id' => $user->id, 'page' => $users->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('user.soft-delete', $user->id) }}" id="userSoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('users.alert.are_you_sure') }}')"
                                                            title="{{ __('users.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('user.delete', $user->id) }}" id="userDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('users.alert.are_you_sure') }}')"
                                                            title="{{ __('users.delete_icon_link_title') }}">
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
            {{ $users->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const usersMessages = {
                confirm: '{{ __('users.alert.are_you_sure') }}',
                success: '{{ __('users.alert.deleted_successfully') }}',
                error: '{{ __('users.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('users.alert.please_select_at_least_one_user_to_delete') }}',
            };

            deleteMultiple('{{ route("user.delete-multiple") }}', '#deleteSelectedUsersBtn', '.user-checkbox', usersMessages);
            softDeleteMultiple('{{ route("user.soft-delete-multiple") }}', '#softDeleteSelectedUsersBtn', '.user-checkbox', usersMessages);
            deleteAll('{{ route("user.delete-all") }}', '#deleteAllUsersBtn', usersMessages);
            softDeleteAll('{{ route("user.soft-delete-all") }}', '#softDeleteAllUsersBtn', usersMessages);
        </script>
    @endpush
</x-dashboard-layout>
