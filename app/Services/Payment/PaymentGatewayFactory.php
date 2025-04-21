<?php

namespace App\Services\Payment;

use App\Enums\PaymentGatewayEnum;

class PaymentGatewayFactory
{
    /**
     * Creates an instance of a specific payment gateway based on the provided gateway name.
     *
     * @param string $gateway The name of the payment gateway (e.g., 'stripe', 'paypal', 'cod').
     *
     * @return PaymentGatewayInterface The corresponding payment gateway instance.
     *
     * @throws \Exception If the payment gateway is unsupported.
     */
    public function make(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            PaymentGatewayEnum::STRIPE->value => new StripeGateway(),
            PaymentGatewayEnum::PAYPAL->value => new PaypalGateway(),
            PaymentGatewayEnum::COD->value    => new CodGateway(),
            default => throw new \Exception("Unsupported Payment Gateway: $gateway"),
        };
    }
}
