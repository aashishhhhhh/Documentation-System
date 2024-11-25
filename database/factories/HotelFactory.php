<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Random hotel name
            'description' => $this->faker->paragraph, // Random description
            'rooms' => $this->faker->numberBetween(10, 500), // Random number of rooms
            'price_per_night' => $this->faker->randomFloat(2, 50, 500), // Random price per night (50-500)
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
