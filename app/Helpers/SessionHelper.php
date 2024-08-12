<?php

namespace App\Helpers;

class SessionHelper
{
    /**
     * @param string|array $key
     * @param string $value
     * @return void
     */
    public static function setValue(string|array $key, mixed $value = null): void
    {
        session()->put($key, $value);
    }

    /**
     * @param string|array|null $key
     * @param mixed|null $default
     * @return string
     */
    public static function getValue(string|array|null $key = null, mixed $default = null): string
    {
        return session($key, $default);
    }
}
