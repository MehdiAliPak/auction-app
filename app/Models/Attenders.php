<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attenders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'auction_id',
        'attender_register_date',
    ];
}