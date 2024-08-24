<?php

return [
    'api_service' => env('WEATHER_FORECAST_SERVICE', 'weatherapi'),

    'apis' => [
        'weather_api' => [
            'api_key' => env('WEATHER_API_KEY'),
        ],
    ],
];
