<?php

namespace App\Services\WeatherForecast\Interfaces;

interface IWeatherForecastService
{
    public function getCurrentWeather(array $data): mixed;
}
