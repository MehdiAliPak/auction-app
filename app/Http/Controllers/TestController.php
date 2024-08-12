<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function getAttenders()
    {
        $auction = Auction::find(22);
        return $auction->auctionOwner;
    }

    public function log_date_to_file()
    {
        $filename = 'date_log.txt';
        // Get the current date
        $date = now()->toDateTimeString();

        // Format the log entry
        $logEntry = "Logged on: $date\n";

        // Append the log entry to the file
        Storage::disk('local')->append($filename, $logEntry);
    }
}
