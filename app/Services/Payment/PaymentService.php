<?php

namespace App\Services\Payment;

class PaymentService
{
    /**
     * Process a payment using the specified payment method and amount.
     *
     * @param string $paymentMethod The identifier of the payment method (e.g., 'paypal', 'stripe', etc.)
     * @param float $amount The amount to be charged.
     * @return mixed The result of the payment process (usually an object implementing a gateway-specific response).
     */
    public function charge($paymentMethod, $amount,$currency)
    {
        $gateway = PaymentGatewayFactory::make($paymentMethod);

        $paymentResult = $gateway->charge([
            'amount' => $amount,
            'currency' => $currency->name,
        ]);

        return $paymentResult;
    }

    /**
     * Determine if the payment was successful.
     *
     * @param mixed $paymentResult The result object returned from the payment gateway's charge method.
     * @return bool True if the payment succeeded, false otherwise.
     */
    public function isPaymentSuccessful($paymentResult)
    {
        return $paymentResult->isSuccessful();
    }
}
