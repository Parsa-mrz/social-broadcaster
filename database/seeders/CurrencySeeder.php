<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['iso2' => 'US', 'name' => 'USD', 'icon' => '$'],
            ['iso2' => 'GB', 'name' => 'GBP', 'icon' => '£'],
            ['iso2' => 'EU', 'name' => 'EUR', 'icon' => '€'],
            ['iso2' => 'JP', 'name' => 'JPY', 'icon' => '¥'],
            ['iso2' => 'CN', 'name' => 'CNY', 'icon' => '¥'],
            ['iso2' => 'IN', 'name' => 'INR', 'icon' => '₹'],
            ['iso2' => 'KR', 'name' => 'KRW', 'icon' => '₩'],
            ['iso2' => 'RU', 'name' => 'RUB', 'icon' => '₽'],
            ['iso2' => 'NG', 'name' => 'NGN', 'icon' => '₦'],
            ['iso2' => 'PH', 'name' => 'PHP', 'icon' => '₱'],
            ['iso2' => 'TH', 'name' => 'THB', 'icon' => '฿'],
            ['iso2' => 'AE', 'name' => 'AED', 'icon' => 'د.إ'],
            ['iso2' => 'OM', 'name' => 'OMR', 'icon' => '﷼'],
            ['iso2' => 'KW', 'name' => 'KWD', 'icon' => 'د.ك'],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['name' => $currency['name']],
                $currency
            );
        }
    }
}
