<?php

namespace App\Livewire;

use App\Repositories\SubscriptionPlanRepository;
use Filament\Notifications\Notification;
use Livewire\Component;
use function auth;

class PricingTable extends Component
{
    public $plans;
    public function mount (SubscriptionPlanRepository $subscriptionPlanRepository)
    {
        $this->plans = $subscriptionPlanRepository->all();
    }
    public function selectPlan($plan)
    {
        if(auth ()->user ()->hasActiveSubscription()){
            Notification::make()
                        ->title('You have already have an active subscription')
                        ->danger()
                        ->send();
            return;
        }
        $this->dispatch('planSelected', $plan);
    }

    public function render()
    {
        return view('livewire.pricing-table');
    }
}
