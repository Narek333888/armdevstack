<?php

namespace App\Helpers;

class InputHelper
{
    /**
     * @param string|null $value
     * @return array|string|string[]
     */
    public static function filter(?string $value): array|string
    {
        $value = strip_tags($value);
        $value = stripcslashes($value);
        $value = str_replace('  ', ' ', $value);

        return $value;
    }

    /**
     * @param string $value
     * @return string
     */
    public static function stripTags(string $value): string
    {
        return strip_tags($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function stripSlashes(string $value): string
    {
        return stripcslashes($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function removeOddWhiteSpaces(string $value): string
    {
        return str_replace(' ', '', $value);
    }

    /**
     * @param string $value
     * @return string
     */
    public static function removeAllWhiteSpaces(string $value): string
    {
        return str_replace(' ', '', $value);
    }
}
