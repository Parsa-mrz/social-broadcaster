<?php

namespace App\Services\Payment;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Models\PaymentGateway;
use App\Repositories\PaymentRepository;

class PaymentService
{
    public function __construct (protected PaymentGatewayFactory $paymentGatewayFactory, protected PaymentRepository $paymentRepository)
    {

    }

    /**
     * Processes a payment using the specified gateway.
     *
     * @param string $gateway The payment gateway to use (e.g., 'stripe', 'paypal', 'cod').
     * @param array $data Payment data (e.g., amount, currency, card details).
     *
     * @return array Transaction details including reference and status.
     *
     * @throws \Exception If the payment gateway is unsupported or payment fails.
     */
    public function processPayment(string $gateway, array $data) : array|Payment
    {
        $gatewayRecord = PaymentGateway::where('name', $gateway)
                                                   ->where('status', true)
                                                   ->first();

        if(!$gatewayRecord) {
            return [
                'status' => false,
                'message' => 'Payment gateway is deactivated'
            ];
        }

        // Create the payment gateway instance
        $paymentGateway = $this->paymentGatewayFactory->make($gateway);

        // Process the charge
        $paymentGateway->charge($data);

        $payment = $this->paymentRepository->createPayment ([
            'user_id' => auth()->id(),
            'payment_gateway_id' => $gatewayRecord->id,
            'total' => $data['total'],
        ]);

        // Check if the transaction was successful
        if (!$paymentGateway->isSuccessful()) {
            $payment->update(['status' => PaymentStatusEnum::FAILED->value]);
            return [
                'status' => false,
                'message' => 'Payment was not successful'
            ];
        }


        $payment->update ([
            'status' => PaymentStatusEnum::SUCCESS->value,
            'transaction_reference' => $paymentGateway->getTransactionReference(),
        ]);

        return [
            'status' => true,
            'message' => 'Payment was successful'
        ];
    }
}
