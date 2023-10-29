<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        if (! app()->isProduction()) {
            $this->call([
                ContactMessageSeeder::class,
                SubscriptionSeeder::class,
                WinerySeeder::class,
                WineSeeder::class,
                WinerySeeder::class,
            ]);
        }
    }
}
