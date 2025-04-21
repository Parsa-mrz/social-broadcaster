<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function createPayment (array $data): Payment
    {
        return Payment::create($data);
    }

    public function findPaymentsByUserId(int $userId): ?Payment
    {
        return Payment::where('user_id', $userId)->get();
    }
}
