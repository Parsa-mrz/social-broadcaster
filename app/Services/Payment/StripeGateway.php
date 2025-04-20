<?php

namespace App\Services\Payment;

use function uniqid;

class StripeGateway implements PaymentGatewayInterface
{
    protected $transactionStatus;
    public function charge ( array $data ): mixed
    {
        // Simulate Stripe transaction (failed in this case)
        $this->transactionStatus = false;
        return $this;
    }

    public function getTransactionReference (): string
    {
        return 'stripe_' . uniqid('txn_', true);
    }

    public function isSuccessful (): bool
    {
        return $this->transactionStatus === true;
    }
}
