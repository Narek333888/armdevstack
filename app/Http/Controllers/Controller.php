<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

abstract class Controller implements HasMiddleware
{
    /**
     * @return array|Middleware[]
     */
    public static function middleware(): array
    {
        return [];
    }
}
