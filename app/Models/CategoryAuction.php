<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAuction extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'category_id',
    ];
}