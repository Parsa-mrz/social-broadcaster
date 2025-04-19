<?php

namespace App\Repositories;

use App\Models\SubscriptionPlan;

class SubscriptionPlanRepository
{
    public function all(){
        return SubscriptionPlan::with('currency')->get();
    }
}
