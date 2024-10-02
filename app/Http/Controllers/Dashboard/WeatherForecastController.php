<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeatherForecast\WeatherApiRequest;
use App\Services\WeatherForecast\Interfaces\IWeatherForecastService;
use Illuminate\Contracts\Support\Renderable;

class WeatherForecastController extends Controller
{
    protected IWeatherForecastService $weatherService;

    /**
     * @param IWeatherForecastService $weatherService
     */
    public function __construct(IWeatherForecastService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * @return Renderable
     */
    public function show(): Renderable
    {
        $weatherData = $this->weatherService->getCurrentWeather([]);

        return view('dashboard.admin.weather.show', compact('weatherData'));
    }

    /**
     * @param WeatherApiRequest $request
     * @return Renderable|array|null
     */
    public function fetchData(WeatherApiRequest $request): Renderable|array|null
    {
        return $this->weatherService->getCurrentWeather($request->validated());
    }

    /**
     * @param string $key
     * @return void
     */
    public function clearCache(string $key): void
    {
        $this->weatherService->clearCache($key);
    }
}
