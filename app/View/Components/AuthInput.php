<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthInput extends Component
{
    public $type;
    public $name;
    public $placeholder;
    public $icon;

    public function __construct($type = 'text', $name, $placeholder, $icon)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.auth-input');
    }
}