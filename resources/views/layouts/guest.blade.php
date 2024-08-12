<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('css/custom.css') : asset('css/custom.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'css/custom.css' : 'css/custom.min.css')) }}">
    <!-- Icon Font Stylesheet -->
    <link href="{{ App::environment('local') ? asset('dashboard/lib/fontawesome/css/all.css') : asset('dashboard/lib/fontawesome/css/all.min.css') }}?ver={{ App::environment('local') ? filemtime(public_path('dashboard/lib/fontawesome/css/all.css')) : filemtime(public_path('dashboard/lib/fontawesome/css/all.min.css')) }}" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{ App::environment('local') ? asset('dashboard/lib/owlcarousel/assets/owl.carousel.css') : asset('dashboard/lib/owlcarousel/assets/owl.carousel.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/lib/owlcarousel/assets/owl.carousel.css' : 'dashboard/lib/owlcarousel/assets/owl.carousel.min.css')) }}" rel="stylesheet">
    <link href="{{ App::environment('local') ? asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.css') : asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('dashboard/css/bootstrap.css') : asset('dashboard/css/bootstrap.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/css/bootstrap.css' : 'dashboard/css/bootstrap.min.css')) }}">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('dashboard/css/style.css') : asset('dashboard/css/style.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/css/style.css' : 'dashboard/css/style.min.css')) }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>
        <div>
            <x-app.navbar></x-app.navbar>

            <div>
                {{ $slot }}
            </div>
        </div>

        <script src="{{ asset('lib/pusher/pusher.min.js') }}?ver={{ filemtime(public_path('lib/pusher/pusher.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/jquery/jquery.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/jquery/jquery.min.js')) }}"></script>
        <script src="{{ App::environment('local') ? asset('js/custom.js') : asset('js/custom.min.js') }}?ver={{ filemtime(public_path(App::environment('local') ? 'js/custom.js' : 'js/custom.min.js')) }}"></script>
        <script src="{{ asset('lib/jqueryvalidation/jquery-validate.min.js') }}?ver={{ filemtime(public_path('lib/jqueryvalidation/jquery-validate.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/bootstrap/bootstrap.bundle.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/bootstrap/bootstrap.bundle.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/chart/chart.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/chart/chart.min.js')) }}"></script>
        <script src="{{ App::environment('local') ? asset('dashboard/lib/easing/easing.js') : asset('dashboard/lib/easing/easing.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/easing/easing.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/waypoints/waypoints.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/waypoints/waypoints.min.js')) }}"></script>
        <script src="{{ App::environment() ? asset('dashboard/lib/owlcarousel/owl.carousel.js') : asset('dashboard/lib/owlcarousel/owl.carousel.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/owlcarousel/owl.carousel.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/tempusdominus/js/moment.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/moment.min.js')) }}"></script>
        <script src="{{ asset('dashboard/lib/tempusdominus/js/moment-timezone.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/moment-timezone.min.js')) }}"></script>
        <script src="{{ App::environment('local') ? asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.js') : asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')) }}"></script>
        <script src="{{ asset('lib/toastr/toastr.min.js') }}?ver={{ filemtime(public_path('lib/toastr/toastr.min.js')) }}"></script>
        <script src="{{ App::environment('local') ? asset('dashboard/js/main.js') : asset('dashboard/js/main.min.js') }}?ver={{ App::environment('local') ? filemtime(public_path('dashboard/js/main.js')) : filemtime(public_path('dashboard/js/main.min.js')) }}"></script>

        @stack('guest-scripts')
    </body>
</html>
