<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
                'role' => UserRole::ADMIN->value,
            ]);

        for ($i = 0; $i < 50; $i++) {
            User::query()
                ->create([
                    'name' => fake()->name,
                    'email' => fake()->email,
                    'password' => 'winery',
                    'role' => UserRole::WINERY->value,
                ]);
        }

    }
}
