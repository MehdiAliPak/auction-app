<?php

namespace App\Livewire;

use App\Models\Auction;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Auction Detail - BidAuction')]

class AuctionDetailPage extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.auction-detail-page', [
            'auction' => Auction::where('id', $this->id)->firstOrFail(),
        ]);
    }
}