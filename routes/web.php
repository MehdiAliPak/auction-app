<?php

use App\Http\Controllers\TestController;
use App\Livewire\AuctionDetailPage;
use App\Livewire\AuctionRoomPage;
use App\Livewire\AuctionsPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CategoriesPage;
use App\Livewire\HomePage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
// Route::get('/test', [TestController::class, 'log_date_to_file'])->name("log_date_to_file");
Route::get('/categories', CategoriesPage::class);
Route::get('/auctions', AuctionsPage::class);
Route::get('/auctions/{id}', AuctionDetailPage::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class);
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect('/');
    });
    Route::get('/success', SuccessPage::class);
    Route::get('/cancel', CancelPage::class);
    Route::get('/auction-room/{auction}', AuctionRoomPage::class)->name('auction.room');
});