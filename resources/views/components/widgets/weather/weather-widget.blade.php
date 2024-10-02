@php
    $currentUnitOfMeasurement = request('unitOfMeasurement');
    $celsiusCheckedCondition = request('unitOfMeasurement', 'celsius') === 'celsius' ? 'checked' : '';
    $farenheitCheckedCondition = request('unitOfMeasurement') === 'farenheit' ? 'checked' : '';
@endphp

<div>
    <h2 class="mb-4 pb-2 fw-normal">{{ __('weather.check_the_weather_forecast') }}</h2>

    <form class="weather-forecast-form weather-api-form" id="weatherApiForm" method="get" action="{{ route('weather.fetch') }}">
        <div class="input-group rounded">
            <input
                name="city"
                type="search"
                class="form-control weather-api-form-city rounded"
                placeholder="{{ __('weather.city') }}"
                aria-label="Search"
                aria-describedby="search-addon"
                autocomplete="off"
                value="{{ request('city', 'Yerevan') }}"
            />

            <button class="btn btn-secondary weather-check-button" id="weatherCheckButton" type="submit">
                {{ __('weather.check') }}
            </button>
        </div>

        @error('city')
            <span class="text-danger">{{ $message }}</span>
        @enderror

        <div class="mt-3 mb-4 pb-2">
            <div class="form-check form-check-inline">
                <input
                    class="form-check-input weather-api-form-celsius"
                    type="radio"
                    name="unitOfMeasurement"
                    id="celsius"
                    value="celsius"
                    {{ $celsiusCheckedCondition }}
                />

                <label
                    class="form-check-label"
                    for="celsius">
                    {{ __('weather.celsius') }}
                </label>
            </div>

            <div class="form-check form-check-inline">
                <input
                    class="form-check-input weather-api-form-unit-of-measurement"
                    type="radio"
                    name="unitOfMeasurement"
                    id="farenheit"
                    value="farenheit"
                    {{ $farenheitCheckedCondition }}
                />

                <label
                    class="form-check-label"
                    for="farenheit">
                    {{ __('weather.farenheit') }}
                </label>
            </div>
        </div>
    </form>

    <div class="weather-api-results" id="weatherResults">
        @if($weatherData)
            <div class="card text-body" style="border-radius: 25px;">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <h5 class="flex-grow-1"><span class="location-name weather-api-location-name">{{ $weatherData['locationName'] }}</span>, <span class="location-country weather-api-location-country">{{ $weatherData['locationCountry'] }}</span></h5>
                        {{--<h5>{{ \App\Helpers\DateTimeHelper::formatLocalTime($weatherData['location']['localtime']) }}</h5>--}}
                    </div>

                    <div class="d-flex flex-column mt-5 mb-4">
                        <h5 class="mb-0 font-weight-bold" style="color: #868B94">{{ __('weather.current_temperature') }}: <span class="current-temperature weather-api-current-temperature">{{ $weatherData['temperature'] }}</span></h5>
                        <h5 class="mb-0 font-weight-bold" style="color: #868B94">{{ __('weather.feels_like') }}: <span class="feels-like-temperature weather-api-feels-like-temperature">{{ $weatherData['feelsLike'] }}</span></h5>
                        <h5 class="weather-condition-text mt-3 condition-text weather-api-condition-text" style="color: #868B94">{{ $weatherData['conditionText'] }}</h5>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1" style="font-size: 1rem;">
                            <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"><span class="ms-1 wind-speed weather-api-wind-speed">{{ $weatherData['windSpeed'] }}</span>m/h</span>
                            </div>

                            <div><i class="fas fa-tint fa-fw" style="color: #868B94;"></i> <span class="ms-1 humidity weather-api-humidity">{{ $weatherData['humidity'] }}%</span></div>
                        </div>

                        <div>
                            <img class="condition-icon weather-api-condition-icon" src="{{ $weatherData['conditionIcon'] }}" width="100px" alt="Condition Icon">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h4 class="text-muted">
                {{ __('weather.no_matching_location_found') }}
            </h4>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        setDefaultQueryParam('city', 'Yerevan');

        handleRadioChange('unitOfMeasurement', (value) => {
            if (value === 'celsius') {
                updateQueryStringParam('unitOfMeasurement', 'celsius');
            }
            else if (value === 'farenheit') {
                updateQueryStringParam('unitOfMeasurement', 'farenheit');
            }

            clearWeatherCache('{{ config('app.url') }}' + '/{{ config('app.locale') }}' + '/dashboard/weather/clear-cache/' + getQueryParam('city'));
        });

        attachEvent('input', $('.weather-api-form-city'), () => {
            updateQueryStringParam('city', $('.weather-api-form-city').val());
        });

        fetchWeatherApiData('{{ route('weather.fetch') }}', 'get', '.weather-api-form', 'city', 'unitOfMeasurement', {
            locationName: { selector: '.weather-api-location-name', type: 'text' },
            locationCountry: { selector: '.weather-api-location-country', type: 'text' },
            temperature: { selector: '.weather-api-current-temperature', type: 'text' },
            feelsLike: { selector: '.weather-api-feels-like-temperature', type: 'text' },
            conditionText: { selector: '.weather-api-condition-text', type: 'text' },
            humidity: { selector: '.weather-api-humidity', type: 'text' },
            windSpeed: { selector: '.weather-api-wind-speed', type: 'text' },
            conditionIcon: { selector: '.weather-api-condition-icon', type: 'attribute', attribute: 'src' }
        });
    </script>
@endpush
