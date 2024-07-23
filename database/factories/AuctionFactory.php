<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'file' => $this->faker->word . '.pdf',
            'description' => $this->faker->paragraph,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'register_start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'register_end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'status' => 'active',
        ];
    }
}