<?php

namespace App\Helpers;

use Carbon\Carbon;

class AuctionHelper
{
    public static function getAuctionStatus($auction)
    {
        $currentDate = Carbon::now();
        $startDate = Carbon::parse($auction->start_date);
        $registerStartDate = Carbon::parse($auction->register_start_date);
        $registerEndDate = Carbon::parse($auction->register_end_date);
        $endDate = Carbon::parse($auction->end_date);

        if ($currentDate->greaterThan($endDate)) {
            return 'Finished';
        } elseif ($currentDate->greaterThan($registerEndDate) && $currentDate->lessThan($startDate)) {
            return 'Ongoing';
        } elseif ($currentDate->lessThan($startDate) && $currentDate->greaterThan($registerStartDate)) {
            $remainingDays = $startDate->diffInDays($currentDate);
            return 'Starts in ' . $remainingDays . ' days';
        } else {
            return 'Register';
        }
    }

    public static function getRemainingTime($auction)
    {
        $currentDate = Carbon::now();
        $startDate = Carbon::parse($auction->start_date);

        if ($currentDate->lessThan($startDate)) {
            return $startDate->diffInDays($currentDate) . ' days remaining';
        }

        return '';
    }
}