<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ route('main.index') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">{{ config('app.name') }}</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('dashboard/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <x-nav-link
                href="{{ route('main.index') }}"
                :active="request()->routeIs('main.index')"
            >
                {{ config('app.name') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('user.index') }}"
                :active="request()->routeIs('user.*')"
            >
                {{ __('navigation.users') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('role.index') }}"
                :active="request()->routeIs('role.*')"
            >
                {{ __('navigation.roles') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('permission.index') }}"
                :active="request()->routeIs('permission.*')"
            >
                {{ __('navigation.permissions') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('post-category.index') }}"
                :active="request()->routeIs('post-category.*')"
            >
                {{ __('navigation.post_categories') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('post.index') }}"
                :active="request()->routeIs('post.*')"
            >
                {{ __('posts.posts') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('product-category.index') }}"
                :active="request()->routeIs('product-category.*')"
            >
                {{ __('product-categories.product_categories') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('product.index') }}"
                :active="request()->routeIs('product.*')"
            >
                {{ __('products.products') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('weather.show') }}"
                :active="request()->routeIs('weather.*')"
            >
                {{ __('weather.weather') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('mailer-settings.index') }}"
                :active="request()->routeIs('mailer-settings.*')"
            >
                {{ __('navigation.mailer_settings') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('chat') }}"
                :active="request()->routeIs('chat')"
            >
                {{ __('navigation.chat') }}
            </x-nav-link>

            <x-nav-link
                href="{{ route('trash.index') }}"
                :active="request()->routeIs('trash.*')"
            >
                {{ __('navigation.trash') }}
            </x-nav-link>
        </div>
    </nav>
</div>
