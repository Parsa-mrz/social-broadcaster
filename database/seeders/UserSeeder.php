<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function bcrypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query ()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('1234'),
            'role' => 'customer',
        ]);
    }
}
