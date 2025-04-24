<?php

namespace App\Services;

use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;

class SubscriptionService
{

    public function __construct(protected subscriptionRepository $subscriptionRepository)
    {
    }

    public function subscribe (array $data)
    {
        $this->subscriptionRepository->createSubscription ($data);
    }

    public function generateUsageStats(Subscription $subscription)
    {
        $stats = [];

        foreach ($subscription->subscriptionUsages ?? [] as $usage) {
            $platform = ucfirst($usage->platform);
            $used = $usage->used;
            $limit = $usage->limit;

            if ($limit == 0) {
                $limitDisplay = '∞';
                $remaining = '∞';
                $color = 'success';
            } else {
                $limitDisplay = $limit;
                $remaining = max(0, $limit - $used);
                $percentageUsed = ($used / $limit) * 100;
                $color = $percentageUsed >= 90 ? 'danger' : ($percentageUsed >= 70 ? 'warning' : 'success');
            }

            $stats[] = [
                'platform' => $platform,
                'used' => $used,
                'limit' => $limitDisplay,
                'remaining' => $remaining,
                'color' => $color,
            ];
        }

        return $stats;
    }
}
