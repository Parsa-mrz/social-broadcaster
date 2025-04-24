<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubscriptionPlan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'currency_id',
        'interval',
        'features',
        'limits',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'limits' => 'array',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    public  function subscriptions (): HasMany
    {
         return $this->hasMany(Subscription::class);
    }
}
