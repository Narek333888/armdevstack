<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('profile.profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="p-4 bg-white dark:bg-gray-800 shadow-sm rounded">
                        <div class="max-w-xl">
                            @include('dashboard.admin.profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="p-4 bg-white dark:bg-gray-800 shadow-sm rounded">
                        <div class="max-w-xl">
                            @include('dashboard.admin.profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4 mb-4">
                    <div class="p-4 bg-white dark:bg-gray-800 shadow-sm rounded">
                        <div class="max-w-xl">
                            @include('dashboard.admin.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
