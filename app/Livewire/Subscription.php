<?php

namespace App\Livewire;

use Livewire\Component;

class Subscription extends Component
{
    public $selectedPlan = null;

    protected $listeners = ['planSelected'];

    public function planSelected($plan)
    {
        $this->selectedPlan = $plan;
    }

    public function render()
    {
        return view('livewire.subscription');
    }
}
