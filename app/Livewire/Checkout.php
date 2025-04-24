<?php

namespace App\Livewire;

use App\Services\Payment\PaymentService;
use App\Services\SubscriptionService;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function auth;
use function dd;

class Checkout extends Component
{
    public $selectedPlan;
    public $paymentMethod;

    public function mount($selectedPlan)
    {
        $this->selectedPlan = $selectedPlan;
    }

    public function cancel()
    {
        $this->dispatch('planSelected', null);
    }

    public function subscribe (PaymentService $paymentService, SubscriptionService $subscriptionService)
    {
        $result = $paymentService->processPayment ($this->paymentMethod,[
            'user' => auth()->user(),
            'plan' => $this->selectedPlan,
            'paymentMethod' => $this->paymentMethod,
            'total' =>$this->selectedPlan['price']
        ]);
        $notification = Notification::make()
                                    ->title($result['status'] ? 'Payment Successful' : 'Payment Failed')
                                    ->body($result['message']);

        $result['status'] ? $notification->success() : $notification->danger();

        $notification->send();

        if ($result['status']) {
            $payment = $result['payment'];
            $subscriptionService->subscribe ([
                'user_id' => auth()->id(),
                'payment_id' => $payment->id,
                'subscription_plan_id' => $this->selectedPlan['id'],
                'end_at' => $this->selectedPlan['interval'] === 'yearly'
                    ? now()->addYear()
                    : now()->addMonth(),
            ]);
            $this->redirect(route('filament.admin.pages.dashboard'));
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
