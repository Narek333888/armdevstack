<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class DashboardLayout extends Component
{
    private ?string $title;

    public function __construct(string $title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.dashboard', [
            'title' => $this->title,
        ]);
    }
}
