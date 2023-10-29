<?php

namespace Database\Seeders;

use App\Enums\Country;
use App\Enums\WineType;
use App\Models\Wine;
use App\Models\Winery;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $wineries = Winery::all();
        $imageLinks = [
            'https://w7.pngwing.com/pngs/573/483/png-transparent-red-wine-dessert-wine-liqueur-glass-bottle-wine-bottle-wine-glass-food-distilled-beverage.png',
            'https://images.pexels.com/photos/2912108/pexels-photo-2912108.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            'https://www.hallwines.com/media/wysiwyg/HALL_KathrynHall_2020_Homepage_414x692.jpg',
        ];
        foreach ($wineries as $winery) {
            for ($i = 1; $i <= 100; $i++) {
                $randomIndex = rand(0, 2);
                Wine::query()
                    ->create([
                        'name' => fake()->name,
                        'region' => fake()->name,
                        'vintage' => fake()->numberBetween(1900, 2023),
                        'price' => fake()->numberBetween(20, 1000),
                        'wine_type' => WineType::randomValue(), // Random wine type
                        'country' => Country::getRandomCountry(), // Random country
                        'rating' => fake()->numberBetween(5, 10),
                        'description' => fake()->text(300),
                        'alcohol_content' => rand(10, 16) / 10, // Random alcohol content between 1.0 and 1.6
                        'size_liters' => 0.75, // Standard wine bottle size
                        'winery_id' => $winery->id,
                        'image' => $imageLinks[$randomIndex],
                    ]);
            }
        }
    }
}
