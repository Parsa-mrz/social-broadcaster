<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'payment_gateway_id',
        'status',
        'total',
        'transaction_reference'
    ];
    public function user (): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function paymentGateway(): BelongsTo
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
