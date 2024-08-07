<?php

namespace App\Livewire;

use App\Helpers\AuctionHelper;
use App\Models\Auction;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

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
