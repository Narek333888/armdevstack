<?php

namespace App\DAL\Services\WeatherForecast\Interfaces;

interface IWeatherForecastService
{
    public function getCurrentWeather(array $data): mixed;
}
