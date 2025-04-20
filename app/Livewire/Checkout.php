<?php

namespace App\Livewire;

use App\Repositories\SubscriptionPlanRepository;
use Livewire\Component;

class Checkout extends Component
{
    public $selectedPlan;

    public function mount($selectedPlan)
    {
        $this->selectedPlan = $selectedPlan;
    }

    public function cancel()
    {
        $this->dispatch('planSelected', null);
    }

    public function subscribe ()
    {
        //implement payment
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
