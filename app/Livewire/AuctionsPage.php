<?php

namespace App\Livewire;

use App\Helpers\AuctionHelper;
use App\Models\Attenders;
use App\Models\Auction;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Title('Auctions - BidAuction')]

class AuctionsPage extends Component
{
    use WithPagination;

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $registering;

    #[Url()]
    public $ongoing;

    #[Url()]
    public $sort = 'latest';

    public $registeredAuctions = [];

    public function mount()
    {
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

        $auctionQuery = Auction::query()->whereIn('status', ['accepted', 'ongoing']);

        if (!empty($this->selected_categories)) {
            // Assuming there is a relationship 'category' on the Auction model
            $auctionQuery = $auctionQuery->whereHas('category', function ($query) {
                $query->whereIn('category_id', $this->selected_categories);
            });
        }

        if ($this->registering) {
            $auctionQuery->where('status', 'accepted');
        }

        if ($this->ongoing) {
            $auctionQuery->where('status', 'ongoing');
        }

        if ($this->sort == "latest") {
            $auctionQuery->latest();
        }

        if ($this->sort == "price") {
            $auctionQuery->orderBy('base_price');
        }

        return view('livewire.auctions-page', [
            'auctions' => $auctionQuery->paginate(9),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}