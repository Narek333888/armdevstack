<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.delete_account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profile.once_your_account_is_deleted_all_of_its_resources_and_data_will_be_permanently_deleted') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">{{ __('profile.delete_account') }}</button>

    <div class="modal" id="confirm-user-deletion">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}" id="profileDeleteForm" class="p-6">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h2 class="modal-title text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('profile.are_you_sure_you_want_to_delete_your_account') }}
                        </h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('profile.once_your_account_is_deleted_all_of_its_resources_and_data_will_be_permanently_deleted_please_enter_your_password_to_confirm_you_would_like_to_permanently_delete_your_account') }}
                        </p>

                        <div class="mt-6">
                            <label for="password" class="form-label sr-only">{{ __('profile.password_input_label') }}</label>
                            <input type="password" id="password" name="password" class="form-control mt-1" placeholder="{{ __('profile.password_input_placeholder') }}" required>

                            <!-- Input error messages -->
                            {{--<div class="invalid-feedback mt-2">
                                @foreach ($errors as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>--}}
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cancel-btn" id="cancelProfileDeletionBtn" data-bs-dismiss="modal">{{ __('profile.cancel') }}</button>
                        <button type="submit" class="btn btn-danger ms-3">{{ __('profile.delete_account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $('#profileDeleteForm').validate({
            rules: {
                password: {
                    required: true,
                },
            },
            messages: {
                password: {
                    required: '{{ __('validation.required_password') }}',
                },
            }
        });

        cancel('#cancelProfileDeletionBtn', '#profileDeleteForm');
    </script>
@endpush
