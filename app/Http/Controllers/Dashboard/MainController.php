<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
