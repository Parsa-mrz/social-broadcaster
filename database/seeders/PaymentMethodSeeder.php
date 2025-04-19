<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => 'COD',
                'status' => 1,
            ],
            [
                'name' => 'Paypal',
                'status' => 1,
            ],
            [
                'name' => 'Stripe',
                'status' => 1,
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentMethod::updateOrCreate(
                ['name' => $method['name']],
                ['status' => $method['status']]
            );
        }
    }
}
