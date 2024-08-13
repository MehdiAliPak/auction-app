<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Auction;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class AuctionRoomPage extends Component
{
    public $auction;
    public $currentBid;
    public $newBid;
    public $currentUserId;

    protected $rules = [
        'newBid' => 'required|integer|min:1',
    ];

    public function mount(Auction $auction)
    {
        $this->auction = $auction;
        $this->currentBid = $auction->final_price ?? $auction->base_price;
        $this->currentUserId = Auth::id();
    }

    public function placeBid()
    {
        $this->validate();

        // Check if the auction has ended
        if ($this->auction->status === 'finished') {
            session()->flash('error', 'The auction has already ended.');
            return;
        }

        if ($this->newBid > $this->currentBid) {
            $chat = Chat::create([
                'user_id' => Auth::id(),
                'auction_id' => $this->auction->id,
                'price' => $this->newBid,
                'message_time' => now(),
            ]);

            $this->currentBid = $this->newBid;
            $this->newBid = '';

            // Update the auction final price
            $this->auction->update(['final_price' => $this->currentBid]);
        }
    }

    public function render()
    {
        // Fetch latest chats every time the component renders
        $chats = Chat::where('auction_id', $this->auction->id)->orderBy('message_time', 'desc')->get();

        return view('livewire.auction-room-page', [
            'chats' => $chats,
            'attenders' => $this->auction->attenders()->get(),
            'currentUserId' => $this->currentUserId,
        ]);
    }

    // Poll the component every 2 seconds
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function startPolling()
    {
        $this->dispatchBrowserEvent('startPolling');
    }
}
