<?php

namespace App\Filament\Resources\AttendersResource\Pages;

use App\Filament\Resources\AttendersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListAttenders extends ListRecords
{
    protected static string $resource = AttendersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        $user = Auth::user();

        // Check if the user is authenticated and has the 'user' role
        if ($user && $user->role === 'user') {
            // Only display the auctions attended by the authenticated user
            $query->where('user_id', $user->id);
        }

        return $query;
    }
}