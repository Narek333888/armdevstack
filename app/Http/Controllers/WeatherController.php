<?php

namespace App\Http\Controllers;

use App\DAL\Services\Weather\WeatherService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected WeatherService $weatherService;

    /**
     * @param WeatherService $weatherService
     */
    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @param Request $request
     * @return Renderable
     * @throws GuzzleException
     */
    public function showWeather(Request $request): Renderable
    {
        $city = $request->input('city', 'Yerevan');
        $weatherData = $this->weatherService->getCurrentWeather($city);

        return view('dashboard.admin.weather.show', compact('weatherData'));
    }
}
