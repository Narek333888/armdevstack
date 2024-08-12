<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $type;
    public string $text = '';
    public string $bgColor = 'bg-green-100';
    public string $textColor = 'text-green-400';
    public string $closeBtnColor = 'text-green-400';

    /**
     * Create a new component instance.
     */
    public function __construct(string $type, string $text, string $bgColor, string $textColor, string $closeBtnColor)
    {
        $this->type = $type;
        $this->text = $text;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
        $this->closeBtnColor = $closeBtnColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
