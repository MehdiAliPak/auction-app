<?php

namespace Database\Seeders;

use App\Models\Attenders;
use App\Models\Auction;
use App\Models\Category;
use App\Models\CategoryAuction;
use App\Models\Chat;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(5)->create();
        
        $auctions = Auction::factory(10)->create();
        
        foreach ($auctions as $auction) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            foreach ($categories as $categoryId) {
                CategoryAuction::factory()->create([
                    'auction_id' => $auction->id,
                    'category_id' => $categoryId,
                ]);
            }
            
            $attenders = User::inRandomOrder()->take(rand(1, 5))->pluck('id');
            foreach ($attenders as $userId) {
                Attenders::factory()->create([
                    'user_id' => $userId,
                    'auction_id' => $auction->id,
                ]);
            }
        }
        
        Chat::factory(20)->create();
    }
}