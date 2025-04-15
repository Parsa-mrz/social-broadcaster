<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    #[Title('Register')]
    public function render()
    {
        return view('livewire.register');
    }
}
