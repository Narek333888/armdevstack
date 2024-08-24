<x-dashboard-layout title="{{ $title = 'Weather|Show' }}">
    <div class="container">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-12 col-sm-12 col-lg-10">
                <x-widgets.weather.weather-widget
                    :weather-data="$weatherData ?? []"
                >
                </x-widgets.weather.weather-widget>
            </div>
        </div>
    </div>
</x-dashboard-layout>
