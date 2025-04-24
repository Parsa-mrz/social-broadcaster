<?php

namespace App\Services;

use App\Repositories\SubscriptionRepository;

class SubscriptionService
{

    public function __construct(protected subscriptionRepository $subscriptionRepository)
    {
    }

    public function subscribe (array $data)
    {
        //todo: check no active subscription has
        $this->subscriptionRepository->createSubscription ($data);
    }
}
