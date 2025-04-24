<?php

namespace App\Filament\Widgets;

use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use function app;

class SubscriptionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $subscriptionRepository = app(SubscriptionRepository::class);
        $subscription = $subscriptionRepository->findActiveSubscriptionByUserId(Auth::id());

        $stats = [];

        if (!$subscription) {
            $stats[] = Stat::make('Subscription', 'No Active Plan')
                           ->description('Click below to purchase now')
                           ->color('danger')
                           ->extraAttributes([
                               'onclick' => "window.location.href='/dashboard/subscription'",
                               'style' => 'cursor: pointer; text-align: center;',
                           ])
                           ->value('No Active Plan');
        } else {
            $stats[] = Stat::make('Plan', $subscription->subscriptionPlan->name)
                           ->description('Active until ' . Carbon::parse($subscription->end_at)->format('Y-m-d'))
                           ->color('success');

            $subscriptionService = app(SubscriptionService::class);
            $usageStats = $subscriptionService->generateUsageStats($subscription);

            foreach ($usageStats as $usage) {
                $stats[] = Stat::make($usage['platform'], "{$usage['used']} / {$usage['limit']} Posts")
                               ->description("{$usage['remaining']} posts remaining")
                               ->color($usage['color']);
            }
        }


        return $stats;
    }
}
