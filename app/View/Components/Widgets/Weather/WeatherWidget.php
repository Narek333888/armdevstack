<?php

namespace App\View\Components\Widgets\Weather;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherWidget extends Component
{
    public mixed $weatherData;

    /**
     * Create a new component instance.
     *
     * @param mixed $weatherData
     */
    public function __construct(mixed $weatherData)
    {
        $this->weatherData = $weatherData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.weather.weather-widget');
    }
}
