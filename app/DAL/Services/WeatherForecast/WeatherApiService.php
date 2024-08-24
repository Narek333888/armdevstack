<?php

namespace App\DAL\Services\WeatherForecast;

use App\DAL\Services\WeatherForecast\Interfaces\IWeatherForecastService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class WeatherApiService implements IWeatherForecastService
{
    protected Client $client;
    protected string $apiKey;
    protected string $baseUri;

    public function __construct()
    {
        $this->client = new Client;

        $this->apiKey = config('weather-forecast.apis.weather_api.api_key');
        $this->baseUri = 'http://api.weatherapi.com/v1/';
    }

    /**
     * @param array $data
     * @return array|null
     */
    public function getCurrentWeather(array $data): array|null
    {
        $city = $data['city'] ?? 'Yerevan';
        $cacheKey = "weather_{$city}";

        $unitOfMeasurement = $data['unitOfMeasurement'] ?? 'celsius';

        return Cache::remember($cacheKey, 1800, function () use ($city, $unitOfMeasurement)
        {
            try
            {
                $response = $this->client->request('GET', $this->baseUri . 'current.json', [
                    'query' => [
                        'key' => $this->apiKey,
                        'q' => $city,
                    ],
                ]);

                $responseData = json_decode($response->getBody()->getContents(), true);

                return [
                    'temperature' => $unitOfMeasurement === 'celsius'
                        ? $responseData['current']['temp_c'] . '°C'
                        : $responseData['current']['temp_f'] . '°F',
                    'feelsLike' => $unitOfMeasurement === 'celsius'
                        ? $responseData['current']['feelslike_c'] . '°C'
                        : $responseData['current']['feelslike_f'] . '°F',
                    'locationName' => $responseData['location']['name'],
                    'locationCountry' => $responseData['location']['country'],
                    'conditionText' => $responseData['current']['condition']['text'],
                    'windSpeed' => $responseData['current']['wind_mph'],
                    'humidity' => $responseData['current']['humidity'],
                    'conditionIcon' => $responseData['current']['condition']['icon'],
                    'unitOfMeasurement' => $unitOfMeasurement,
                    'celsiusChecked' => $unitOfMeasurement === 'celsius' ? 'checked' : '',
                    'farenheitChecked' => $unitOfMeasurement === 'farenheit' ? 'checked' : '',
                ];
            }
            catch (Exception $exception)
            {
                return null;
            }
        });
    }

    /**
     * @param string $city
     * @return void
     */
    public function clearCache(string $city): void
    {
        Cache::forget('weather_' . $city);
    }
}
