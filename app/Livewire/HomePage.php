<?php

namespace App\Livewire;

use App\Models\Auction;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Home Page - BidAuction')]

class HomePage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        $ongoingAuctions = Auction::where('status', 'ongoing')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        return view('livewire.home-page', [
            'categories' => $categories,
            'ongoingAuctions' => $ongoingAuctions,
        ]);
    }
}