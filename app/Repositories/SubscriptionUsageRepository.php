<?php

namespace App\Repositories;

use App\Models\SubscriptionUsage;

class SubscriptionUsageRepository
{
    public function findUsageBySubscriptionAndPlatform(int $subscriptionId, string $platform)
    {
        return SubscriptionUsage::where([
            'subscription_id' => $subscriptionId,
            'platform' => $platform,
        ])->first();
    }

    public function updateUsage(int $subscriptionId, string $platform, int $increment = 1)
    {
        return SubscriptionUsage::where([
            'subscription_id' => $subscriptionId,
            'platform' => $platform,
        ])->increment('used', $increment);
    }

}
