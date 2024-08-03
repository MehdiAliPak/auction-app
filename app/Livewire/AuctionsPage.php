<?php

namespace App\Livewire;

use App\Models\Auction;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Auctions - BidAuction')]

class AuctionsPage extends Component
{
    use WithPagination;

    public function render()
    {
        $auctionQuery = Auction::query();
        return view('livewire.auctions-page', [
            'auctions' => $auctionQuery->paginate(9),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}