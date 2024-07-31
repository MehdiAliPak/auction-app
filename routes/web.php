<?php

use App\Http\Controllers\TestController;
use App\Livewire\AuctionsPage;
use App\Livewire\CategoriesPage;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/auctions', AuctionsPage::class);