<?php

namespace App\Services\Payment;

use function uniqid;

class CodGateway
{
    /**
     * @var bool The status of the transaction.
     */
    protected $transactionStatus;

    /**
     * Charges the customer using the provided data (no actual payment processing in COD).
     *
     * @param array $data The data required for the transaction (e.g., customer info, amount, etc.).
     *
     * @return mixed The current instance of the CodGateway (for method chaining).
     */
    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function charge ( array $data ): mixed
    {
        // Simulate successful COD transaction
        $this->transactionStatus = true;
        return $this;
    }

    /**
     * Retrieves the transaction reference for the COD transaction.
     *
     * @return string A unique transaction reference, prefixed with "cod_".
     */
    public function getTransactionReference (): string
    {
        return 'cod_' . uniqid('txn_', true);
    }

    /**
     * Determines if the transaction was successful.
     *
     * @return bool True if the transaction was successful, false otherwise.
     */
    public function isSuccessful (): bool
    {
        return $this->transactionStatus === true;
    }
}
