<?php

namespace App\Livewire;

use App\Services\Payment\PaymentService;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use function auth;

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

    public function subscribe (PaymentService $paymentService)
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

    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
