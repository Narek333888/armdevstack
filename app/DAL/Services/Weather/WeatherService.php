<?php

namespace App\DAL\Services\Weather;

use App\DAL\Services\Weather\Interfaces\IWeatherService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WeatherService implements IWeatherService
{
    protected Client $client;
    protected string $apiKey;
    protected string $baseUri;

    public function __construct()
    {
        $this->client = new Client;

        $this->apiKey = config('weather.weather_api.weather_api_key');
        $this->baseUri = 'http://api.weatherapi.com/v1/';
    }

    /**
     * @param string $city
     * @return mixed
     * @throws GuzzleException
     */
    public function getCurrentWeather(string $city): mixed
    {
        $response = $this->client->request('GET', $this->baseUri . 'current.json', [
            'query' => [
                'key' => $this->apiKey,
                'q' => $city,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
