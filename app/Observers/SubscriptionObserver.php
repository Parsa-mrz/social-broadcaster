<?php

namespace App\Observers;

use App\Models\Subscription;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        $limits = $subscription->subscriptionPlan->limits;

        foreach ($limits as $limit) {
            $subscription->subscriptionUsages()->create([
                'platform' => $limit['social'],
                'limit' => $limit['limit_per_post'] ?? 0,
            ]);
        }
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
