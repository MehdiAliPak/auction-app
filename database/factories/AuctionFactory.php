<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Auction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month');
        $registerStartDate = $this->faker->dateTimeBetween('now', $startDate);
        $registerEndDate = $this->faker->dateTimeBetween($registerStartDate, $startDate);

        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word,
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
            'file' => $this->faker->word . '.pdf',
            'description' => $this->faker->paragraph,
            'base_price' => $this->faker->numberBetween(100, 10000),
            'final_price' => $this->faker->optional()->numberBetween(100, 10000),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'register_start_date' => $registerStartDate,
            'register_end_date' => $registerEndDate,
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected', 'ongoing', 'finished', 'cancelled']),
        ];
    }
}