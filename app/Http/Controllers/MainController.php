<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class MainController extends Controller
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('dashboard.admin.home');
    }
}
