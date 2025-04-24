<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function createSubscription (array $data):Subscription
    {
        return Subscription::create($data);
    }

    public function findActiveSubscriptionByUserId (int $userId): ?Subscription
    {
        return Subscription::with('subscriptionPlan')->where([
            'user_id' => $userId,
            'status' => true
        ])->first();
    }
}
