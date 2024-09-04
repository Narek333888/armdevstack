<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('css/custom.css') : asset('css/custom.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'css/custom.css' : 'css/custom.min.css')) }}">
    <link href="{{ App::environment('local') ? asset('dashboard/lib/fontawesome/css/all.css') : asset('dashboard/lib/fontawesome/css/all.min.css') }}?ver={{ App::environment('local') ? filemtime(public_path('dashboard/lib/fontawesome/css/all.css')) : filemtime(public_path('dashboard/lib/fontawesome/css/all.min.css')) }}" rel="stylesheet">
    <link href="{{ asset('lib/bootstrapicons/font/bootstrap-icons.min.css') }}?ver={{ filemtime(public_path('lib/bootstrapicons/font/bootstrap-icons.min.css')) }}" rel="stylesheet">
    <link href="{{ App::environment('local') ? asset('dashboard/lib/owlcarousel/assets/owl.carousel.css') : asset('dashboard/lib/owlcarousel/assets/owl.carousel.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/lib/owlcarousel/assets/owl.carousel.css' : 'dashboard/lib/owlcarousel/assets/owl.carousel.min.css')) }}" rel="stylesheet">
    <link href="{{ App::environment('local') ? asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.css') : asset('dashboard/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('dashboard/css/bootstrap.css') : asset('dashboard/css/bootstrap.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/css/bootstrap.css' : 'dashboard/css/bootstrap.min.css')) }}">
    <link href="{{ asset('lib/toastr/toastr.min.css') }}?ver={{ filemtime(public_path('lib/toastr/toastr.min.css')) }}" rel="stylesheet">
    <link href="{{ asset('lib/select2/css/select2.min.css') }}?ver={{ filemtime(public_path('lib/select2/css/select2.min.css')) }}" rel="stylesheet">
    <link href="{{ asset('lib/leaflet/leaflet.min.css') }}?ver={{ filemtime(public_path('lib/leaflet/leaflet.min.css')) }}" rel="stylesheet">
    <link rel="stylesheet"
          href="{{ App::environment('local') ? asset('dashboard/css/style.css') : asset('dashboard/css/style.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'dashboard/css/style.css' : 'dashboard/css/style.min.css')) }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>
    <x-app.dashboard.spinner></x-app.dashboard.spinner>

    <!-- Sidebar Start -->
    <x-app.dashboard.sidebar></x-app.dashboard.sidebar>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
        <x-app.dashboard.navbar></x-app.dashboard.navbar>

        <main>
            {{ $slot }}
        </main>

        {{--<x-app.dashboard.footer></x-app.dashboard.footer>--}}
    </div>
    <!-- Content End -->

    <!-- Back to Top -->
    {{--<x-app.dashboard.arrow-up-icon></x-app.dashboard.arrow-up-icon>--}}
</div>

<script src="{{ asset('lib/flowbite/flowbite.min.js') }}?ver={{ filemtime(public_path('lib/flowbite/flowbite.min.js')) }}"></script>
<script src="{{ asset('lib/pusher/pusher.min.js') }}?ver={{ filemtime(public_path('lib/pusher/pusher.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/jquery/jquery.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/jquery/jquery.min.js')) }}"></script>
<script src="{{ asset('lib/tinymce/js/tinymce/tinymce.min.js') }}?ver={{ filemtime(public_path('lib/tinymce/js/tinymce/tinymce.min.js')) }}"></script>
<script src="{{ asset('lib/axios/axios.min.js') }}?ver={{ filemtime(public_path('lib/axios/axios.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('js/custom.js') : asset('js/custom.min.js') }}?ver={{ filemtime(public_path(App::environment('local') ? 'js/custom.js' : 'js/custom.min.js')) }}"></script>
<script src="{{ asset('lib/toastr/toastr.min.js') }}?ver={{ filemtime(public_path('lib/toastr/toastr.min.js')) }}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}?ver={{ filemtime(public_path('lib/select2/js/select2.min.js')) }}"></script>
<script src="{{ asset('lib/leaflet/leaflet.js') }}?ver={{ filemtime(public_path('lib/leaflet/leaflet.js')) }}"></script>
<script src="{{ asset('lib/jqueryvalidation/jquery-validate.min.js') }}?ver={{ filemtime(public_path('lib/jqueryvalidation/jquery-validate.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/bootstrap/bootstrap.bundle.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/bootstrap/bootstrap.bundle.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/chart/chart.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/chart/chart.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('dashboard/lib/easing/easing.js') : asset('dashboard/lib/easing/easing.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/easing/easing.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/waypoints/waypoints.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/waypoints/waypoints.min.js')) }}"></script>
<script src="{{ App::environment() ? asset('dashboard/lib/owlcarousel/owl.carousel.js') : asset('dashboard/lib/owlcarousel/owl.carousel.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/owlcarousel/owl.carousel.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/tempusdominus/js/moment.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/moment.min.js')) }}"></script>
<script src="{{ asset('dashboard/lib/tempusdominus/js/moment-timezone.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/moment-timezone.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.js') : asset('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}?ver={{ filemtime(public_path('dashboard/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('dashboard/js/main.js') : asset('dashboard/js/main.min.js') }}?ver={{ App::environment('local') ? filemtime(public_path('dashboard/js/main.js')) : filemtime(public_path('dashboard/js/main.min.js')) }}"></script>

@stack('scripts')

@if(session('success'))
    <script>
        toastr.info('{{ session('success') }}');
    </script>
@elseif(session('fail'))
    <script>
        toastr.error('{{ session('fail') }}');
    </script>
@endif

<script>
    setupPusher('admin-channel', 'user-login', function(data, dynamicText) {
        let locale = '{{ app()->getLocale() }}';

        toastr.info(data.user.name[locale] + ' ' + dynamicText);
    }, '{{ config('broadcasting.connections.pusher.key') }}', '{{ __('general.logged_in') }}');
</script>
</body>
</html>
