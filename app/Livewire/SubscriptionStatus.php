<?php

namespace App\Livewire;

use App\Repositories\SubscriptionRepository;
use Livewire\Component;

class SubscriptionStatus extends Component
{
    public $subscribedPlan;

    public function mount(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscribedPlan = $subscriptionRepository->findActiveSubscriptionByUserId (auth()->id ());
    }
    public function render()
    {
        return view('livewire.subscription-status');
    }
}
