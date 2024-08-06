<?php

namespace App\Livewire;

use App\Helpers\AuctionHelper;
use App\Models\Auction;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

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
    public $finished;

    #[Url()]
    public $sort = 'latest';

    public $currentTime;

    public function mount()
    {
        $this->currentTime = now();
    }

    public function render()
    {

        $this->currentTime = now(); // Update current time
        $auctionQuery = Auction::query()->whereIn('status', ['accepted', 'ongoing', 'finished']);

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

        if ($this->finished) {
            $auctionQuery->where('status', 'finished');
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
