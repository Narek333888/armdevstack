<?php

namespace App\DAL\Services\Weather\Interfaces;

interface IWeatherService
{
    public function getCurrentWeather(string $city): mixed;
}
