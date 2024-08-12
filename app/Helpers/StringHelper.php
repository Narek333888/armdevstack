<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    /**
     * @param string $subject
     * @param string $search
     * @return string|null
     */
    public static function afterLast(string $subject, string $search): ?string
    {
        if ($search === '')
            return $subject;

        $parts = explode($search, $subject);

        $latestElement = end($parts);

        return $latestElement !== false ? $latestElement : null;
    }

    /**
     * @param $string
     * @param $replacement
     * @return string
     */
    public static function replaceLastItem($string, $replacement): string
    {
        $array = explode(' ', $string);
        $array[count($array) - 1] = $replacement;

        return implode(' ', $array);
    }

    /**
     * @param $string
     * @param $replacement
     * @param $symbol
     * @return string
     */
    public static function replaceLastItemAfterSymbol($string, $replacement, $symbol): string
    {
        $lastSymbolPos = strrpos($string, $symbol);

        if ($lastSymbolPos !== false)
        {
            $beforeLastSymbol = substr($string, 0, $lastSymbolPos + 1);

            return $beforeLastSymbol . $replacement;
        }

        return $string;
    }
}
