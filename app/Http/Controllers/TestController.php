<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getAttenders() {
     $auction = Auction::find(22);
        return $auction->auctionOwner;
    }
}