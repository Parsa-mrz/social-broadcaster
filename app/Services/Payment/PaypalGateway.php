<?php

namespace App\Services\Payment;

use function uniqid;

class PaypalGateway implements PaymentGatewayInterface
{
    protected $transactionStatus;
    public function charge ( array $data ): mixed
    {
        $this->transactionStatus = true;
        return $this;
    }

    public function getTransactionReference (): string
    {
        return 'paypal_' . uniqid('txn_', true);
    }

    public function isSuccessful (): bool
    {
        return $this->transactionStatus  === true;
    }
}
