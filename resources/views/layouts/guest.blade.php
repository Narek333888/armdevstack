<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicons/favicon4.png') }}">
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('css/custom.css') : asset('css/custom.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'css/custom.css' : 'css/custom.min.css')) }}">
    <link href="{{ App::environment('local') ? asset('lib/fontawesome/css/all.css') : asset('lib/fontawesome/css/all.min.css') }}?ver={{ App::environment('local') ? filemtime(public_path('lib/fontawesome/css/all.css')) : filemtime(public_path('lib/fontawesome/css/all.min.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ App::environment('local') ? asset('lib/bootstrap/css/bootstrap.css') : asset('lib/bootstrap/css/bootstrap.min.css') }}?ver={{ filemtime(public_path(App::environment('local') ? 'lib/bootstrap/css/bootstrap.css' : 'lib/bootstrap/css/bootstrap.min.css')) }}">
    <link href="{{ asset('lib/toastr/toastr.min.css') }}?ver={{ filemtime(public_path('lib/toastr/toastr.min.css')) }}" rel="stylesheet">
    <link href="{{ asset('lib/select2/css/select2.min.css') }}?ver={{ filemtime(public_path('lib/select2/css/select2.min.css')) }}" rel="stylesheet">
    <link href="{{ asset('lib/leaflet/leaflet.min.css') }}?ver={{ filemtime(public_path('lib/leaflet/leaflet.min.css')) }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @stack('styles')
</head>
<body>
<div>
    <!-- Content Start -->
    <div class="content">
        <x-app.frontend.navbar></x-app.frontend.navbar>

        <main>
            {{ $slot }}
        </main>

        <x-app.frontend.footer></x-app.frontend.footer>
    </div>
    <!-- Content End -->
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('lib/pusher/pusher.min.js') }}?ver={{ filemtime(public_path('lib/pusher/pusher.min.js')) }}"></script>
<script src="{{ asset('lib/jquery/jquery.min.js') }}?ver={{ filemtime(public_path('lib/jquery/jquery.min.js')) }}"></script>
<script src="{{ asset('lib/tinymce/js/tinymce/tinymce.min.js') }}?ver={{ filemtime(public_path('lib/tinymce/js/tinymce/tinymce.min.js')) }}"></script>
<script src="{{ asset('lib/axios/axios.min.js') }}?ver={{ filemtime(public_path('lib/axios/axios.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('js/custom.js') : asset('js/custom.min.js') }}?ver={{ filemtime(public_path(App::environment('local') ? 'js/custom.js' : 'js/custom.min.js')) }}"></script>
<script src="{{ asset('lib/toastr/toastr.min.js') }}?ver={{ filemtime(public_path('lib/toastr/toastr.min.js')) }}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}?ver={{ filemtime(public_path('lib/select2/js/select2.min.js')) }}"></script>
<script src="{{ asset('lib/leaflet/leaflet.js') }}?ver={{ filemtime(public_path('lib/leaflet/leaflet.js')) }}"></script>
<script src="{{ asset('lib/jqueryvalidation/jquery-validate.min.js') }}?ver={{ filemtime(public_path('lib/jqueryvalidation/jquery-validate.min.js')) }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}?ver={{ filemtime(public_path('lib/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}?ver={{ filemtime(public_path('lib/tempusdominus/js/moment.min.js')) }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}?ver={{ filemtime(public_path('lib/tempusdominus/js/moment-timezone.min.js')) }}"></script>
<script src="{{ App::environment('local') ? asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.js') : asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}?ver={{ filemtime(public_path('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')) }}"></script>

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
</body>
</html>
