<?php

namespace App\Livewire;

use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;
use Livewire\Component;

class SubscriptionStatus extends Component
{
    public $plan;
    public $usageStats;

    public function mount(SubscriptionRepository $subscriptionRepository,SubscriptionService $subscriptionService)
    {
        $this->plan = $subscriptionRepository->findActiveSubscriptionByUserId (auth()->id ());
        if($this->plan){
            $this->usageStats = $subscriptionService->generateUsageStats ($this->plan);
        }
    }
    public function render()
    {
        return view('livewire.subscription-status');
    }
}
