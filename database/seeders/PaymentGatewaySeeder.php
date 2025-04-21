<?php

namespace Database\Seeders;

use App\Enums\PaymentGatewayEnum;
use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            [
                'name' => PaymentGatewayEnum::COD->value,
                'status' => 1,
            ],
            [
                'name' => PaymentGatewayEnum::STRIPE->value,
                'status' => 1,
            ],
            [
                'name' => PaymentGatewayEnum::PAYPAL->value,
                'status' => 1,
            ],
        ];

        foreach ($paymentMethods as $method) {
            PaymentGateway::updateOrCreate(
                ['name' => $method['name']],
                ['status' => $method['status']],
                ['created_at' => now()],
                ['updated_at' => now()]
            );
        }
    }
}
