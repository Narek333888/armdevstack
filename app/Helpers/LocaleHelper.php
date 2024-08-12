<?php

namespace App\Helpers;

class LocaleHelper
{
    /**
     * @param string $appLocale
     * @return string
     */
    public static function getNativeLocale(string $appLocale): string
    {
        $nativeLocale = 'en';

        if ($appLocale === 'en') $nativeLocale = 'English';
        elseif ($appLocale === 'ru') $nativeLocale = 'Русский';
        elseif ($appLocale === 'hy') $nativeLocale = 'Հայերեն';

        return $nativeLocale;
    }
}
