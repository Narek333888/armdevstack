<nav class="navbar front-navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('site.index') }}">{{ config('app.name') }}</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('site.index') }}">{{ __('general.navbar.home') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('general.navbar.pages') }}
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">{{ __('general.navbar.posts') }}</a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">{{ __('general.navbar.products') }}</a>
                        </li>
                        {{--<li><hr class="dropdown-divider"></li>--}}
                    </ul>
                </li>
            </ul>

            <div class="front-navbar-login-form-content">
                <form method="get" class="d-flex login-form front-navbar-login-form" role="search">
                    <input class="form-control me-2"
                           name="query"
                           type="search"
                           placeholder="{{ __('general.search') }}"
                           aria-label="{{ __('general.search') }}"
                           autocomplete="off"
                    >

                    <button class="btn btn-sm btn-outline-primary" type="submit">{{ __('general.navbar.search_button_text') }}</button>
                </form>
            </div>

            @if(!auth()->user() && !request()->routeIs('login'))
                <div class="ms-5">
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-success">{{ __('general.navbar.login_button_text') }}</a>
                </div>
            @endif
        </div>
    </div>
</nav>
