<?php

namespace App\Helpers;

class DateTimeHelper
{
    /**
     * @param string $localTime
     * @param string $format
     * @return string|null
     */
    public static function formatLocalTime(string $localTime, string $format = 'H:i'): ?string
    {
        $dateTime = date_create_from_format('Y-m-d H:i', $localTime);

        if ($dateTime === false)
            return null;

        return $dateTime->format($format);
    }
}
