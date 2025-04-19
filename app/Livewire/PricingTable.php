<?php

namespace App\Livewire;

use App\Repositories\SubscriptionPlanRepository;
use Livewire\Component;

class PricingTable extends Component
{
    public $plans;
    public function mount (SubscriptionPlanRepository $subscriptionPlanRepository)
    {
        $this->plans = $subscriptionPlanRepository->all();
    }
    public function selectPlan($plan)
    {
        $this->dispatch('planSelected', $plan);
    }

    public function render()
    {
        return view('livewire.pricing-table');
    }
}
