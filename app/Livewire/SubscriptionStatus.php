<?php

namespace App\Livewire;

use Livewire\Component;

class SubscriptionStatus extends Component
{
    public $subscribedPlan;

    public function mount()
    {
        $this->subscribedPlan = false;
    }
    public function render()
    {
        return view('livewire.subscription-status');
    }
}
