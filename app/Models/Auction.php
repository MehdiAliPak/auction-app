<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'image',
        'file',
        'description',
        'start_date',
        'end_date',
        'register_start_date',
        'register_end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

