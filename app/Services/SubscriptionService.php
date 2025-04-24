<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\SubscriptionUsage;
use App\Repositories\SubscriptionRepository;
use App\Repositories\SubscriptionUsageRepository;
use function dd;

class SubscriptionService
{

    protected $activeSubscription;
    public function __construct(
        protected subscriptionRepository $subscriptionRepository ,
        protected SubscriptionUsageRepository $subscriptionUsageRepository
    )
    {
        $this->activeSubscription = $this->subscriptionRepository->findActiveSubscriptionByUserId (auth()->id());

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

    public function updateSubscriptionUsage (array $data)
    {
        return $this->subscriptionUsageRepository->updateUsage(
            $this->activeSubscription->id,
            $data['platform'],
        );
    }

    public function hasRemainingUsage (string $platform)
    {
        $usage = $this->subscriptionUsageRepository->findUsageBySubscriptionAndPlatform(
            $this->activeSubscription->id,
            $platform
        );

        return $usage && ($usage->limit === 0 || $usage->used < $usage->limit);
    }
}
