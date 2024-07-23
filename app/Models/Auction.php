<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Auction extends Model
{
    use HasFactory;

    public function auctionOwner(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_auctions');
    }

    public function attenders(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'attenders');
    }
    
    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'chats');
    }
}