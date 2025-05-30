<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentGateway extends Model
{
    protected  $fillable = [
        'name',
        'status',
    ];

    public function payments (): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
