<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthButton extends Component
{
    public $type;

    public function __construct($type = 'submit')
    {
        $this->type = $type;
    }

    public function render()
    {
        return view('components.auth-button');
    }
}