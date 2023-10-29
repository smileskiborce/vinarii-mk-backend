<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 300; $i++) {
            $name = explode(' ', fake()->name);
            ContactMessage::query()
                ->create(
                    [
                        'name' => $name[0],
                        'surname' => $name[1],
                        'email' => fake()->email,
                        'phone' => fake()->phoneNumber,
                        'description' => fake()->text(400),
                    ],
                );
        }
    }
}
