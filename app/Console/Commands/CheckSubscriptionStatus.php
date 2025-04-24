<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckSubscriptionStatus extends Command
{
    protected $signature = 'subscriptions:check-status';
    protected $description = 'Check subscription status and update if expired';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->line('Starting subscription status check...');
            $this->line('Time Now: ' . now());

            $subscriptions = Subscription::with('subscriptionUsages')
                                         ->where('status', true)
                                         ->get();

            if ($subscriptions->isEmpty()) {
                $this->line('No active subscriptions found.');
            } else {
                $this->line('Found ' . $subscriptions->count() . ' active subscriptions.');
            }

            foreach ($subscriptions as $subscription) {
                $this->line("Checking subscription ID {$subscription->id} (End at: {$subscription->end_at})...");

                Log::info("Checking subscription ID {$subscription->id}, User ID: {$subscription->user_id}, Plan ID: {$subscription->subscription_plan_id}, End at: {$subscription->end_at}");

                // Step 1: Check if subscription has expired
                if (now()->greaterThan($subscription->end_at)) {
                    $subscription->update(['status' => false]);
                    $this->info("Subscription ID {$subscription->id} has been marked as inactive (expired).");
                    Log::info("Subscription ID {$subscription->id} has been marked as inactive (expired).");
                    continue;
                }

                // Step 2: Check usage for non-expired subscriptions
                $this->line("Subscription ID {$subscription->id} is not expired, checking usage...");
                $hasRemainingUsage = false;

                if ($subscription->subscriptionUsages->isNotEmpty()) {
                    foreach ($subscription->subscriptionUsages as $usage) {
                        $limitDisplay = $usage->limit === 0 ? 'infinite' : $usage->limit;
                        $this->line(" - Platform: {$usage->platform}, Used: {$usage->used}/{$limitDisplay}");

                        // Check remaining usage
                        if ($usage->limit === 0 || $usage->used < $usage->limit) {
                            $hasRemainingUsage = true;
                            $this->line("   - {$usage->platform} has remaining usage (limit: {$limitDisplay}).");
                        }
                    }
                } else {
                    $this->line(' - No usage records found.');
                }

                if (!$hasRemainingUsage) {
                    $subscription->update(['status' => false]);
                    $this->info("Subscription ID {$subscription->id} has been marked as inactive (no usage remains).");
                    Log::info("Subscription ID {$subscription->id} has been marked as inactive (no usage remains).");
                } else {
                    $this->line("Subscription ID {$subscription->id} is still active with remaining usage.");
                    Log::info("Subscription ID {$subscription->id} is still active with remaining usage.");
                }
            }

            $this->info('Subscription status check completed successfully.');
        } catch (\Exception $e) {
            Log::error('Error checking subscription status: ' . $e->getMessage());
            $this->error('An error occurred while checking subscription status: ' . $e->getMessage());
        }
    }
}
