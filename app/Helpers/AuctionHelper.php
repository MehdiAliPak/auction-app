<?php

namespace App\Helpers;

use App\Models\Attenders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuctionHelper
{
    // register in auction
    static public function registerInAuction($auction_id)
    {
        $user_id = auth()->user()->id;

        $alreadyRegistered = Attenders::where('user_id', $user_id)
            ->where('auction_id', $auction_id)
            ->exists();

        if (!$alreadyRegistered) {
            Attenders::create([
                'user_id' => $user_id,
                'auction_id' => $auction_id,
                'attender_register_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}