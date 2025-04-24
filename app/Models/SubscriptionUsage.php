<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionUsage extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionUsageFactory> */
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'platform',
        'limit'
    ];

    public function subscription (): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
