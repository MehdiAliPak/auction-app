<?php

namespace App\Livewire;

use App\Helpers\AuctionHelper;
use App\Models\Attenders;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Auction Detail - BidAuction')]

class AuctionDetailPage extends Component
{
    public $id;

    public $registeredAuctions = [];

    public function mount($id)
    {
        $this->id = $id;
        $this->fetchRegisteredAuctions();
    }

    /**
     * Fetch the list of auction IDs the user has registered to.
     */
    public function fetchRegisteredAuctions()
    {
        $this->registeredAuctions = Attenders::where('user_id', Auth::id())
            ->pluck('auction_id')
            ->toArray();
    }

    // register user to auction
    public function registerToAuction($auction_id)
    {
        AuctionHelper::registerInAuction($auction_id);
        $this->registeredAuctions[] = $auction_id;
    }

    public function render()
    {
        return view('livewire.auction-detail-page', [
            'auction' => Auction::where('id', $this->id)->firstOrFail(),
        ]);
    }
}