<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'iso2',
        'icon',
    ];

    public function subscriptionPlans ():HasMany
    {
        return $this->hasMany(SubscriptionPlan::class);
    }
}
