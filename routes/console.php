<?php

use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('updateAuctionStatus', function () {
    $now = Carbon::now();

    Auction::where('start_date', '==', $now)
        ->where('status', 'accepted')
        ->update(['status' => 'ongoing']);

    Auction::where('end_date', '<=', $now)
        ->where('status', 'ongoing')
        ->update(['status' => 'finished']);
})->everySecond();