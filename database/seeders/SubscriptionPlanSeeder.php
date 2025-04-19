<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usd = Currency::where('name', 'USD')->first();

        $plans = [
            [
                'name' => 'Basic',
                'description' => 'Basic plan for individuals',
                'price' => 9.99,
                'discount' => 0.00,
                'currency_id' => $usd?->id,
                'interval' => 'monthly',
                'features' => [
                    '1 user',
                    'Basic support',
                    'Limited posting'
                ],
                'limits' => [
                    [
                        'social' => 'instagram',
                        'limit_per_post' => 1,
                    ],
                    [
                        'social' => 'wordpress',
                        'limit_per_post' => 2,
                    ],
                    [
                        'social' => 'telegram',
                        'limit_per_post' => 3,
                    ],
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Pro',
                'description' => 'Pro plan for small teams',
                'price' => 29.99,
                'discount' => 5.00,
                'currency_id' => $usd?->id,
                'interval' => 'monthly',
                'features' => [
                    'Up to 5 users',
                    'Priority support',
                    'More posts per platform'
                ],
                'limits' => [
                    [
                        'social' => 'instagram',
                        'limit_per_post' => 10,
                    ],
                    [
                        'social' => 'wordpress',
                        'limit_per_post' => 15,
                    ],
                    [
                        'social' => 'telegram',
                        'limit_per_post' => 25,
                    ],
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Enterprise plan with full access',
                'price' => 199.99,
                'discount' => 20.00,
                'currency_id' => $usd?->id,
                'interval' => 'yearly',
                'features' => [
                    'Unlimited users',
                    'Dedicated support manager',
                    'Unlimited posting'
                ],
                'limits' => [
                    [
                        'social' => 'instagram',
                        'limit_per_post' => null,
                    ],
                    [
                        'social' => 'wordpress',
                        'limit_per_post' => null,
                    ],
                    [
                        'social' => 'telegram',
                        'limit_per_post' => null,
                    ],
                ],
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['name' => $plan['name'], 'currency_id' => $plan['currency_id']],
                [
                    'description' => $plan['description'],
                    'price' => $plan['price'],
                    'discount' => $plan['discount'],
                    'interval' => $plan['interval'],
                    'features' => $plan['features'],
                    'limits' => $plan['limits'],
                    'is_active' => $plan['is_active'],
                ]
            );
        }
    }
}
